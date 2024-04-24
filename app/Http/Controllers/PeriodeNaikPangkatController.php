<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeriodeNaikPangkat;
use App\Models\Alternatif;
use App\Models\DetailAlternatif;
use DB, DataTables, Validator;

class PeriodeNaikPangkatController extends Controller
{

    public function daftarPeriode(){
        $periode = PeriodeNaikPangkat::orderBy('created_at', 'DESC')->get(['id','kode','nama']);
        return view('pages.daftar-periode.index', compact('periode'));
    }

    public function index()
    {
        return view('pages.periode-naik-pangkat.index');
    }

    public function create()
    {
        try {
            // START // jika ada periode yg belum selesai, tidak dapat menambah periode baru
            if(PeriodeNaikPangkat::where('status','sementara')->first()) return response()->json(['status'=>'warning','message'=>'Tidak dapat menambah periode baru, masih ada periode yang belum selesai.'],400);
            // END // jika ada periode yg belum selesai, tidak dapat menambah periode baru

            $data = PeriodeNaikPangkat::orderBy('created_at', 'DESC')->first(['kode']);
            return response()->json(['status'=>'success', 'data'=>$data],200); 
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            // START // jika ada periode yg belum selesai, tidak dapat menambah periode baru
            if(PeriodeNaikPangkat::where('status','sementara')->first()) return response()->json(['status'=>'warning','message'=>'Tidak dapat menambah periode baru, masih ada periode yang belum selesai.'],400);
            // END // jika ada periode yg belum selesai, tidak dapat menambah periode baru
            
            $rules = [
                'kode' => 'required',
                'nama' => 'required',
                'status' => 'required',
            ];
    
            $messages  = [
                'kode.required' => 'Kode : Tidak boleh kosong.',
                'nama.required' => 'Nama : Tidak boleh kosong.',
                'status.required' => 'Status : Tidak boleh kosong.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if($validator->fails()) {
                return response()->json(['status'=>'validation error','message'=>$validator->messages()],400);
            }else{                 
                PeriodeNaikPangkat::create([
                    'kode' => $request->kode,
                    'nama' => $request->nama,
                    'status' => $request->status,
                ]);

                DB::commit();
                return response()->json(['status'=>'success', 'message'=>'Berhasil disimpan.'],200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        try {
            // START // jika status telah selesai, tidak dapat mengubah data
            $check = PeriodeNaikPangkat::where('id',$id)->first();
            if($check->status === 'selesai') return response()->json(['status'=>'warning','message'=>'Tidak dapat merubah data periode karena status telah selesai.'],400);
            // END // jika status telah selesai, tidak dapat mengubah data  

            $data = PeriodeNaikPangkat::where('id',$id)->first(['id','kode','nama','status']);
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
            $check = PeriodeNaikPangkat::where('id',$id)->first();
            if($check->status === 'selesai') return response()->json(['status'=>'warning','message'=>'Tidak dapat merubah data periode karena status telah selesai.'],400);
            // END // jika status telah selesai, tidak dapat mengubah data

            $rules = [
                'nama' => 'required',
                'status' => 'required',
            ];
    
            $messages  = [
                'nama.required' => 'Nama : Tidak boleh kosong.',
                'status.required' => 'Status : Tidak boleh kosong.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if($validator->fails()) {
                return response()->json(['status'=>'validation error','message'=>$validator->messages()],400);
            }else{                
                PeriodeNaikPangkat::where('id',$id)->update([
                    'nama' => $request->nama,
                    'status' => $request->status,
                ]);
    
                DB::commit();
                return response()->json(['status'=>'success', 'message'=>'Berhasil disimpan.'],200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            PeriodeNaikPangkat::find($id)->delete();

            $alternatif = Alternatif::where('periode_id',$id)->get(['id']);
            foreach ($alternatif as $value) {
                DetailAlternatif::where('alternatif_id',$value->id)->delete();
            }
            Alternatif::where('periode_id',$id)->delete();

            DB::commit();
            return response()->json(['status'=>'success', 'message'=>'Berhasil dihapus.'],200);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }

    public function datatable(){
        // mengambil data
        $data = DB::table('periode_naik_pangkat')
                        ->orderBy('created_at','DESC')
                        ->select(
                            'periode_naik_pangkat.id',
                            'periode_naik_pangkat.kode',
                            'periode_naik_pangkat.nama',
                            'periode_naik_pangkat.status',
                        )->get();

        return Datatables::of($data)->addIndexColumn()
            ->addIndexColumn()
            ->addColumn('kode', function ($data) {
                return "K-".$data->kode."";
            })
            ->addColumn('nama', function ($data) {
                return $data->nama;
            })
            ->addColumn('status', function ($data) {
                if($data->status === 'selesai') return '<h6><span class="badge badge-success">Selesai</span></h6>';
                else if($data->status === 'sementara') return '<h6><span class="badge badge-info">Sementara</span></h6>';
            })
            ->addColumn('action', function($data){
                return '
                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm show-edit-modal"><i class="fas fa-edit"></i></a>
                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$data->id.'" data-original-title="Delete" class="btn btn-danger btn-sm show-delete-modal"><i class="fas fa-trash-alt"></i></a>
                ';
            })
            ->rawColumns(['status','action'])
            ->make(true);
    }
}
