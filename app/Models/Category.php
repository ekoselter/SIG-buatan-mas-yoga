<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryChild;

class Category extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //relasi ke tabel subkategori
    public function category_child()
    {
        return $this->hasMany(CategoryChild::class);
    }
}
