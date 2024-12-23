<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    protected $fillable = ['company_id', 'name', 'description', 'type', 'workflow_data', 'information_data'];

    protected $casts = [
        'workflow_data' => 'array',
        'information_data' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


}

