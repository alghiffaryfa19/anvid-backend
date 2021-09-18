<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    use HasFactory;
    protected $table='hasils';
    protected $guarded = [];

    public function diagnosa()
    {
        return $this->belongsTo(\App\Models\Diagnosa::class, 'diagnosa_id','id');
    }

    public function rule()
    {
        return $this->belongsTo(\App\Models\Rule::class, 'rule_id','id');
    }
}
