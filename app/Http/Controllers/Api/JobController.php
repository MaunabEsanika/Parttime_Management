<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Pekerjaan;
use App\ProfileHotel;
use App\User;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    function getAllJobs(){
        $date = Carbon::now()->toDateString();
        $time = Carbon::now()->toTimeString();
        return response()->json(['jobs'=>
            Pekerjaan::with('hotel.profile')
                ->with('posisi')
                ->withCount('dikerjakan')
                ->where('status', '1')
                ->where(function ($q) use($date, $time){
                    $q->where('tanggal_mulai','>',$date)
                        ->orWhere('tanggal_mulai',$date)->where('waktu_mulai','>',$time);
                })
                ->orderBy('tanggal_mulai')
                ->get()]);
    }

    function getJobs($query){
        $hotel_id = ProfileHotel::where('nama','like','%'.$query.'%')
                ->pluck('hotel_id')
                ->toArray();

        $date = Carbon::now()->toDateString();
        $time = Carbon::now()->toTimeString();

        return response()->json(['jobs'=>
            Pekerjaan::with('hotel.profile')
                ->with('posisi')
                ->withCount('dikerjakan')
                ->where('status', '1')
                ->where(function ($q) use($date, $time){
                    $q->where('tanggal_mulai','>',$date)
                        ->orWhere('tanggal_mulai',$date)->where('waktu_mulai','>',$time);
                })
                ->where(function ($q) use ($query){
                    $q->where('deskripsi','like','%'.$query.'%')
                        ->orWhere('area','like','%'.$query.'%')
                        ->orWhere('hotel_id', !empty($hotel_id) ? $hotel_id : "!@!@!@!");
                })
                ->orderBy('tanggal_mulai')
                ->get()]);
    }

    function getJobsWithPosition($position){
        $date = Carbon::now()->toDateString();
        $time = Carbon::now()->toTimeString();

        return response()->json(['jobs'=>
            Pekerjaan::with('hotel.profile')
                ->with('posisi')
                ->withCount('dikerjakan')
                ->where('status', '1')
                ->where('posisi_id',$position)
                ->where(function ($q) use($date, $time){
                    $q->where('tanggal_mulai','>',$date)
                        ->orWhere('tanggal_mulai',$date)->where('waktu_mulai','>',$time);
                })
                ->orderBy('tanggal_mulai')
                ->get()]);
    }

    function applyJob($job){
        $user = Auth::user();
        $profile = $user->profile;
        $currentJob = Pekerjaan::whereHas('dikerjakan', function ($q) use ($user){
            $q->where('pekerjaan_user.user_id', '=', $user->id);
        })->with('dikerjakan')->find($job);
        if ($currentJob == null){
            $currentJob = Pekerjaan::with('dikerjakan')->find($job);
        }

        $currentJob->tinggi_minimal = $currentJob->tinggi_minimal == null ? PHP_INT_MIN : $currentJob->tinggi_minimal;
        $currentJob->tinggi_maksimal = $currentJob->tinggi_maksimal == null ? PHP_INT_MAX : $currentJob->tinggi_maksimal;
        $currentJob->berat_minimal = $currentJob->berat_minimal == null ? PHP_INT_MIN : $currentJob->berat_minimal;
        $currentJob->berat_maksimal = $currentJob->berat_maksimal == null ? PHP_INT_MAX : $currentJob->berat_maksimal;

        if($currentJob->dikerjakan->count() >= $currentJob->kuota)
            return response()->json(['message'=>'Kuota sudah penuh'],Response::HTTP_FORBIDDEN);

        elseif ($currentJob->isExpired || $currentJob->status != '1')
            return response()->json(['message'=>'Job sudah expired'], Response::HTTP_FORBIDDEN);
        elseif (!$profile->isCompleted)
            return response()->json(['message'=>'Silakan melengkapi profil'], Response::HTTP_FORBIDDEN);
        elseif ($currentJob->tinggi_minimal > $profile->tinggi_badan || $currentJob->tinggi_maksimal < $profile->tinggi_badan)
            return response()->json(['message'=>'Tinggi tidak memenuhi'],Response::HTTP_FORBIDDEN);
        elseif ($currentJob->berat_minimal > $profile->berat_badan || $currentJob->berat_maksimal < $profile->berat_badan)
            return response()->json(['message'=>'Berat tidak memenuhi'],Response::HTTP_FORBIDDEN);
        elseif (!empty($currentJob->dikerjakan->first())){
            if ($currentJob->dikerjakan->first()->pivot->status != '0')
                return response()->json(['message'=>'Anda tidak dapat mengcancel'], Response::HTTP_FORBIDDEN);
            else
                return response()->json($user->mengerjakan()->toggle(Pekerjaan::findOrFail($job)));
        }
        else
            return response()->json($user->mengerjakan()->toggle(Pekerjaan::findOrFail($job)));
    }

    function getUserJob($id){
        $jobs = User::whereHas('mengerjakan', function ($q){
            $q->where('pekerjaan_user.status', '!=', '0');
        })->with('mengerjakan')
            ->get()->find($id);
        if ($jobs != null){
            $jobs = $jobs->mengerjakan->pluck('id');
            return response()->json(['jobs'=>
                Pekerjaan::with('hotel.profile')
                    ->with('posisi')
                    ->withCount('dikerjakan')
                    ->whereIn('id',$jobs)
                    ->orderBy('tanggal_mulai')
                    ->get()]);
        } else {
            return \response()->json(['jobs'=>[]]);
        }
    }

    function getJobsDetail($id){
        if ($id != auth()->id())
            return \response(Response::HTTP_UNAUTHORIZED);
        $jobs = User::whereHas('mengerjakan', function ($q){
            $q->where('pekerjaan_user.status', '!=', '0');
        })->with('mengerjakan')->find(\auth()->id());
        if ($jobs != null){
            $jobs = $jobs->mengerjakan->pluck('id');
            return \response()->json(['job_detail'=>Pekerjaan::with('todolist')->find($jobs)]);
        } else {
            return \response()->json(['job_detail'=>[]]);
        }
    }
}
