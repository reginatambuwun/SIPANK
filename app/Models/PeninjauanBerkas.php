<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PeninjauanBerkas extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = true;
    protected $table = "peninjauan_berkas";
    protected $fillable = [
        'id','periode_id','alternatif_id','keterangan','status'
    ];
}
