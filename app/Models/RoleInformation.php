<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleInformation extends Model
{
    use HasFactory;

    protected $table = 'roles_information';

    protected $fillable = [
        'title',
        'description',
        'expectations',
        'overview',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_information_id');
    }
} 