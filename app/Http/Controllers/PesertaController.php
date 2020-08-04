<?php

namespace App\Http\Controllers;

use App\Program;
use App\Peserta;
use App\Mail\TokenLinkSend;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use SebastianBergmann\Environment\Console;

class PesertaController extends Controller
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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::all();
        $pesertas = Peserta::all();
        return view('admin.peserta.index', ['programs' => $programs, 'pesertas' => $pesertas]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function tokenLinkSendRequest(Request $request)
    {
        $users = Peserta::where('status', 'pending')->where('program_id', $request->program_id)->get();
        
        if($users->count() == 0)
        {
            return redirect()->back()->withErrors(['email' => trans('Users do not exists')]);
        }
        
        if($this->sendMail($users))
        {
            return redirect()->back()->with('status', trans('A token link has been sent to user\'s email addresses.'));
        }
        else
        {
            return redirect()->back()->withErrors(['email' => trans('A Network Error occured. Please try again.')]);
        }
    }

    public function importExcel(Request $request)
    {
        if($request->hasFile('excel'))
        {
            $path = $request->file('excel')->getRealPath();
            $data = \Excel::load($path)->get();
            set_time_limit(120);
            if($data->count()){
                // return back()->withErrors(['excel' => $data->count()]);
                foreach($data as $value)
                {
                    $id = Program::where('name', strtoupper($value->judul_pelatihan))->first()->id;
                    $peserta = Peserta::updateOrCreate([
                        'name' => $value->nama_peserta,
                        'email' => $value->email,
                        'program_id' => $id,
                        'status' => 'sent'
                    ],[
                        'token' => Str::random(60)
                    ]);
                }
            }
        }

        return back();
    }

    private function sendMail($users)
    {
        try
        {
            foreach($users as $user)
            {
                $link = url('seleksi').'/'.urlencode($user->token).'?email='.urlencode($user->email);
                $data = [
                    'greeting' => 'Hello '.$user->name,
                    'level' => 'reset',
                    'introLines' => ['Anda mendapatkan email ini karena Anda telah mendaftar pelatihan di BBPLK Bekasi melalui https://pelatihan.kemnaker.go.id .',
                                     'Pelatihan yang Anda pilih adalah : '.$user->program->name
                                    ],
                    'actionText' => 'Link Halaman Seleksi',
                    'actionUrl' => $link,
                    'displayableActionUrl' => $link,
                    'outroLines' => ['Abaikan email ini bila Anda tidak merasa mendaftar di BBPLK Bekasi.'],
                    'salutation' => 'Admin BBPLK Bekasi'
                ];
                
                Mail::to($user->email)->send(new TokenLinkSend($data));
                $user->status = 'sent';
                $user->save();
                return true;
            }
        }
        catch(Exception $e)
        {
            return false;
        }
    }
}
