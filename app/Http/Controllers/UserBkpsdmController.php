<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pegawai;
use DB, DataTables, Validator;
use RealRashid\SweetAlert\Facades\Alert;

class UserBkpsdmController extends Controller
{

    public function index()
    {
        return view('pages.user-bkpsdm.index');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
            ];
    
            $messages  = [
                'name.required' => 'Nama : Tidak boleh kosong.',
                'email.required' => 'Email : Tidak boleh kosong.',
                'email.email' => 'Email : Format tidak benar.',
                'email.unique' => 'Email : Telah digunakan.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if($validator->fails()) {
                return response()->json(['status'=>'validation error','message'=>$validator->messages()],400);
            }else{                 
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt("bkpsdm123"),
                    'role' => 'bkpsdm'
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
            $user = User::where('users.id',$id)->first(['id','name','email']);
            return response()->json(['status'=>'success', 'data'=>$user],200); 
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }

    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $rules = [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' .$id,
            ];

            $messages  = [
                'name.required' => 'Nama : Tidak boleh kosong.',
                'email.required' => 'Email : Tidak boleh kosong.',
                'email.email' => 'Email : Format tidak benar.',
                'email.unique' => 'Email : Telah digunakan.',
            ];
            
            $validator = Validator::make($request->all(), $rules, $messages);
        
            if($validator->fails()) {
                return response()->json(['status'=>'validation error','message'=>$validator->messages()],400);
            }else{               
                $data = User::where('id',$id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
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

    // public function update(Request $request, $id)
    // {
    //     DB::beginTransaction();
    //     // dd($request->all());
    //     $rules = [
    //         'nama_lengkap' => 'required',
    //         // 'email' => 'required|email|unique:users,email,' .$id,
    //         'nip' => 'required',
    //         'nipl' => 'required',
    //         'jabatan' => 'required',
    //         'gelar_depan' => 'required',
    //         'gelar_belakang' => 'required',
    //         'tempat_lahir' => 'required',
    //         'tanggal_lahir' => 'required',
    //         'jenis_kelamin' => 'required',
    //         'gol_darah' => 'required',
    //         'identitas_diri' => 'required',
    //         'nomor_identitas' => 'required',
    //         'npwp' => 'required',
    //         'alamat' => 'required',
    //         'kelurahan_desa' => 'required',
    //         'kecamatan' => 'required',
    //         'kab_kota' => 'required',
    //         'kode_pos' => 'required',
    //         'no_telp' => 'required',
    //         'agama' => 'required',
    //         'status_pernikahan' => 'required',
    //         'tinggi' => 'required',
    //         'berat_badan' => 'required',
    //         'hobi' => 'required',
    //         'tmt_bekerja_cpns' => 'required',
    //         'tmt_sk_akhir' => 'required',
    //         'gol_ruang_awal' => 'required',
    //     ];

    //     $messages  = [
    //         'required' => 'Tidak boleh kosong.',
    //         'email' => 'Format tidak benar.',
    //         'unique' => 'Telah digunakan.',
    //     ];
        
    //     $this->validate($request,$rules,$messages);

    //     try {     
    //         // dd($request->all());          
    //         User::where('id',$id)->update([
    //             'name' => $request->nama_lengkap,
    //             // 'email' => $request->email,
    //             'nip' => $request->nip,
    //         ]);

    //         Pegawai::where('user_id',$id)->update([
    //             'nipl' => $request->nipl,
    //             'jabatan' => $request->jabatan,
    //             'gelar_depan' => $request->gelar_depan,
    //             'gelar_belakang' => $request->gelar_belakang,
    //             'tempat_lahir' => $request->tempat_lahir,
    //             'tanggal_lahir' => $request->tanggal_lahir,
    //             'jenis_kelamin' => $request->jenis_kelamin,
    //             'gol_darah' => $request->gol_darah,
    //             'identitas_diri' => $request->identitas_diri,
    //             'nomor_identitas' => $request->nomor_identitas,
    //             'jabatan' => $request->jabatan,
    //             'npwp' => $request->npwp,
    //             'alamat' => $request->alamat,
    //             'kelurahan_desa' => $request->kelurahan_desa,
    //             'kecamatan' => $request->kecamatan,
    //             'kab_kota' => $request->kab_kota,
    //             'kode_pos' => $request->kode_pos,
    //             'no_telp' => $request->no_telp,
    //             'agama' => $request->agama,
    //             'status_pernikahan' => $request->status_pernikahan,
    //             'tinggi' => $request->tinggi,
    //             'berat_badan' => $request->berat_badan,
    //             'hobi' => $request->hobi,
    //             'tmt_bekerja_cpns' => $request->tmt_bekerja_cpns,
    //             'tmt_sk_akhir' => $request->tmt_sk_akhir,
    //             'gol_ruang_awal' => $request->gol_ruang_awal,
    //         ]);

    //         Alert::success('Berhasil', "Berhasil disimpan");
    //         DB::commit();

    //         return redirect()->route('pengguna.edit',$id);
    //     } catch (\Throwable $th) {
    //         //throw $th;
    //         DB::rollback();
    //         dd($th->getMessage());
    //         return back();
    //     }
    // }

    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            User::find($id)->delete();

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
        $userList = DB::table('users')
                        ->where('role','bkpsdm')
                        ->orderBy('created_at', 'DESC')
                        ->select(
                            'id',
                            'name',
                            'email',
                        )->get();

        return Datatables::of($userList)->addIndexColumn()
            ->addIndexColumn()
            ->addColumn('name', function ($userList) {
                return $userList->name;
            })
            ->addColumn('email', function ($userList) {
                return $userList->email;
            })
            ->addColumn('action', function($userList){
                return '
                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$userList->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm show-edit-modal"><i class="fas fa-edit"></i></a>
                    <a href="javascript:void(0)" data-toggle="tooltip" data-id="'.$userList->id.'" data-original-title="Delete" class="btn btn-danger btn-sm show-delete-modal"><i class="fas fa-trash-alt"></i></a>
                ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
