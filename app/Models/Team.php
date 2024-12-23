<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'company_id', 'description', 'image'];

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

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    protected $appends = ['members', 'image_url'];

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