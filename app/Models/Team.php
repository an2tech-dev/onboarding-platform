<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_id', 'description'];

    protected $with = ['users'];

    protected $hidden = ['users'];

    public function getMembersAttribute()
    {
        return $this->users->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'team_role' => $user->roleInformation ? $user->roleInformation->title : null,
            ];
        });
    }

    protected $appends = ['members'];

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

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_team');
    }
}