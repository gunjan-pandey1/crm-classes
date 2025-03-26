<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FullAccessRight extends Model
{
    use HasFactory;
    protected $table = 'crm_full_access_rights';

    protected $fillable = [
        'user_id',
        'leads',
        'quotes',
        'activities',
        'organization',
        'students',
        'courses'
    ];

    protected $casts = [
        'leads' => 'integer',
        'quotes' => 'integer',
        'activities' => 'integer',
        'organization' => 'integer',
        'students' => 'integer',
        'courses' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(CrmUser::class, 'user_id');
    }
}