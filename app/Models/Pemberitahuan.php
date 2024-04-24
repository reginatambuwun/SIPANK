<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Uuid;

class Pemberitahuan extends Model
{
    use HasFactory;
    use Uuid;

    public $timestamps = true;
    protected $table = "pemberitahuan";
    protected $fillable = [
        'id','user_id','keterangan','dibaca','status'
    ];
}
