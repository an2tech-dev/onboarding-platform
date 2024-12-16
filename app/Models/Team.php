<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function floors()
    {
        return $this->belongsToMany(Floor::class)->withTimestamps();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}