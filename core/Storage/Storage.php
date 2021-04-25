<?php

namespace Core\Storage;

class Storage{
    public $base = "";

    public static function init()
    {
        global $app;
        $_this = (new self);
        $_this->base = $app->configs()['storage']['storage_path'];
        return $_this;
    }

    public function make($file, $filepath)
    {
        $filepath = $this->base . $filepath;
        \move_uploaded_file($file['tmp_name'], $filepath);
        return $filepath;
    }

    public function delete($filepath)
    {
        $filepath = $this->base . $filepath;
        return unlink($filepath);
    }

    public function get($filepath)
    {
        $filepath = $this->base . $filepath;
        return \file_get_contents($filepath);
    }
}