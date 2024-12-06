<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stakeholder extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'role', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}