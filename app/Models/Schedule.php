<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = ['process_id', 'schedule_type', 'start_time', 'end_time','title', 'description'];

    public function process()
    {
        return $this->belongsTo(Process::class);
    }
}

