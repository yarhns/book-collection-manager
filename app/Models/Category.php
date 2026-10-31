<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
        // Tambahkan fungsi ini di dalam class Category
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
