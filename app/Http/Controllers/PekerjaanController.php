<?php

namespace App\Http\Controllers;

use App\Hotel;
use App\Pekerjaan;
use App\Posisi;
use App\ProfileHotel;
use App\ToDoList;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\Types\Null_;

class PekerjaanController extends Controller
{
    //


    public function create()
    {
        return view('jobs.postjob');
    }

    public function store()
    {
        $data = request()->validate([
            'area' => 'required',
            'posisi_id'=>'required',
            'tanggal_mulai' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'tinggi_minimal' => '',
            'tinggi_maksimal' => '',
            'berat_minimal' => '',
            'berat_maksimxal' => '',
            'kuota' => 'required',
            'bayaran' => 'required',
            'deskripsi' => 'required'
        ]);

        $data['url_slug'] = Str::slug($data['area'].' '.time(), "-");

        auth()->user()->pekerjaan()->create($data);

        return redirect('/hotel/'.auth()->user()->profile->url_slug);

    }
    public function show($url_slug){
        $pekerjaan = Pekerjaan::where('url_slug','=', $url_slug)->first();
        return view('jobs.job', compact('pekerjaan'));
    }
    public function edit($url_slug){
        // mengambil data pegawai berdasarkan url_slug yang dipilih
        $pekerjaan = DB::table('pekerjaan')->where('url_slug',$url_slug)->get();
        // passing data pegawai yang didapat ke view edit.blade.php
        return view('jobs.editJob',['pekerjaan' => $pekerjaan]);
    }
    public function update(Request $request){

        DB::table('pekerjaan')->where('id',$request->id)->update([
            'area' => $request->area,
            'posisi_id'=>$request->posisi_id,
            'tanggal_mulai' => $request->tanggal_mulai,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'tinggi_minimal' => $request->tinggi_minimal,
            'tinggi_maksimal' => $request ->tinggi_maksimal,
            'berat_minimal' => $request ->berat_minimal,
            'berat_maksimal' => $request ->berat_maksimal,
            'kuota' => $request->kuota,
            'bayaran' => $request->bayaran,
            'deskripsi' => $request->deskripsi
        ]);
        return redirect('/hotel/'.auth()->user()->profile->url_slug)->with('success','Data Telah Diupdate!');

    }
    public function delete($url_slug){
        DB::table('pekerjaan')->where('url_slug', $url_slug)->delete();
        return redirect('/hotel/'.auth()->user()->profile->url_slug)->with('success','Data Telah Dihapus');
    }


    public function apply($url_slug){
        $user = Auth::user();
        $pekerjaan = Pekerjaan::where('url_slug','=', $url_slug)->first();

        if ($user->profile->getIsCompletedAttribute() == false)
            return redirect('/user/'.$user->profile->url_slug.'/edit')->with('gagalProfile','Profile belum lengkap');
        elseif ($pekerjaan->tinggi_minimal != Null) {
            if ($user->profile->tinggi_badan < $pekerjaan->tinggi_minimal || $user->profile->tinggi_badan > $pekerjaan->tinggi_maksimal)
                return back()->with('gagalTinggi', 'Tinggi badan anda tidak sesuai kriteria');
        }
        elseif($pekerjaan->berat_minimal != Null) {
         if($user->profile->berat_badan < $pekerjaan->berat_minimal || $user->profile->berat_badan > $pekerjaan->berat_maksimal)
            return back()->with('gagalBerat', 'Berat badan anda tidak seusai Kriteria');
        }
        elseif($pekerjaan->dikerjakan()->count() >= $pekerjaan->kuota)
            return back()->with('kuotaPenuh', 'Kuota Penuh');
        else {
        $user->mengerjakan()->toggle($pekerjaan);

        return back()->with('success','Berhasil apply pekerjaan di '.$pekerjaan->hotel->profile->nama);

        }
    }


    public function showList($url_slug){
        $pekerjaan = Pekerjaan::where('url_slug','=', $url_slug)->first();
        return view('todolist.postlist', compact('pekerjaan'));
    }

    public function todolist($url_slug){

        $pekerjaan = Pekerjaan::where('url_slug','=', $url_slug)->first();

        $data = request()->validate([
            'nama_pekerjaan'=>'required'
        ]);

        $pekerjaan->todolist()->create($data);

        return view('jobs.job', compact('pekerjaan'));

    }

}
