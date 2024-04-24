<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Kriteria extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = true;
    protected $table = "kriteria";
    protected $fillable = [
        'id','kode','nama','jumlah_bobot','jumlah_eigen','rata_eigen'
    ];
}
