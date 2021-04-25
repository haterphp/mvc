<?php

namespace Core\Storage;

class Dir{
    public $base = "";

    public static function init()
    {
        global $app;
        $_this = (new self);
        $_this->base = $app->configs()['storage']['storage_path'];
        return $_this;
    }

    public function makeDir($dirname, $chmod = 0777, $recursive = true)
    {
        if($this->isDir($dirname)) return false;
        
        $dir = $this->base . $dirname;
        
        $old = umask(0);
        $result = mkdir($dir, $chmod, $recursive);
        chmod($dir, $chmod);
        umask($old);

        if(!$result) return false;
        return true;
    }

    public function isDir($dirname)
    {
        return is_dir($this->base . $dirname);
    }

    public function removeDir($dirname)
    {
        if($this->isDir($dirname)){
            $dirname = $this->base . $dirname;
            $files = array_slice(scandir($dirname), 2);
            $parts = pathinfo($dirname);
            $files = collect($files)->map(function($item) use($parts){
                return str_replace($this->base, '', $parts['dirname']) . '/' . $parts['basename'] . '/' . $item;
            })->each(function($file){
                Storage::init()->delete($file);
            });
            return rmdir($dirname);
        }
        return false;
    }
}