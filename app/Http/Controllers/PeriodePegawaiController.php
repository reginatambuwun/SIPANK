<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alternatif;
use App\Models\PeriodeNaikPangkat;
use App\Models\PeninjauanBerkas;
use App\Models\Berkas;

use Auth;

class PeriodePegawaiController extends Controller
{
    public function index(){
        $periode = Alternatif::where('alternatif.user_id', Auth::id())
                                    ->leftJoin('periode_naik_pangkat', 'alternatif.periode_id', 'periode_naik_pangkat.id')
                                    ->get([
                                        'periode_naik_pangkat.id',
                                        'periode_naik_pangkat.nama as nama_periode',
                                        'periode_naik_pangkat.status as status_periode'
                                    ]);

        // dd($periode);

        return view('pages.pegawai-periode.index', compact('periode'));
    }

    public function detail($id){
        $periode = PeriodeNaikPangkat::first();
        $alternatif = Alternatif::where('user_id',Auth::id())->first();
        $peninjauanBerkas = PeninjauanBerkas::where('periode_id', $id)->where('alternatif_id',$alternatif?->id)->orderBy('created_at', 'DESC')->get(['keterangan','status','created_at']);

        $checkStatus = PeninjauanBerkas::where('periode_id', $id)->where('alternatif_id',$alternatif?->id)->orderBy('created_at', 'DESC')->first(['status']);

        $berkas = Berkas::where('periode_id', $id)->where('alternatif_id',$alternatif?->id)->first(['sk_kp']);

        return view('pages.pegawai-periode.detail', compact('periode','peninjauanBerkas','checkStatus','berkas'));
    }
}
