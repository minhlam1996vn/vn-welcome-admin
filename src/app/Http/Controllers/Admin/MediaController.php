<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Handle the file upload request.
     *
     * @param Request $request The HTTP request instance.
     * @return \Illuminate\Http\JsonResponse The JSON response containing file information.
     */
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            // Get the original file name
            $fileName = $request->file('upload')->getClientOriginalName();

            // Store the uploaded file in the 'media/articles' directory
            $path = Storage::disk()->put('media', $request->file('upload'));

            // Get the URL of the stored file
            $url = Storage::disk()->url($path);

            // Return a JSON response with file information
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
