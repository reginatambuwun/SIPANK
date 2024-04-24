<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodeNaikPangkat;
use App\Models\Alternatif;
use App\Models\Berkas;
use App\Models\Perankingan;
use App\Models\User;
use Auth;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(Auth::user()->role === 'pegawai'){
            $periode = PeriodeNaikPangkat::where('periode_naik_pangkat.status', 'sementara')
                                            ->where('alternatif.user_id', Auth::id())
                                            ->leftJoin('alternatif', 'alternatif.periode_id', 'periode_naik_pangkat.id')
                                            ->first(['periode_naik_pangkat.id as periode_id','periode_naik_pangkat.nama as nama_periode','alternatif.id as alternatif_id']);
    
            $alternatif = Alternatif::where('periode_id',$periode?->periode_id)->where('user_id',Auth::id())->first();
            $perankingan = Perankingan::where('periode_id',$periode?->periode_id)->where('alternatif_id',$alternatif?->id)->first(['direkomendasi']);
    
            $berkas = Berkas::where('periode_id', $periode?->periode_id)->where('alternatif_id', $periode?->alternatif_id)->first(['status']);
                  
            return view('home', compact('periode','perankingan','berkas'));
        }else if(Auth::user()->role === 'admin'){
            $periode = PeriodeNaikPangkat::count();
            $pegawai = User::where('role', 'pegawai')->count();

            return view('home', compact('periode','pegawai'));
        }else if(Auth::user()->role === 'bkpsdm'){

            return view('home');
        }
    }
}
