<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Arsip extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = true;
    protected $table = "arsip";
    protected $fillable = [
        'id','user_id','nama','berkas'
    ];
}
