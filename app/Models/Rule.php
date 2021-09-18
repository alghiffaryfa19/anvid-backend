<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    use HasFactory;
    protected $table='rules';
    protected $guarded = [];

    public function master()
    {
        return $this->hasMany(\App\Models\Master::class, 'rule_id','id');
    }

    public function hasil()
    {
        return $this->hasMany(\App\Models\Hasil::class, 'rule_id','id');
    }

    public function solusi()
    {
        return $this->belongsTo(\App\Models\Solusi::class, 'solusi_id','id');
    }
}
