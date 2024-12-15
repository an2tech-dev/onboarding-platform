<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'floor_id'];

    public function floors()
    {
        return $this->belongsTo(Floor::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}