<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryChild;
use Carbon\Carbon;

class Map extends Model
{
    use HasFactory;
    
    protected $guarded = [''];

    //relasi ke tabel subkategori
    public function category_child()
    {
        return $this->belongsTo(CategoryChild::class);
    }

    //mengambil data timestamps pembuatan data
    public function getCreatedAtAttribute(){
        if(!is_null($this->attributes['created_at'])){
            return Carbon::parse($this->attributes['created_at'])->format('Y-m-d H:i:s');
        }
    }

    //mengambil data timestamps pengeditan data
    public function getUpdatedAtAttribute(){
        if(!is_null($this->attributes['updated_at'])){
            return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d H:i:s');
        }
    }
}
