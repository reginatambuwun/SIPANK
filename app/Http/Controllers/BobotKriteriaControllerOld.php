<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kriteria;
use App\Models\BobotKriteria;
use RealRashid\SweetAlert\Facades\Alert;
use DB;

class BobotKriteriaController extends Controller
{

    public function index()
    {
        $kriteria = Kriteria::orderBy('kode','ASC')->get(['kode','nama','jumlah_bobot','jumlah_eigen','rata_eigen']);
        $bobotKriteria = BobotKriteria::groupBy('kriteria1')->get(['kriteria1']);

        // Mapping tabel bobot kriteria //
        $bobot = [];
        foreach ($bobotKriteria as $value) {
            array_push($bobot, BobotKriteria::leftJoin('kriteria as satu', 'bobot_kriteria.kriteria1', 'satu.kode')
                                                ->leftJoin('kriteria as dua', 'bobot_kriteria.kriteria2', 'dua.kode')
                                                ->orderByRaw('bobot_kriteria.kriteria1 ASC, bobot_kriteria.kriteria2 ASC')
                                                ->where('kriteria1', $value->kriteria1)->get(['satu.nama','kriteria1','kriteria2','bobot','eigen']));
        }

        // Hitung jumlah bobot setiap kriteria
        // $jumlahBobot = [];
        // foreach ($kriteria as $value) {
        //     $temp = BobotKriteria::where('kriteria2', $value->kode)->sum('bobot');
        //     array_push($jumlahBobot, $temp);
        // }

        // Mapping tabel perhitungan nilai eigen //

        $nilaiEigen = [];
        foreach ($bobotKriteria as $value) {
            array_push($nilaiEigen, BobotKriteria::orderByRaw('bobot_kriteria.kriteria1 ASC, bobot_kriteria.kriteria2 ASC')
                                                    ->where('kriteria1', $value->kriteria1)
                                                    ->get(['bobot']));
        }

        // dd($nilaiEigen);
        // return response()->json(['status'=>'success', 'data'=>$nilaiEigen],200);
        return view('pages.bobot-kriteria.index', compact(
            'kriteria',
            'bobot',
        ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'kriteria_1' => 'required',
                'nilai' => 'required',
                'kriteria_2' => 'required'
            ]);

            // START // update nilai bobot
            if($request->kriteria_1 === $request->kriteria_2){
                // update nilai bobot sesuai dengan kriteria yg dipilih pada form select pertama
                BobotKriteria::where('kriteria1', $request->kriteria_1)->where('kriteria2', $request->kriteria_2)->update(['bobot' => 1]);
            }else{
                // update nilai bobot sesuai dengan kriteria yg dipilih pada form select pertama
                BobotKriteria::where('kriteria1', $request->kriteria_1)->where('kriteria2', $request->kriteria_2)->update(['bobot' => $request->nilai]);
                
                // update nilai bobot sesuai dengan kriteria yg dipilih pada form select kedua
                BobotKriteria::where('kriteria1', $request->kriteria_2)->where('kriteria2', $request->kriteria_1)->update(['bobot' => 1/$request->nilai]);
            }
            // END // update nilai bobot

            // jumlah sesuai dengan kriteria yg dipilih pada form select pertama
            $jumlahBobotKriteria1 = BobotKriteria::where('kriteria2', $request->kriteria_1)->sum('bobot');
            // jumlah sesuai dengan kriteria yg dipilih pada form select kedua
            $jumlahBobotKriteria2 = BobotKriteria::where('kriteria2', $request->kriteria_2)->sum('bobot');

            // START // update jumlah bobot salah satu kriteria
            Kriteria::where('kode', $request->kriteria_2)->update([
                'jumlah_bobot' => $jumlahBobotKriteria2
            ]);
            // jika kriteria1 beda dgn kriteria2, baru akan diupdate
            if($request->kriteria_1 !== $request->kriteria_2){
                Kriteria::where('kode', $request->kriteria_1)->update([
                    'jumlah_bobot' => $jumlahBobotKriteria1
                ]);
            }
            // END // update jumlah bobot salah satu kriteria

            // START // update nilai eigen
            if($request->kriteria_1 === $request->kriteria_2){
                // diambil sesuai dengan kriteria yg dipilih pada form select kedua
                $daftarBobotKriteriaPertama = BobotKriteria::where('kriteria2', $request->kriteria_2)->get();

                foreach ($daftarBobotKriteriaPertama as $value) {
                    $temp = BobotKriteria::where('id',$value->id)->first();
                    BobotKriteria::where('id',$value->id)->update(['eigen' => $temp->bobot/$jumlahBobotKriteria2]);
                }
            }else{
                // diambil sesuai dengan kriteria yg dipilih pada form select kedua
                $daftarBobotKriteriaPertama = BobotKriteria::where('kriteria2', $request->kriteria_2)->get();

                foreach ($daftarBobotKriteriaPertama as $value) {
                    $temp = BobotKriteria::where('id',$value->id)->first();
                    BobotKriteria::where('id',$value->id)->update(['eigen' => $temp->bobot/$jumlahBobotKriteria2]);
                }

                // diambil sesuai dengan kriteria yg dipilih pada form select kedua
                $daftarBobotKriteriaKedua = BobotKriteria::where('kriteria2', $request->kriteria_1)->get();

                foreach ($daftarBobotKriteriaKedua as $value) {
                    $temp = BobotKriteria::where('id',$value->id)->first();
                    BobotKriteria::where('id',$value->id)->update(['eigen' => $temp->bobot/$jumlahBobotKriteria1]);
                }
            }
            // END // update nilai eigen

            // jumlah sesuai dengan kriteria yg dipilih pada form select pertama
            $jumlahEigenKriteria1 = BobotKriteria::where('kriteria1', $request->kriteria_1)->sum('eigen');
            // jumlah sesuai dengan kriteria yg dipilih pada form select kedua
            $jumlahEigenKriteria2 = BobotKriteria::where('kriteria1', $request->kriteria_2)->sum('eigen');

            // START // update jumlah dan rata-rata eigen
            $daftarKriteria = Kriteria::get(['id','kode']);
            foreach ($daftarKriteria as $value) {
                $jumlahEigen = BobotKriteria::where('kriteria1', $value->kode)->sum('eigen');
                Kriteria::where('kode', $value->kode)->update([
                    'jumlah_eigen' => $jumlahEigen,
                    'rata_eigen' => $jumlahEigen/sizeof($daftarKriteria)
                ]);
            }
            // END // update jumlah  dan rata-rata eigen

            Alert::success('Berhasil', "Bobot berhasil disimpan, 1 : ".$jumlahEigenKriteria1.", 2 : ".$jumlahEigenKriteria2."");
            DB::commit();

            return redirect()->route('bobot-kriteria.index');
        } catch (\Throwable $th) {
            //throw $th;
            Alert::error('Terjadi kesalahan', $th->getMessage());
            DB::rollback();
            return back();
        }
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

    }

    public function destroy($id)
    {
        //
    }
}
