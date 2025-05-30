<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;
    protected $table = 'crm_leads';

    protected $fillable = [
        'user_id',
        'subject',
        'source',
        'lead_value',
        'lead_type',
        'tag_name',
        'contact_student',
        'stage',
        'rotten_lead',
        'expected_close_date'
    ];

    protected $casts = [
        'lead_value' => 'decimal:2',
        'source' => 'string',
        'lead_type' => 'string',
        'stage' => 'string',
        'rotten_lead' => 'string',
        'expected_close_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(CrmUser::class, 'user_id');
    }
}