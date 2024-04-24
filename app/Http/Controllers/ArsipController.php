<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Arsip;
use RealRashid\SweetAlert\Facades\Alert;
use DB, Auth, File;

class ArsipController extends Controller
{

    public function index()
    {
        $arsip = Arsip::where('user_id',Auth::id())->get();

        return view('pages.arsip.index', compact('arsip'));
    }

    public function create()
    {
        return view('pages.arsip.create');
    }

    public function store(Request $request){
        DB::beginTransaction();
        
        $request->validate([
            'nama' => 'required',
            'berkas'=> 'required|mimes:pdf|max:2048',
        ],
        [
            'required' => 'Tidak boleh kosong.',
            'mimes' => 'Format berkas tidak sesuai.',
            'max' => 'Ukuran berkas melewati batas maksimal.'
        ]);

        try {          

            Arsip::create([
                'user_id' => Auth::id(),
                'nama' => $request->nama,
                'berkas' => $this->unggahBerkas($request->berkas)
            ]);        

            Alert::success('Berhasil', "Berhasil menyimpan.");
            DB::commit();
            return redirect()->route('arsip.index');
        } catch (\Throwable $th) {
            //throw $th;

            Alert::error('Terjadi kesalahan', $th->getMessage());
            DB::rollback();
            return back();
        }
    }

    public function unggahBerkas($file){
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

    public function show($id)
    {
        $arsip = Arsip::find($id);
        if(!$arsip) return abort(404);

        return view('pages.arsip.detail', compact('arsip'));
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
        DB::beginTransaction();

        try {
            $data = Arsip::find($id);

            if(File::exists(public_path('berkas/'.$data->berkas))){
                File::delete(public_path('berkas/'.$data->berkas));
            }

            $data->delete();
            
            DB::commit();
            return response()->json(['status'=>'success', 'message'=>'Berhasil dihapus.'],200);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollback();
            return response()->json(['status'=>'failed','message'=>$th->getMessage()],500);
        }
    }
}
