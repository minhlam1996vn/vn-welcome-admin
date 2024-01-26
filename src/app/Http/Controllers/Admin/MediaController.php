<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function upload(Request $request)
    {
        if ($request->hasFile('upload')) {
            // $path = Storage::put('public', $request->file('upload'));
            // $url = Storage::url($path);

            $disk = 'public'; // Tên disk bạn muốn sử dụng, ví dụ 'public' hoặc 's3'
            $subfolder = 'media'; // Tên thư mục con

            // Kiểm tra và tạo thư mục con nếu nó chưa tồn tại
            Storage::disk($disk)->makeDirectory($subfolder);

            // Lưu trữ file trong thư mục con của 'public' trên disk được chọn
            $path = $request->file('upload')->storeAs('media', $request->file('upload')->getClientOriginalName(), 'public');

            // Lấy URL để truy cập file
            $url = Storage::disk($disk)->url($path);

            return response()->json(['uploaded' => 1, 'url' => $url]);
            // $originName = $request->file('upload')->getClientOriginalName();
            // $fileName = pathinfo($originName, PATHINFO_FILENAME);
            // $extension = $request->file('upload')->getClientOriginalExtension();
            // $fileName = $fileName . '_' . time() . '.' . $extension;
            // $request->file('upload')->move(public_path('media'), $fileName);
            // $url = asset('media/' . $fileName);
            // return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }
}
