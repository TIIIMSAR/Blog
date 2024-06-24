<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EditorUploadController extends Controller
{
    public function upload(Request $request)
    {   
        
        $file = $request->file('upload'); // فایل اپلود شده با کلیداپلود در دسترس است
        
        $base_name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // نام فایل
        $ext = $file->getClientOriginalExtension(); // پسوند فایل

        $file_name = $base_name . '_' .time() . '.' . $ext; // نام فایل کامل و یونیک شده
        $file->storeAs('images/posts', $file_name, 'public_files');

        $function = $request->CKEditorFuncNum;
        $url = asset('images/posts/' . $file_name ); // ادرس فایل 

        return response("<script>window.parent.CKEDITOR.tools.callFunction({$function}, '{$url}', 'فایل به درستی اپلود شد')</script>");
    }
}
