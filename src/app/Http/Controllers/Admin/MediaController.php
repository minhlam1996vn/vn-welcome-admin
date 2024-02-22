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
            $uuid = $request->uuid;
            $fileName = $request->file('upload')->getClientOriginalName();

            $path = Storage::put('medias/' . $uuid, $request->file('upload'));
            $url = Storage::url($path);

            return response()->json(['fileName' => $fileName, 'uploaded' => true, 'url' => $url]);
        }
    }
}
