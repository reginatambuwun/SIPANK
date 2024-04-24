<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodeNaikPangkat;
use App\Models\PeninjauanBerkas;
use App\Models\Berkas;
use App\Models\Alternatif;
use App\Models\Perankingan;
use RealRashid\SweetAlert\Facades\Alert;
use DB, Auth, File, Storage;

class PengajuanBerkasController extends Controller
{
    public function index()
    {
        $periode = PeriodeNaikPangkat::where('periode_naik_pangkat.status', 'sementara')
                                        ->where('alternatif.user_id', Auth::id())
                                        ->leftJoin('alternatif', 'alternatif.periode_id', 'periode_naik_pangkat.id')
                                        ->first(['periode_naik_pangkat.id as periode_id','periode_naik_pangkat.nama as nama_periode','alternatif.id as alternatif_id']);

        $alternatif = Alternatif::where('periode_id',$periode?->periode_id)->where('user_id',Auth::id())->first();
        $perankingan = Perankingan::where('periode_id',$periode?->periode_id)->where('alternatif_id',$alternatif?->id)->first(['direkomendasi']);

        $berkas = Berkas::where('periode_id', $periode?->periode_id)->where('alternatif_id', $periode?->alternatif_id)->first();
        
        $peninjauanBerkas = PeninjauanBerkas::where('periode_id', $periode?->periode_id)->where('alternatif_id', $periode?->alternatif_id)->orderBy('created_at', 'DESC')->first(['keterangan','status']);

        // dd($peninjauanBerkas);
        return view('pages.pengajuan-berkas.index', compact('periode','berkas','perankingan','peninjauanBerkas'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        
        $request->validate([
            'periode_id' => 'required',
            'alternatif_id' => 'required',
            'surat_pengantar_instansi'=> 'required|mimes:pdf|max:2048',
            'sk_cpns_pns'=> 'required|mimes:pdf|max:2048',
            'kartu_pegawai'=> 'required|mimes:pdf|max:2048',
            'skp'=> 'required|mimes:pdf|max:2048',
            'sk_pangkat_akhir'=> 'required|mimes:pdf|max:2048',
            'sk_jabatan_akhir'=> 'required|mimes:pdf|max:2048',
            'ijazah'=> 'required|mimes:pdf|max:2048'
        ],
        [
            'required' => 'Tidak boleh kosong.',
            'mimes' => 'Format berkas tidak sesuai.',
            'max' => 'Ukuran berkas melewati batas maksimal.'
        ]);

        try {          
            $data = Berkas::where('periode_id',$request->periode_id)->where('alternatif_id',$request->alternatif_id)->first();

            Berkas::where('periode_id',$request->periode_id)->where('alternatif_id',$request->alternatif_id)->update([
                'surat_pengantar_instansi' => $request->surat_pengantar_instansi ? $this->unggahBerkas($request->surat_pengantar_instansi, $data->surat_pengantar_instansi) : $data->surat_pengantar_instansi,
                'sk_cpns_pns' => $request->sk_cpns_pns ? $this->unggahBerkas($request->sk_cpns_pns, $data->sk_cpns_pns) : $data->sk_cpns_pns,
                'kartu_pegawai' => $request->kartu_pegawai ? $this->unggahBerkas($request->kartu_pegawai, $data->kartu_pegawai) : $data->kartu_pegawai,
                'skp' => $request->skp ? $this->unggahBerkas($request->skp, $data->skp) : $data->skp,
                'sk_pangkat_akhir' => $request->sk_pangkat_akhir ? $this->unggahBerkas($request->sk_pangkat_akhir, $data->sk_pangkat_akhir) : $data->sk_pangkat_akhir,
                'sk_jabatan_akhir' => $request->sk_jabatan_akhir ? $this->unggahBerkas($request->sk_jabatan_akhir, $data->sk_jabatan_akhir) : $data->sk_jabatan_akhir,
                'ijazah' => $request->ijazah ? $this->unggahBerkas($request->ijazah, $data->ijazah) : $data->ijazah,
                'status' => 'dikirim'
            ]);        

            Alert::success('Berhasil', "Berhasil mengirim berkas.");
            DB::commit();
            return redirect()->route('pengajuan-berkas.index');
        } catch (\Throwable $th) {
            //throw $th;

            Alert::error('Terjadi kesalahan', $th->getMessage());
            DB::rollback();
            return back();
        }
    }

    public function update(Request $request){
        DB::beginTransaction();
        
        $request->validate([
            'periode_id' => 'required',
            'alternatif_id' => 'required',
            'surat_pengantar_instansi'=> 'mimes:pdf|max:2048',
            'sk_cpns_pns'=> 'mimes:pdf|max:2048',
            'kartu_pegawai'=> 'mimes:pdf|max:2048',
            'skp'=> 'mimes:pdf|max:2048',
            'sk_pangkat_akhir'=> 'mimes:pdf|max:2048',
            'sk_jabatan_akhir'=> 'mimes:pdf|max:2048',
            'ijazah'=> 'mimes:pdf|max:2048'
        ],
        [
            'required' => 'Tidak boleh kosong.',
            'mimes' => 'Format berkas tidak sesuai.',
            'max' => 'Ukuran berkas melewati batas maksimal.'
        ]);

        try {          
            $data = Berkas::where('periode_id',$request->periode_id)->where('alternatif_id',$request->alternatif_id)->first();

            // dd($request->except('_token','_method','periode_id','alternatif_id'));

            if(count($request->except('_token','_method','periode_id','alternatif_id')) > 0){
                Berkas::where('periode_id',$request->periode_id)->where('alternatif_id',$request->alternatif_id)->update([
                    'surat_pengantar_instansi' => $request->surat_pengantar_instansi ? $this->unggahBerkas($request->surat_pengantar_instansi, $data->surat_pengantar_instansi) : $data->surat_pengantar_instansi,
                    'sk_cpns_pns' => $request->sk_cpns_pns ? $this->unggahBerkas($request->sk_cpns_pns, $data->sk_cpns_pns) : $data->sk_cpns_pns,
                    'kartu_pegawai' => $request->kartu_pegawai ? $this->unggahBerkas($request->kartu_pegawai, $data->kartu_pegawai) : $data->kartu_pegawai,
                    'skp' => $request->skp ? $this->unggahBerkas($request->skp, $data->skp) : $data->skp,
                    'sk_pangkat_akhir' => $request->sk_pangkat_akhir ? $this->unggahBerkas($request->sk_pangkat_akhir, $data->sk_pangkat_akhir) : $data->sk_pangkat_akhir,
                    'sk_jabatan_akhir' => $request->sk_jabatan_akhir ? $this->unggahBerkas($request->sk_jabatan_akhir, $data->sk_jabatan_akhir) : $data->sk_jabatan_akhir,
                    'ijazah' => $request->ijazah ? $this->unggahBerkas($request->ijazah, $data->ijazah) : $data->ijazah,
                    'status' => 'dikirim'
                ]);        
                
                Alert::success('Berhasil', "Berhasil mengirim kembali berkas.");
            }else{
                Alert::success('Berhasil', "Tidak ada berkas yang dikirim.");
            }

            DB::commit();
            return redirect()->route('pengajuan-berkas.index');
        } catch (\Throwable $th) {
            //throw $th;

            Alert::error('Terjadi kesalahan', $th->getMessage());
            DB::rollback();
            return back();
        }
    }

    public function unggahBerkas($file,$type){
        if(File::exists(public_path('berkas/'.$type))){
            File::delete(public_path('berkas/'.$type));
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
    
        for ($i = 0; $i < 10; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        $fileName = $file?->getClientOriginalName().'---'.time().'-'.$randomString.'.'.$file?->extension();  
        $file?->move(public_path('berkas'), $fileName);

        return $fileName;
    }

    public function unduhBerkas($file){
        // dd($file);
        return response()->download(public_path('berkas/'.$file), explode("---",$file)[0]);
        // return Storage::download($file);
    }
}

