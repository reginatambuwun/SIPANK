<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class PeriodeNaikPangkat extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = true;
    protected $table = "periode_naik_pangkat";
    protected $fillable = [
        'id','kode','nama','status'
    ];
}
