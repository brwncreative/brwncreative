<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Remove extends Controller
{
    public function image(string $path) {}

    public static function directory(string $directory): void
    {
        if (! is_dir($directory)) {
            // throw new \InvalidArgumentException("$directory must be a directory");
            return;
        }
        if (substr($directory, strlen($directory) - 1, 1) != '/') {
            $directory .= '/';
        }
        $files = glob($directory . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::directory($file);
            } else {
                unlink($file);
            }
        }
        rmdir($directory);
    }
    public static function file(string $url){
        unlink(public_path($url));
    }
}
