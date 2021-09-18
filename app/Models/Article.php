<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;
    protected $table='articles';
    protected $guarded = [];
    protected $appends = ['tanggal','sub','time'];

    public function getThumbnailAttribute($value)
    {
        return asset('uploads/' . $value);
    }

    public function getTanggalAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d M Y');
    }

    public function getTimeAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->diffForHumans();
    }

    public function getSubAttribute()
    {
        return Str::limit(str_replace("&nbsp;", ' ', strip_tags($this->attributes['detail'])), 300, ' [....]');
    }

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value, '-');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id','id');
    }
}
