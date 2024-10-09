<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'company';

    protected $fillable = ['name', 'description', 'established', 'team_members', 'office_size'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function floors()
    {
        return $this->hasMany(Floor::class);
    }
    public function benefits()
    {
        return $this->hasMany(Benefit::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
