<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        if (!$request->hasFile('picture')) {
            return "please upload a picture";
        }

        $picture = $request->file('picture');
        $path = $picture->storePubliclyAs('pictures', $picture->getClientOriginalName(), 'public');
        $url = asset("storage/{$path}");

        return "<h3>Upload success</h3><img src='{$url}' width='300'/>";
    }

}
