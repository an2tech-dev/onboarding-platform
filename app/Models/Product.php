<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'name', 'description', 'release_date', 'product_image'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
