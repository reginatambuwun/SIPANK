<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use App\Models\Alternatif;
use App\Models\DetailAlternatif;
use App\Models\PeriodeNaikPangkat;
use App\Models\Perankingan;
use App\Models\Berkas;
use App\Models\Pemberitahuan;
use App\Models\Pegawai;
use DB, DataTables, Validator, Route;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class AlternatifController extends Controller
{

    public function index($id)
    {
        // route menggunakan parameter id periode, jika data periode dgn id tersebut tidak tersedia, return 404
        if (!PeriodeNaikPangkat::find($id)) return abort(404);

        // START // daftar kriteria sesuai dengan periode
        $temp = Alternatif::where('periode_id',$id)->first();
        $kriteria = DetailAlternatif::leftJoin('kriteria', 'detail_alternatif.kriteria_id', 'kriteria.id')->orderBy('kriteria.created_at','ASC') // join agar bisa orderBy sesuai dengan created_at pada tabel kriteria
                                        ->where('alternatif_id',$temp?->id)->get(['nama_kriteria']);
        // END // daftar kriteria sesuai dengan periode

        $alternatif = Alternatif::where('periode_id',$id)->leftJoin('users', 'alternatif.user_id', 'users.id')
                                    ->orderBy('alternatif.created_at', 'ASC')
                                    ->get(['alternatif.id','users.name as nama_pengguna']);

        $daftarAlternatif = [];
        foreach ($alternatif as $value) {
            $temp = DetailAlternatif::leftJoin('kriteria', 'detail_alternatif.kriteria_id', 'kriteria.id')->orderBy('kriteria.created_at','ASC') // join agar bisa orderBy sesuai dengan created_at pada tabel kriteria
                                        ->where('alternatif_id', $value->id)->get(['nama_subkriteria']);

            $ranking = Perankingan::where('periode_id', $id)->where('alternatif_id', $value->id)->first(['nilai']);

            array_push($daftarAlternatif, ['id'=>$value->id,'nama_pegawai'=>$value->nama_pengguna,'subkriteria'=>$temp, 'nilai'=>$ranking->nilai]);
        }

        // return response()->json(['status'=>'success', 'data'=>$daftarAlternatif],200);
        // dd($daftarAlternatif,$id);
        return view('pages.alternatif.index', compact('kriteria','daftarAlternatif'));
    }

    public function create()
    {
        $idPeriode = Route::current()->parameter('id');

        // route menggunakan parameter id periode, jika data periode dgn id tersebut tidak tersedia, return 404
        if (!PeriodeNaikPangkat::find($idPeriode)) return abort(404);

        $pengguna = User::where('role','pegawai')->whereNotIn('id',Alternatif::where('periode_id',$idPeriode)->pluck('user_id'))->get(['id','name']);
        $kriteria = Kriteria::orderBy('kode','ASC')->get(['id','nama']);
        
        $daftarKriteria = [];
        foreach ($kriteria as $value) {
            $temp = SubKriteria::where('kriteria_id', $value->id)->orderBy('created_at', 'ASC')->get(['id','nama']);
            array_push($daftarKriteria, ['kriteria_id'=>$value->id, 'nama_kriteria'=>$value->nama, 'subkriteria'=>$temp]);
        }
        // dd($daftarKriteria);
        return view('pages.alternatif.create', compact('daftarKriteria','pengguna'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        // START // jika status telah selesai, tidak dapat mengubah data
        $check = PeriodeNaikPangkat::where('id',$request->periode_id)->first();
        if($check->status === 'selesai'){
            Alert::warning('Terjadi kesalahan', "Tidak dapat menambah alternatif baru karena status periode telah selesai.");
            return redirect()->route('alternatif.index',$request->periode_id);
        }
        // END // jika status telah selesai, tidak dapat mengubah data

        $kriteria = Kriteria::orderBy('kode','ASC')->get(['id','nama']);

        // START // mengatur rules secara dinamis sesuai dengan daftar kriteria yg ada
        $rules = ['user_id' => 'required','periode_id' => 'required'];
        // foreach ($kriteria as $value) {
        //     $rules += [$value->id => 'required'];
        // }
        // END // mengatur rules secara dinamis sesuai dengan daftar kriteria yg ada
        // dd($request->all());
        $this->validate($request,$rules,['required'=>'Tidak boleh kosong.']);

        try {
            // dd($request->periode_id);
            $alternatif = Alternatif::create([
                'periode_id'=>$request->periode_id,
                'user_id'=>$request->user_id,
            ]);

            $detailAlternatif = [];
            foreach ($kriteria as $key => $value) {
                $subkriteria = SubKriteria::where('id',$request->get($value->id))->first(['nama']);
                array_push($detailAlternatif, [
                    'id' => Str::uuid()->toString(),
                    'alternatif_id' => $alternatif->id,
                    'kriteria_id' => $value->id,
                    'nama_kriteria' => $value->nama,
                    'subkriteria_id' => $request->get($value->id),
                    'nama_subkriteria' => $subkriteria?->nama,
                    'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                ]);
            }

            if($alternatif){
                DetailAlternatif::insert($detailAlternatif);
                Berkas::create([
                    'periode_id' => $request->periode_id,
                    'alternatif_id' => $alternatif->id,
                ]);
            }

            $this->updateNilaiPerankingan($request->periode_id, $alternatif->id);
            $this->kirimPemberitahuan($request->periode_id, $request->user_id);

            Alert::success('Berhasil', "Alternatif berhasil disimpan");
            DB::commit();

            return redirect()->route('alternatif.index',$request->periode_id);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            // dd($th->getMessage());
            Alert::error('Terjadi kesalahan', $th->getMessage());
            return back();
        }
    }

    public function kirimPemberitahuan($idPeriode, $idUser){
        $periode = PeriodeNaikPangkat::where('id',$idPeriode)->first();
        $user = User::where('id', $idUser)->first();

        $html = "<p>Anda terdaftar pada periode <strong>".$periode->nama."</strong> untuk pengajuan kenaikan pangkat.</p><p>Untuk proses selanjutnya akan diinfokan kembali.</p>";

        Pemberitahuan::create([
            'user_id' => $idUser,
            'keterangan' => $html,
            'status' => 'terdaftar_periode',
        ]);

        \Mail::send('email', ['body'=>$html], function($msg) use($user){
            $msg->from('dlhminahasa896@gmail.com', 'BKPSDM Minahasa');
            $msg->to($user?->email)->subject('Terdaftar Periode');
        });

        ///////////////////////////////////////////////////////////////

        $alternatif = Alternatif::where('periode_id', $idPeriode)->where('user_id', $idUser)->first();
        $perankingan = Perankingan::where('periode_id',$idPeriode)->where('alternatif_id', $alternatif?->id)->first();
        
        // dd($alternatif, $perankingan);
        $html = ''; $subject =''; $minNilai = 0.484; 
        // $maxNilai = 0.557;

        if($perankingan->nilai >= $minNilai){ // direkomendasi
            $html = "<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>".$periode->nama."</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>";
            $subject = "Direkomendasikan Pengajuan Naik Pangkat";

            Perankingan::where('periode_id',$idPeriode)->where('alternatif_id', $alternatif?->id)->update(['direkomendasi' => true]);

            Pemberitahuan::create([
                'user_id' => $idUser,
                'keterangan' => $html,
                'status' => 'rekomendasi_naik_pangkat',
            ]);
        }else{ // tidak direkomendasi
            $html = "<p>Anda belum direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>".$periode->nama."</strong>, karena salah satu atau kedua standar penilaian belum terpenuhi:</p>
                    <p></p>            
            ";
            $subject = "Belum Direkomendasikan Pengajuan Naik Pangkat";
            
            $detailAlternatif = DetailAlternatif::where('alternatif_id', $alternatif?->id)->get();

            foreach ($detailAlternatif as $value) {
                $html .= "<p>".$value->nama_kriteria." : ".$value->nama_subkriteria."</p>";
            }

            $html .= "<hr> <i>Standad Penilaian : Lamanya Masa Kerja minimal lebih dari 3 tahun & Kinerja Pegawai minimal 70.</i>";

            Perankingan::where('periode_id',$idPeriode)->where('alternatif_id', $alternatif?->id)->update(['direkomendasi' => false]);

            Pemberitahuan::create([
                'user_id' => $idUser,
                'keterangan' => $html,
                'status' => 'batal_rekomendasi_naik_pangkat',
            ]);
        }
        
        \Mail::send('email', ['body'=>$html], function($msg) use($subject,$user){
            $msg->from('dlhminahasa896@gmail.com', 'BKPSDM Minahasa');
            $msg->to($user->email)->subject($subject);
        });
    }

    public function updateNilaiPerankingan($idPeriode, $idAlternatif){
        $nilai = 0;

        $detailAlternatif = DetailAlternatif::where('alternatif_id',$idAlternatif)
                                                ->leftJoin('kriteria', 'detail_alternatif.kriteria_id', 'kriteria.id')
                                                ->leftJoin('sub_kriteria', 'detail_alternatif.subkriteria_id', 'sub_kriteria.id')
                                                ->get(['kriteria.rata_eigen as kriteria_rata_eigen', 'sub_kriteria.rata_eigen as subkriteria_rata_eiden']);

        foreach ($detailAlternatif as $value) {
            $nilai += $value->kriteria_rata_eigen * $value->subkriteria_rata_eiden;
        }
        // dd($nilai);
        $perankingan = Perankingan::where('periode_id', $idPeriode)->where('alternatif_id', $idAlternatif)->first();

        if($perankingan) {
            Perankingan::where('periode_id', $idPeriode)->where('alternatif_id', $idAlternatif)->update(['nilai'=>$nilai]);
        }else{
            Perankingan::create([
                'periode_id' => $idPeriode,
                'alternatif_id' => $idAlternatif,
                'nilai' => $nilai
            ]);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        // route menggunakan parameter id periode, jika data periode dgn id tersebut tidak tersedia, return 404
        if (!Alternatif::find($id)) return abort(404);
        
        $kriteria = Kriteria::orderBy('kode','ASC')->get(['id','nama']);
        $pengguna = Alternatif::where('alternatif.id',$id)->leftJoin('users', 'alternatif.user_id', 'users.id')->first();
        $periode = PeriodeNaikPangkat::where('id', $pengguna?->periode_id)->first(['id']);

        $daftarKriteria = [];
        foreach ($kriteria as $value) {
            $subkriteria = SubKriteria::where('kriteria_id', $value->id)->orderBy('created_at', 'ASC')->get(['id','nama']);
            $detailAlternatif = DetailAlternatif::where('alternatif_id',$id)->where('kriteria_id', $value->id)->first();
            array_push($daftarKriteria, [
                'kriteria_id'=>$value->id, 
                'nama_kriteria'=>$value->nama, 
                'subkriteria_id'=>$detailAlternatif->subkriteria_id, 
                'subkriteria'=>$subkriteria
            ]);
        }
        // return response()->json(['status'=>'success', 'data'=>$daftarKriteria],200);
        return view('pages.alternatif.edit', compact('periode','daftarKriteria','pengguna'));
        // dd($id);
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        $alternatif = Alternatif::find($id);

        // START // jika status telah selesai, tidak dapat mengubah data
        $check = PeriodeNaikPangkat::where('id',$alternatif->periode_id)->first();
        if($check->status === 'selesai'){
            Alert::warning('Terjadi kesalahan', "Tidak dapat diubah karena status periode telah selesai.");
            return redirect()->route('alternatif.index',$alternatif->periode_id);
        }
        // END // jika status telah selesai, tidak dapat mengubah data

        $kriteria = Kriteria::orderBy('kode','ASC')->get(['id','nama']);

        // START // mengatur rules secara dinamis sesuai dengan daftar kriteria yg ada
        $rules = [];
        foreach ($kriteria as $value) {
            $rules += [$value->id => 'required'];
        }
        // END // mengatur rules secara dinamis sesuai dengan daftar kriteria yg ada

        $this->validate($request,$rules,['required'=>'Tidak boleh kosong.']);

        try {
            $detailAlternatif = [];
            foreach ($kriteria as $key => $value) {
                $subkriteria = SubKriteria::where('id',$request->get($value->id))->first(['nama']);
                array_push($detailAlternatif, [
                    'id' => Str::uuid()->toString(),
                    'alternatif_id' => $id,
                    'kriteria_id' => $value->id,
                    'nama_kriteria' => $value->nama,
                    'subkriteria_id' => $request->get($value->id),
                    'nama_subkriteria' => $subkriteria?->nama,
                    'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                ]);
            }

            DetailAlternatif::where('alternatif_id', $id)->delete(); // hapus detail alternatif sesuai dgn alternatif yg dipilih
            DetailAlternatif::insert($detailAlternatif);

            $this->updateNilaiPerankingan($alternatif->periode_id, $id);
            $this->kirimPemberitahuan($alternatif->periode_id, $alternatif->user_id);

            Alert::success('Berhasil', "Alternatif berhasil disimpan");
            DB::commit();
            
            return redirect()->route('alternatif.index',$alternatif->periode_id);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            // dd($th->getMessage());
            Alert::error('Terjadi kesalahan', $th->getMessage());
            return back();
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            Alternatif::where('id',$id)->delete();
            DetailAlternatif::where('alternatif_id',$id)->delete();
            Berkas::where('alternatif_id',$id)->delete();
            Perankingan::where('alternatif_id',$id)->delete();

            Alert::success('Berhasil', "Alternatif berhasil dihapus");
            DB::commit();

            return response()->json(['status'=>'success', 'message'=>'Berhasil dihapus.'],200);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }

    public function kalkulasi($userId, $periodeId)
    {
        try {
            // $user = User::where('users.id',$id)->first(['id','name','email']);

            $pegawai = Pegawai::where('user_id', $userId)->first(['tmt_sk_akhir', 'nilai_skp']);
            $periode = PeriodeNaikPangkat::where('id', $periodeId)->first(['created_at']);

            if(!$pegawai){
                return response()->json(['status'=>'validation error','message'=>'Data pegawai tidak ditemukan.'],500);
            }elseif(!$pegawai->tmt_sk_akhir){
                return response()->json(['status'=>'validation error','message'=>'Data TMT SK Akhir pegawai tidak tersedia.'],500);
            }elseif(!$pegawai->nilai_skp){
                return response()->json(['status'=>'validation error','message'=>'Data Nilai SKP pegawai tidak tersedia.'],500);
            }

            // START // hitung jumlah hari & tahun
            $diff = strtotime($periode->created_at) - strtotime($pegawai->tmt_sk_akhir);
            $countDays = abs(round($diff / 86400));
            $year = $countDays / 365;
            // END // hitung jumlah hari & tahun

            $lamaMasaKerja = ''; $kinerjaPegawai = '';
            
            if($year > 3) $lamaMasaKerja = '8680423c-d029-4645-b532-9d809af606e3';
            elseif($year > 2 && $year <=3) $lamaMasaKerja = 'e17f32ba-4981-4801-9cfa-aea4cc6dfd19';
            elseif($year > 1 && $year <=2) $lamaMasaKerja = 'b3fb1ffb-f0c4-497c-a808-1d12837f9246';
            elseif($year <=1) $lamaMasaKerja = '672abd5d-14dd-4738-82f6-d4db81defaa6';

            if($pegawai->nilai_skp >= 90 && $pegawai->nilai_skp <= 100) $kinerjaPegawai = '37a2340e-e13e-4682-956e-cbed14cfdb1a';
            elseif($pegawai->nilai_skp >= 70 && $pegawai->nilai_skp <= 89) $kinerjaPegawai = 'a3e44379-2200-48fc-8abe-de688291fa62';
            elseif($pegawai->nilai_skp >= 50 && $pegawai->nilai_skp <= 69) $kinerjaPegawai = '99fe40d8-c78d-494c-9118-029c9610888a';
            elseif($pegawai->nilai_skp < 50) $kinerjaPegawai = 'd024f740-7af0-44f3-8e7c-5ec53c3a0b1f';

            return response()->json(['status'=>'success', 'data'=>['lamaMasaKerja' => $lamaMasaKerja, 'kinerjaPegawai' => $kinerjaPegawai], 'tes' => [$year, $countDays]],200); 
            
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }

}
