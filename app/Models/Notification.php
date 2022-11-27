<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'content',
        'body',
        'data',
        'status',
        'schedule_time',
        'sent_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'schedule_time' => 'datetime',
        'sent_at' => 'datetime',
    ];
}
