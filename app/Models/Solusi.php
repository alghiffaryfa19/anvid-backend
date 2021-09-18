<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    use HasFactory;
    protected $table='solusis';
    protected $guarded = [];

    public function rule()
    {
        return $this->hasMany(\App\Models\Rule::class, 'solusi_id','id');
    }

    public function item()
    {
        return $this->hasMany(\App\Models\Item::class, 'solusi_id','id');
    }
}
