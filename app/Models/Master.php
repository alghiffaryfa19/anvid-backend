<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Master extends Model
{
    use HasFactory;
    protected $table='masters';
    protected $guarded = [];

    public function rule()
    {
        return $this->belongsTo(\App\Models\Rule::class, 'rule_id','id');
    }
}
