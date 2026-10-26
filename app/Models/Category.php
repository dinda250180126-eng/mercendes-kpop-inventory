<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    // Izinkan kolom-kolom ini diisi secara massal
    protected $fillable = ['name', 'slug', 'description'];

    // FITUR OTOMATIS: Setiap kali data kategori akan disimpan/dibuat, 
    // slug akan otomatis terisi dari name jika kosong. Ini mengunci error selamanya!
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }
}