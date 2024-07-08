<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;


class ImageConversion
{
    public static function conversion($photo, $rep)
    {
        $path = $photo->store($rep, 'public');
        $env_python = env('PATH_PYTHON', 'python3');
        $command = base_path('app/Python/imageConversion.py') . " " . escapeshellarg(Storage::disk('local')->path('/public/' . $path));
        $command = escapeshellcmd($env_python . " " . $command);
        $out = shell_exec($command);
        $relativePathPos = strpos($out, $rep);
        $relativePath = substr($out, $relativePathPos);
        $relativePath = rtrim($relativePath, "\n");

        return $relativePath;
    }
}
