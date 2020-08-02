<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function upload(Request $request)
    {
        if($request->hasFile('upload'))
        {
            $filenamewithextension = $request->file('upload')->getClientOriginalExtension();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $filenametostore = $filename.'_'.time().'.'.$extension;
            $request->file('upload')->storeAs('images', $filenametostore, 'public');
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('storage/images/'.$filenametostore);
            $msg = 'Gambar berhasil diupload';
            $result = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";

            @header('Content-type: text/html; charset=utf-8');
            echo $result;
        }
    }
}
