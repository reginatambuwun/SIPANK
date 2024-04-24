<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pegawai;
use RealRashid\SweetAlert\Facades\Alert;
use DB, Auth, File;

class ProfilController extends Controller
{
    public function index()
    {
        if(Auth::user()->role === 'pegawai'){
            $data = User::where('users.id',Auth::id())->leftJoin('pegawai', 'pegawai.user_id', 'users.id')->first(['name','email','nip','jabatan','image']);
        }else{
            $data = User::where('users.id',Auth::id())->first();
        }

        return view('pages.profil.index',compact('data'));
    }

    public function ubahProfilPegawai(Request $request){
        DB::beginTransaction();
        
        $rules = [
            'name' => 'required',
            // 'nip' => 'required',
            // 'jabatan' => 'required',
        ];

        if($request->password) $rules += ['password'=>'min:8|confirmed'];

        $request->validate($rules,
        [
            'required' => 'Tidak boleh kosong.',
            'min' => 'Minimal :min karakter. ',
            'confirmed' => 'Konfirmasi sandi tidak cocok. '
        ]);

        try {
            $user = User::where('id',Auth::id())->first();
            $user->update([
                'name' => $request->name,
                // 'nip' => $request->nip,
                'password' => $request->password ? bcrypt($request->password) : $user->password,
                'image' => $request->image ? $this->unggahBerkas($request->image, $user->image) : $user->image,
            ]);

            // Pegawai::where('user_id',Auth::id())->update([
            //     'jabatan' => $request->jabatan
            // ]);

            Alert::success('Berhasil', "Berhasil menyimpan.");
            DB::commit();
            return redirect()->route('profil');
        } catch (\Throwable $th) {
            //throw $th;

            Alert::error('Terjadi kesalahan', $th->getMessage());
            DB::rollback();
            return back();
        }
    }

    public function ubahProfilUser(Request $request){
        DB::beginTransaction();
        
        $rules = [
            'name' => 'required',
        ];

        if($request->password) $rules += ['password'=>'min:8|confirmed'];

        $request->validate($rules,
        [
            'required' => 'Tidak boleh kosong.',
            'min' => 'Minimal :min karakter. ',
            'confirmed' => 'Konfirmasi sandi tidak cocok. '
        ]);

        // dd($request->all());

        try {
            $user = User::where('id',Auth::id())->first();
            $user->update([
                'name' => $request->name,
                'password' => $request->password ? bcrypt($request->password) : $user->password,
                'image' => $request->image ? $this->unggahBerkas($request->image, $user->image) : $user->image,
            ]);

            Alert::success('Berhasil', "Berhasil menyimpan.");
            DB::commit();
            return redirect()->route('profil');
        } catch (\Throwable $th) {
            //throw $th;

            Alert::error('Terjadi kesalahan', $th->getMessage());
            DB::rollback();
            return back();
        }
    }

    public function unggahBerkas($file,$type){
        if(File::exists(public_path('image/'.$type))){
            File::delete(public_path('image/'.$type));
        }

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
    
        for ($i = 0; $i < 10; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        $fileName = time().'-'.$randomString.'.'.$file?->extension();  
        $file?->move(public_path('image'), $fileName);

        return $fileName;
    }

    public function detail(){ 
        $data = User::where('users.id', Auth::id())->leftJoin('pegawai', 'pegawai.user_id', 'users.id')->first();

        // dd($data);
        return view('pages.profil.detail', compact('data'));
    }
}
