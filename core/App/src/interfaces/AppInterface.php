<?php

namespace Core\App\Src\Interfaces;

interface AppInterface{
    public function router();
    public function auth();
    public function configs();
}