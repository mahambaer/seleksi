<?php

namespace App\Http\Controllers;

use App\Soal;
use App\Kejuruan;
use App\Jawaban;
use App\Program;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SoalController extends Controller
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
        return view('admin.soal.index');
    }

    public function elektronika()
    {
        $elektronika = Kejuruan::where('name', strtoupper('elektronika'))->first()->soals()->get();
        return view('admin.soal.elektronika', ['soals' => $elektronika]);
    }

    public function refrigration()
    {
        $refrigration = Kejuruan::where('name', strtoupper('refrigration'))->first()->soals()->get();
        return view('admin.soal.refrigration', ['soals' => $refrigration]);
    }

    public function tik()
    {
        $tik = Kejuruan::where('name', strtoupper('Tek. Informasi dan Komunikasi'))->first()->soals()->get();
        return view('admin.soal.tik', ['soals' => $tik]);
    }

    public function pariwisata()
    {
        $pariwisata = Kejuruan::where('name', strtoupper('pariwisata'))->first()->soals()->get();
        return view('admin.soal.pariwisata', ['soals' => $pariwisata]);
    }

    public function storeElektronika(Request $request)
    {
        $messages = [
            'pertanyaan.required' => 'Pertanyaan harus diisi melalui editor',
            'status.required' => 'Pilihan yang Benar harus dipilih',
            'pilihan1.required' => 'Pilihan 1 harus diisi melalui editor',
            'pilihan2.required' => 'Pilihan 2 harus diisi melalui editor',
            'pilihan3.required' => 'Pilihan 3 harus diisi melalui editor',
            'pilihan4.required' => 'Pilihan 4 harus diisi melalui editor',
        ];
        $rules = [
            'pertanyaan'   => 'required',
            'status'   => 'required',
            'pilihan1'   => 'required',
            'pilihan2'   => 'required',
            'pilihan3'   => 'required',
            'pilihan4'   => 'required',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        $nama_file = 'elektronika_'.time().'.txt';
        $folder = 'uploads/soal';
        $fields = [
            'link'     => $folder.'/'.$nama_file,
            'kejuruan_id' => Kejuruan::where('name', strtoupper('elektronika'))->first()->id
        ];

        Storage::disk('public')->put($folder.'/'.$nama_file, $request->pertanyaan);
        $soal = Soal::create($fields);

        $programs = Program::where('kejuruan_id', $soal->id)->get();
        foreach($programs as $program)
        {
            $program->soals()->attach($soal->id);
        }
        
        $nama_file = $soal->id.'a.txt';
        $folder = 'uploads/jawaban';
        $fields = [
            'link'     => $folder.'/'.$nama_file,
            'status' => $request->status == 'pilihan1' ? 'benar' : 'salah',
            'soal_id' => $soal->id
        ];

        Storage::disk('public')->put($folder.'/'.$nama_file, $request->pilihan1);
        Jawaban::create($fields);

        $nama_file = $soal->id.'b.txt';
        $folder = 'uploads/jawaban';
        $fields = [
            'link'     => $folder.'/'.$nama_file,
            'status' => $request->status == 'pilihan2' ? 'benar' : 'salah',
            'soal_id' => $soal->id
        ];

        Storage::disk('public')->put($folder.'/'.$nama_file, $request->pilihan2);
        Jawaban::create($fields);
        
        $nama_file = $soal->id.'c.txt';
        $folder = 'uploads/jawaban';
        $fields = [
            'link'     => $folder.'/'.$nama_file,
            'status' => $request->status == 'pilihan3' ? 'benar' : 'salah',
            'soal_id' => $soal->id
        ];

        Storage::disk('public')->put($folder.'/'.$nama_file, $request->pilihan3);
        Jawaban::create($fields);
        
        $nama_file = $soal->id.'d.txt';
        $folder = 'uploads/jawaban';
        $fields = [
            'link'     => $folder.'/'.$nama_file,
            'status' => $request->status == 'pilihan4' ? 'benar' : 'salah',
            'soal_id' => $soal->id
        ];

        Storage::disk('public')->put($folder.'/'.$nama_file, $request->pilihan4);
        Jawaban::create($fields);

        return back();
    }

    public function destroyElektronika(Soal $soal)
    {
        if(Storage::disk('public')->exists($soal->link));
        {
            Storage::disk('public')->delete($soal->link);   
        }
        foreach($soal->jawabans as $jawaban)
        {
            if(Storage::disk('public')->exists($jawaban->link))
            {
                Storage::disk('public')->delete($jawaban->link);
            }
            $jawaban->delete();
        }
        $soal->programs()->detach();
        $soal->delete();
        return back();
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
}
