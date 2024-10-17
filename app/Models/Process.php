<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'name', 'description'];

    // Each process belongs to a company
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Each process has many schedules
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
}

