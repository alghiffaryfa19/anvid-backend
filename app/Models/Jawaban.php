<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban extends Model
{
    use HasFactory;
    protected $table='jawabans';
    protected $guarded = [];

    public function diagnosa()
    {
        return $this->belongsTo(\App\Models\Diagnosa::class, 'diagnosa_id','id');
    }
}
