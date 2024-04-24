<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Perankingan;
use App\Models\PeriodeNaikPangkat;
use App\Models\Alternatif;
use App\Models\Pemberitahuan;
use DB, DataTables, Validator;

class RekomendasiController extends Controller
{
    public function index($id)
    {
        $periode = PeriodeNaikPangkat::where('id',$id)->first(['nama']);

        return view('pages.rekomendasi.index', compact('periode'));
    }

    public function edit($id)
    {
        try {
            // START // jika status telah selesai, tidak dapat mengubah data
            $check = Perankingan::where('perankingan.id',$id)
                                ->leftJoin('periode_naik_pangkat', 'perankingan.periode_id', 'periode_naik_pangkat.id')
                                ->first();
            if($check->status === 'selesai') return response()->json(['status'=>'warning','message'=>'Tidak dapat diubah karena status periode telah selesai.'],400);
            // END // jika status telah selesai, tidak dapat mengubah data  

            $data = Perankingan::where('id',$id)->first(['id','direkomendasi']);
            return response()->json(['status'=>'success', 'data'=>$data],200); 
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // START // jika status telah selesai, tidak dapat mengubah data
            $check = Perankingan::where('perankingan.id',$id)
                                ->leftJoin('periode_naik_pangkat', 'perankingan.periode_id', 'periode_naik_pangkat.id')
                                ->first();
            if($check->status === 'selesai') return response()->json(['status'=>'warning','message'=>'Tidak dapat diubah karena status periode telah selesai.'],400);
            // END // jika status telah selesai, tidak dapat mengubah data  

            $rules = [
                'direkomendasi' => 'required',
            ];
    
            $messages  = [
                'direkomendasi.required' => 'Nama : Tidak boleh kosong.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if($validator->fails()) {
                return response()->json(['status'=>'validation error','message'=>$validator->messages()],400);
            }else{                
                Perankingan::where('id',$id)->update([
                    'direkomendasi' => $request->direkomendasi
                ]);

                $this->kirimPemberitahuan($id, $request->direkomendasi);
    
                DB::commit();
                return response()->json(['status'=>'success', 'message'=>'Berhasil disimpan.'],200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }

    public function kirimPemberitahuan($id, $direkomendasi){
        $perankingan = Perankingan::where('id',$id)->first();
        $periode = PeriodeNaikPangkat::where('id',$perankingan->periode_id)->first();
        $alternatif = Alternatif::where('alternatif.id',$perankingan->alternatif_id)->leftJoin('users', 'alternatif.user_id', 'users.id')->first();

        $html = ''; $subject ='';

        if($direkomendasi === '0'){
            $html = "<p>Anda batal direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>".$periode->nama."</strong>.";
            $subject = "Batal Direkomendasikan Pengajuan Naik Pangkat";
            
            Pemberitahuan::create([
                'user_id' => $alternatif->user_id,
                'keterangan' => $html,
                'status' => 'batal_rekomendasi_naik_pangkat',
            ]);
        }else if($direkomendasi === '1'){
            $html = "<p>Anda direkomendasikan untuk pengajuan kenaikan pangkat pada periode <strong>".$periode->nama."</strong>.</p><p>Selanjutnya silahkan mengirim berkas untuk pengajuan sesuai dengan ketentuan.</p>";
            $subject = "Direkomendasikan Pengajuan Naik Pangkat";

            Pemberitahuan::create([
                'user_id' => $alternatif->user_id,
                'keterangan' => $html,
                'status' => 'rekomendasi_naik_pangkat',
            ]);
        }
        
        \Mail::send('email', ['body'=>$html], function($msg) use($subject,$alternatif){
            $msg->from('dlhminahasa896@gmail.com', 'BKPSDM Minahasa');
            $msg->to($alternatif->email)->subject($subject);
        });
    }

    public function datatable($id){
        // dd($id);
        $data = DB::table('perankingan')->where('alternatif.periode_id', $id)
                                        ->leftJoin('alternatif', 'perankingan.alternatif_id', 'alternatif.id')
                                        ->leftJoin('users', 'alternatif.user_id', 'users.id')
                                        ->orderBy('perankingan.nilai', 'DESC')
                                        ->get(['perankingan.id','users.name as nama_pengguna','perankingan.nilai','perankingan.direkomendasi']);

        return Datatables::of($data)->addIndexColumn()
            ->addIndexColumn()
            ->addColumn('nama_pengguna', function ($data) {
                return $data->nama_pengguna;
            })
            ->addColumn('nilai', function ($data) {
                return $data->nilai;
            })
            ->addColumn('direkomendasi', function ($data) {
                if($data->direkomendasi === 1){
                    return '<h6><span class="badge badge-success">Ya</span></h6>';
                }else{
                    return '<h6><span class="badge badge-secondary">Tidak</span></h6>';
                }
            })
            ->addColumn('action', function($data){
                if($data->direkomendasi === 1){
                    return '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-danger btn-sm show-update-status-modal"><i class="fas fa-user-times"></i></a>';
                }else{
                    return '<a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm show-update-status-modal"><i class="fas fa-user-check"></i></a>';
                }
            })
            ->rawColumns(['direkomendasi','action'])
            ->make(true);
    }
}
