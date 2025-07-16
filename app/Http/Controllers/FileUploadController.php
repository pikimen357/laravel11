<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
// Controller
    public function upload(Request $request)
    {
        if (!$request->hasFile('picture')) {
            return "please upload a picture";
        }

        $picture = $request->file('picture');
        $filename = $picture->getClientOriginalName();
        $path = $picture->storePubliclyAs('pictures', $filename, 'public');

        // Gunakan route untuk serve file
        $url = route('picture.show', ['filename' => $filename]);

        return "<h3>Upload success</h3><img src='{$url}' width='300'/>";
    }

    public function showPicture($filename)
    {
        $pathToFile = storage_path('app/public/pictures/' . $filename);

        if (!file_exists($pathToFile)) {
            abort(404);
        }

        $headers = [
            'Content-Type' => mime_content_type($pathToFile),
            'Cache-Control' => 'public, max-age=3600',
        ];

        return response()->file($pathToFile, $headers);
    }

}
