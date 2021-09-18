<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;
    protected $table='diagnosas';
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id','id');
    }

    public function jawaban()
    {
        return $this->hasMany(\App\Models\Jawaban::class, 'diagnosa_id','id');
    }

    public function hasil()
    {
        return $this->hasOne(\App\Models\Hasil::class, 'diagnosa_id','id');
    }
}
