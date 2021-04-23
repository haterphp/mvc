<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectLink;
use Core\Request\Request;
use Core\Validator\Validator;

class ProjectController extends Controller{
    public function index(Request $request)
    {
        $projects = array_reverse(Project::all());

        $projects = collect($projects)->map(function(&$item){
            $links = Project::links($item['id']);
            $item['links'] = collect($links)->map(function($link) {
                return $link['link'];
            })->toArray();
            return $item;
        })->toArray();
        return view('dashboard/projects/index', compact('projects'));
    }

    public function create()
    {
        return view('dashboard/projects/create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'description' => ['required'],
            'site' => ['required'],
        ]);

        if($validator->fails()){
            return redirect(route('dashboard.projects.create'))->with('errors', $validator->errors());
        }

        $project = Project::create($request->only('title', 'description', 'site'));

        if($request->get('links')){
            $links = explode(';', $request->get('links'));
            foreach($links as $link){
                ProjectLink::create([
                    'project_id' => $project['id'],
                    'link' => trim($link)
                ]);
            }
        }

        return redirect(route('dashboard.projects'))->with('alert', [
            'status' => 'success',
            'message' => 'Проект успешно добавлен'
        ]);
    }

    public function edit(Request $request)
    {
        $project = Project::query()->where(['id' => $request->get('project')])->first();
        $links = collect(Project::links($project['id']))->map(function($item){
            return $item['link'];
        });
        $project['links'] = implode(';', $links->toArray());
        return view('dashboard/projects/edit', compact('project'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'description' => ['required'],
            'site' => ['required'],
        ]);

        $project = $request->get('project');

        if($validator->fails()){
            return redirect(route('dashboard.projects.edit', compact('project')))->with('errors', $validator->errors());
        }
        
        Project::query()
            ->where(['id' => $request->get('project')])
            ->update($request->only('title', 'description', 'site'));

        if($request->get('links')){
            
            $links = Project::links($project);
            foreach($links as $link){
                ProjectLink::query()->where(['id' => $link['id']])->delete();
            }

            $links = explode(';', $request->get('links'));
            foreach($links as $link){
                ProjectLink::create([
                    'project_id' => $project,
                    'link' => trim($link)
                ]);
            }
        }

        return redirect(route('dashboard.projects'))->with('alert', [
            'status' => 'success',
            'message' => 'Проект успешно обновлен'
        ]);
        
    }

    public function delete(Request $request)
    {
        $links = Project::links($request->get('project'));
        foreach($links as $link){
            ProjectLink::query()->where(['id' => $link['id']])->delete();
        }
        Project::query()->where(['id' => $request->get('project')])->delete();
        return redirect(route('dashboard.projects'))->with('alert', [
            'status' => 'success',
            'message' => 'Проект успешно удален'
        ]);
    }
}