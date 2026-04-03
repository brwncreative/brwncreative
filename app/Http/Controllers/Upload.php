<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Upload extends Controller
{
    /**
     * Summary of image
     * @param mixed $image
     * @param mixed $project
     * @return string
     */
    public static function image($image, $project)
    {
        $rand = rand(100, 1000);
        if ($image && gettype($image) == 'object') {
            if (is_dir(public_path("/projects/{$project->id}")) == false) {
                mkdir(public_path("/projects/{$project->id}"), recursive: true);
            }
            $gd = @imagecreatefromstring($image->get());
            $w = imagesx($gd) * .8;
            $gd = imagescale($gd, $w);
            @imagewebp($gd, public_path("/projects/{$project->id}/{$rand}.webp"), 95);
        }
        return "/projects/{$project->id}/{$rand}.webp";
    }
}
