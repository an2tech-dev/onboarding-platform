<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['floor_id', 'name', 'members_count'];

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
