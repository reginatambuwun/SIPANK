<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Alternatif;
use App\Models\Berkas;
use App\Models\PeninjauanBerkas;
use App\Models\PeriodeNaikPangkat;
use App\Models\Pemberitahuan;
use RealRashid\SweetAlert\Facades\Alert;
use DB, Validator, Auth, File;

class PeriodeAlternatifController extends Controller
{
    public function index($id){
        $periode = PeriodeNaikPangkat::where('id',$id)->first(['nama']);
        $alternatif = Alternatif::where('alternatif.periode_id', $id)
                                    ->leftJoin('users', 'alternatif.user_id', 'users.id')
                                    ->leftJoin('berkas', 'berkas.alternatif_id', 'alternatif.id')
                                    ->get([
                                        'alternatif.id',
                                        'users.name as nama_pegawai',
                                        'berkas.status as status_berkas'
                                    ]);

        return view('pages.periode-alternatif.index', compact('periode','alternatif'));
    }

    public function detail($idPeriode, $idAlternatif){
        $periode = PeriodeNaikPangkat::where('id',$idPeriode)->first(['status']);
        $berkas = Berkas::where('periode_id',$idPeriode)->where('alternatif_id',$idAlternatif)->first();
        $peninjauan = PeninjauanBerkas::where('periode_id',$idPeriode)->where('alternatif_id',$idAlternatif)->orderBy('created_at', 'DESC')->first(['keterangan','status']);
        $pegawai = Alternatif::where('alternatif.id', $idAlternatif)->leftJoin('users', 'alternatif.user_id', 'users.id')->first(['users.name']);

        return view('pages.periode-alternatif.detail', compact('berkas','peninjauan','periode','pegawai'));
    }

    public function store(Request $request){
        DB::beginTransaction();
        
        $rules = ['periode_id' => 'required', 'alternatif_id' => 'required','status'=> 'required'];

        if($request->status === 'perbaikan') $rules += ['keterangan' => 'required'];

        $request->validate($rules,[
            'required' => 'Tidak boleh kosong.',
        ]);

        try {          
            PeninjauanBerkas::create([
                'periode_id' => $request->periode_id,
                'alternatif_id' => $request->alternatif_id,
                'keterangan' => $request->keterangan,
                'status' => $request->status
            ]); 
            
            Berkas::where('periode_id',$request->periode_id)->where('alternatif_id',$request->alternatif_id)->update([
                'status' => $request->status
            ]);

            $this->kirimPemberitahuan($request->periode_id, $request->alternatif_id, $request->status, $request->keterangan);

            Alert::success('Berhasil', "Berhasil meninjau berkas.");
            DB::commit();
            return redirect()->route('bkpsdm-periode-alternatif.detail',[$request->periode_id, $request->alternatif_id]);
        } catch (\Throwable $th) {
            //throw $th;

            Alert::error('Terjadi kesalahan', $th->getMessage());
            DB::rollback();
            return back();
        }
    }

    public function kirimPemberitahuan($idPeriode, $idAlternatif, $status, $keterangan){
        $periode = PeriodeNaikPangkat::where('id',$idPeriode)->first();
        $alternatif = Alternatif::where('alternatif.id',$idAlternatif)->leftJoin('users', 'alternatif.user_id', 'users.id')->first();

        $html = ''; $subject ='';

        if($status === 'perbaikan'){
            $html = "<p>Berkas yang dikirim untuk pengajuan kenaikan pangkat pada periode <strong>".$periode->nama."</strong> harus diperbaiki.</p><br><p><strong>Keterangan:</strong></p><p>".$keterangan ?? '-'."</p>";
            $subject = "Perbaikan Berkas Pengajuan Naik Pangkat";

            Pemberitahuan::create([
                'user_id' => $alternatif->user_id,
                'keterangan' => $html,
                'status' => 'perbaikan_berkas'
            ]);
        }else if($status === 'diterima'){
            $html = "<p>Berkas yang dikirim untuk pengajuan kenaikan pangkat pada periode <strong>".$periode->nama."</strong> telah diterima.</p><br><p><strong>Keterangan:</strong></p><p>".$keterangan ?? '-'."</p>";
            $subject = "Berkas Pengajuan Naik Pangkat Diterima";

            Pemberitahuan::create([
                'user_id' => $alternatif->user_id,
                'keterangan' => $html,
                'status' => 'berkas_diterima'
            ]);
        }else if($status === 'sk_kp_dikirim'){
            $html = "<p>Surat keputusan kenaikan pangkat pada periode <strong>".$periode->nama."</strong> telah dikirim.</p>";
            $subject = "SK Kenaikan Pangkat Dikirim";
            
            Pemberitahuan::create([
                'user_id' => $alternatif->user_id,
                'keterangan' => $html,
                'status' => 'sk_kp_dikirim'
            ]);
        }

        \Mail::send('email', ['body'=>$html], function($msg) use($subject,$alternatif){
            $msg->from('dlhminahasa896@gmail.com', 'BKPSDM Minahasa');
            $msg->to($alternatif->email)->subject($subject);
        });
    }

    public function kirimSkKp(Request $request){
        DB::beginTransaction();

        $request->validate([
            'periode_id' => 'required', 
            'alternatif_id' => 'required',
            'sk_kp'=> 'required|mimes:pdf|max:2048'
        ],[
            'required' => 'Tidak boleh kosong.',
            'mimes' => 'Format berkas tidak sesuai.',
            'max' => 'Ukuran berkas melewati batas maksimal.'
        ]);

        try {    

            $check = Berkas::where('periode_id',$request->periode_id)->where('sk_kp','=',null)->count();

            // jika tersisa 1, berarti ini adalah alternatif terakhir yang akan dikirim berkas
            // jadi admin akan menerima notifikasi
            if($check === 1){
                $periode = PeriodeNaikPangkat::where('id',$request->periode_id)->first();

                $html = "<p>Semua pegawai yang terdaftar dalam periode <strong>".$periode->nama."</strong> untuk pengajuan kenaikan pangkat telah menerima SK KP.</p>";
                $subject = "Semua Pegawai Telah Menerima SK KP";

                \Mail::send('email', ['body'=>$html], function($msg) use($subject){
                    $msg->from('bkpsdmminahasa73@gmail.com', 'BKPSDM Minahasa');
                    $msg->to('dlhminahasa896@gmail.com')->subject($subject);
                });

                $user = User::where('role','admin')->first();

                Pemberitahuan::create([
                    'user_id' => $user?->id,
                    'keterangan' => $html,
                    'status' => 'semua_sk_kp_dikirim'
                ]);
            }

            $data = Berkas::where('periode_id',$request->periode_id)->where('alternatif_id',$request->alternatif_id)->first();

            Berkas::where('periode_id',$request->periode_id)->where('alternatif_id',$request->alternatif_id)->update([
                'sk_kp' => $request->sk_kp ? $this->unggahBerkas($request->sk_kp, $data->sk_kp) : $data->sk_kp,
            ]);        
            
            $this->kirimPemberitahuan($request->periode_id, $request->alternatif_id, 'sk_kp_dikirim', null);


            Alert::success('Berhasil', "Berhasil mengirim berkas.");

            DB::commit();
            return redirect()->route('bkpsdm-periode-alternatif.detail',[$request->periode_id, $request->alternatif_id]);
        } catch (\Throwable $th) {
            //throw $th;

            Alert::success('Berhasil', $th->getMessage());
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

        $fileName = time().'-'.$randomString.'.'.$file?->extension();  
        $file?->move(public_path('berkas'), $fileName);

        return $fileName;
    }

}
