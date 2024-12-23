<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'name', 'floor_number', 'type', 'image'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class)->withTimestamps();
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = is_array($value) ? $value[0] : $value;
    }

    protected static function booted()
    {
        static::saved(function ($floor) {
            if (request()->has('teams')) {
                $teamIds = request()->get('teams');
                // Update all selected teams to point to this floor
                Team::whereIn('id', $teamIds)
                    ->update(['floor_id' => $floor->id]);
                
                // Remove floor_id from unselected teams that were previously assigned to this floor
                Team::where('floor_id', $floor->id)
                    ->whereNotIn('id', $teamIds)
                    ->update(['floor_id' => null]);
            }
        });
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }
}
