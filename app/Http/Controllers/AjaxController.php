<?php

namespace App\Http\Controllers;

use App\Jawaban;
use App\Peserta;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getScore(Jawaban $jawaban)
    {
        $score = $jawaban->status;
        $count = $jawaban->soal->jawabans->count();
        if($jawaban->tipe == "score")
        {
            $score /= $count;
        }
        return response()->json(['score' => $score]);
    }

    public function sendScore(Request $request, Peserta $peserta)
    {
        $result = null;
        $peserta->score = $request->score;
        $peserta->durasi = $request->timer;
        $peserta->status = 'end';
        $peserta->save();
        $result = $peserta->status;
        return response()->json(['result' => $result]);
    }
}
