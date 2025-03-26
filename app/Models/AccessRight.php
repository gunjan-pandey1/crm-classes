<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccessRight extends Model
{
    use HasFactory;
    protected $table = 'crm_access_rights';

    protected $fillable = [
        'user_id',
        'module_name',
        'can_view',
        'can_create',
        'can_edit',
        'can_delete' 
    ];
 
    protected $casts = [
        'can_view' => 'integer',
        'can_create' => 'integer',
        'can_edit' => 'integer',
        'can_delete' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function user(): BelongsTo
    { 
        return $this->belongsTo(CrmUser::class, 'user_id');
    }
}