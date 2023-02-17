<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Map;

class CategoryChild extends Model
{
    use HasFactory;

    protected $guarded = [''];

    //relasi ke tabel kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //relasi ke tabel map
    public function maps()
    {
        return $this->hasMany(Map::class);
    }
}
