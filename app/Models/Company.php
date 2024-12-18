<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company'; 

    protected $fillable = ['name', 'description', 'established', 'office_size', 'benefits'];

    protected $casts = [
        'established' => 'date',
        'benefits' => 'array'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function stakeholders()
    {
        return $this->hasMany(Stakeholder::class);
    }
    public function processes()
    {
        return $this->hasMany(Process::class);
    }
   
    public function resources()
    {
        return $this->hasMany(Resource::class);
    }

}