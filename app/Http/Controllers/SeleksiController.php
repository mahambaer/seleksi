<?php

namespace App\Http\Controllers;

use App\Peserta;
use Illuminate\Http\Request;

class SeleksiController extends Controller
{
    // public function showSeleksi(Request $request, $token)
    // {
    //     $peserta = Peserta::where('token', $token)->where('email', $request->email)->first();
    //     if($peserta->status == 'start')
    //     {
    //         $peserta->status = 'end';
    //         $peserta->save();
    //     }
    //     return view('seleksi', ['peserta' => $peserta]);
    // }

    public function index()
    {
        return view('landing');
    }

    public function showSeleksi($email)
    {
        $peserta = Peserta::where('email', $email)->first();
        if($peserta != null)
        {
            if($peserta->status == 'start')
            {
                $peserta->status = 'end';
                $peserta->save();
            }
        }
        return view('seleksi', ['peserta' => $peserta]);
    }

    public function confirmEmail(Request $request)
    {
        $peserta = Peserta::where('email', $request->email)->first();
        if($peserta == null)
        {
            return redirect()->back()->withErrors(['email' => 'Anda tidak terdaftar']);
        }
        return redirect()->route('seleksi', ['email' => urlencode($peserta->email)]);
    }
    
    // public function showMulai(Request $request, $token)
    // {
    //     $peserta = Peserta::where('token', $token)->where('email', $request->email)->first();
    //     if($peserta->status != 'sent')
    //     {
    //         return redirect()->route('seleksi', ['token' => $peserta->token, 'email' => $peserta->email]);
    //     }
    //     $peserta->status = 'start';
    //     $peserta->save();

    //     return view('mulai', ['peserta' => $peserta]);
    // }
    
    public function showMulai($email)
    {
        $peserta = Peserta::where('email', $email)->first();
        if($peserta->status != 'sent' || $peserta->program->status == 'close')
        {
            return redirect()->route('seleksi', ['email' => $peserta->email]);
        }
        $peserta->status = 'start';
        $peserta->save();

        return view('mulai', ['peserta' => $peserta]);
    }
}
