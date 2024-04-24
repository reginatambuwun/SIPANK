<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Berkas extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = true;
    protected $table = "berkas";
    protected $fillable = [
        'id','periode_id','alternatif_id','surat_pengantar_instansi','sk_cpns_pns','kartu_pegawai','skp','sk_pangkat_akhir','sk_jabatan_akhir','ijazah','sk_kp','status'
    ];
}
