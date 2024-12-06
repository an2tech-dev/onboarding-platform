<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'name', 'description', 'release_date', 'product_image'];

    protected $appends = ['image']; 

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function getImageAttribute()
    {
        return $this->product_image ? asset('storage/' . $this->product_image) : null;
    }

   
}