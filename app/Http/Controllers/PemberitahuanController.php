<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemberitahuan;
use Auth;

class PemberitahuanController extends Controller
{
    public function index(){
        $pemberitahuan = Pemberitahuan::where('user_id', Auth::id())->orderBy('created_at','DESC')->paginate(10);

        // dd($pemberitahuan);
        return view('pages.pemberitahuan.index', compact('pemberitahuan'));
    }

    public function detail($id){
        $pemberitahuan = Pemberitahuan::where('id',$id)->first();

        if (!$pemberitahuan) {
            return abort(404);
        }

        if($pemberitahuan && $pemberitahuan->dibaca === 0){
            $pemberitahuan->update(['dibaca'=>true]);
        }

        return view('pages.pemberitahuan.detail', compact('pemberitahuan'));
    }
}
