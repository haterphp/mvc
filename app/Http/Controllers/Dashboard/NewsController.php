<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\News;
use Core\Request\Request;
use Core\Storage\Dir;
use Core\Storage\Storage;
use Core\Validator\Validator;

class NewsController extends Controller{

    public function index()
    {
        $newses = array_reverse(News::all());
        return view('dashboard/newses/index', compact('newses'));
    }

    public function create()
    {
        return view('dashboard/newses/create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'description' => ['required'],
            'file' => ['required', 'image']
        ]);

        if($validator->fails()){
            return redirect(route('dashboard.newses.create'))->with('errors', $validator->errors());
        }

        $idx = News::create($request->only('title', 'description'))['id'];

        $file = $request->files()['file'];
        $parts = pathinfo($file['name']);
        $filename = generateRandomString(20) . '.' . $parts['extension'];
        $filepath = 'newses/' . $idx;
        
        Dir::init()->makeDir($filepath);
        Storage::init()->make($file, $filepath . '/' . $filename);
        $image = $filepath . '/' . $filename;
        
        News::query()->where(['id' => $idx])->update([
            'image' => $image
        ]);

        return redirect(route('dashboard.newses'))->with('alert', [
            'status' => 'success',
            'message' => 'Новость успешно добавлена'
        ]);
    }

    public function delete(Request $request)
    {
        $id = $request->get('news');
        Dir::init()->removeDir('newses/' . $id);
        News::query()->where(['id' => $request->get('news')])->delete();

        return redirect(route('dashboard.newses'))->with('alert', [
            'status' => 'success',
            'message' => 'Новость успешно удалена'
        ]);
    }

    public function edit(Request $request)
    {
        $news = News::query()->where(['id' => $request->get('news')])->first();
        return view('dashboard/newses/edit', compact('news'));
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => ['required'],
            'description' => ['required']
        ]);

        $id = $request->get('news');

        if($validator->fails()){
            return redirect(route('dashboard.newses.edit', ['news' => $id]))->with('errors', $validator->errors());
        }

        News::query()->where(['id' => $id])->update($request->only('title', 'description'));

        return redirect(route('dashboard.newses'))->with('alert', [
            'status' => 'success',
            'message' => 'Новость успешно изменена'
        ]);
    }
}