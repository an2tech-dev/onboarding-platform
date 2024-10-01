<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resources extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'description', 'url'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
