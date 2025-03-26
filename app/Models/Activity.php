<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;
    
    protected $table = 'crm_activities';
    public $timestamps = false; // Add this line to disable automatic timestamp handling
    
    protected $fillable = [
        'user_id',
        'title',
        'is_done',
        'comment',
        'lead',
        'type',
        'schedule_from',
        'schedule_to',
        'created_at',
        'updated_at'  // Add this
    ];

    protected $casts = [
        'is_done' => 'integer',
        'comment' => 'string',
        'lead' => 'string',
        'type' => 'string',
        'schedule_from' => 'datetime',
        'schedule_to' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(CrmUser::class, 'user_id');
    }
}