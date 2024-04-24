<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\BobotKriteria;
use App\Models\SubKriteria;
use App\Models\BobotSubkriteria;

class HitungKriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderBy('kode','ASC')->get(['id','kode','nama','jumlah_bobot','jumlah_eigen','rata_eigen']);

        // START // perhitungan kriteria
        $bobotKriteria = BobotKriteria::groupBy('kriteria1')->get(['kriteria1']);

        $nilaiBobot = [];
        foreach ($bobotKriteria as $value) {
            array_push($nilaiBobot, BobotKriteria::leftJoin('kriteria as satu', 'bobot_kriteria.kriteria1', 'satu.kode')
                                                ->leftJoin('kriteria as dua', 'bobot_kriteria.kriteria2', 'dua.kode')
                                                ->orderByRaw('bobot_kriteria.kriteria1 ASC, bobot_kriteria.kriteria2 ASC')
                                                ->where('kriteria1', $value->kriteria1)->get(['satu.nama','kriteria1','kriteria2','bobot','eigen']));
        }
        // END // perhitungan kriteria

        // START // perhitungan subkriteria
        $daftarPerhitunganSubkriteria = [];
        foreach ($kriteria as $value) {
            $subkriteria = SubKriteria::where('kriteria_id', $value->id)->orderBy('kode','ASC')->get(['kode','nama','jumlah_bobot','jumlah_eigen','rata_eigen']);
            $bobotSubkriteria = BobotSubkriteria::where('kriteria_id', $value->id)->groupBy('kriteria1')->get(['kriteria1']);
    
            // Mapping tabel bobot subkriteria
            $bobot = [];
            foreach ($bobotSubkriteria as $item) {
                array_push($bobot, BobotSubkriteria::leftJoin('sub_kriteria as satu', 'bobot_subkriteria.kriteria1', 'satu.kode')
                                                    ->leftJoin('sub_kriteria as dua', 'bobot_subkriteria.kriteria2', 'dua.kode')
                                                    ->orderByRaw('bobot_subkriteria.kriteria1 ASC, bobot_subkriteria.kriteria2 ASC')
                                                    ->where('kriteria1', $item->kriteria1)->get(['satu.nama','kriteria1','kriteria2','bobot','eigen']));
            }

            array_push($daftarPerhitunganSubkriteria, ['nama_kriteria'=>$value->nama,'subkriteria'=>$subkriteria, 'bobot'=>$bobot]);
        }
        // END // perhitungan subkriteria

        // return response()->json(['status'=>'success', 'data'=>$daftarPerhitunganSubkriteria],200);
        return view('pages.hitung-kriteria.index', compact(
            'kriteria',
            'nilaiBobot',

            'daftarPerhitunganSubkriteria'
        ));
    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
