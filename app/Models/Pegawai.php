<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Pegawai extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = true;
    protected $table = "pegawai";

    protected $fillable = [
        'id','user_id','name','jabatan','nipl','gelar_depan','gelar_belakang','tempat_lahir','tanggal_lahir','jenis_kelamin','gol_darah','identitas_diri','nomor_identitas',
        'npwp','alamat','kel_desa','kecamatan','kab_kota','kode_pos','no_telp','agama','status_pernikahan','tinggi_badan','berat_badan','hobi','tmt_bekerja_cpns','tmt_sk_akhir','gol_ruang_awal','nilai_skp'
    ];

}
