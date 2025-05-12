<?php

namespace App\Models;

use App\Models\Lead;
use App\Models\Activity;
use App\Models\CrmAccessRight;
use App\Models\CrmFullAccessRight;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class CrmUser extends Authenticatable
{
    use HasFactory;
    protected $table = 'crm_users';

    protected $fillable = [
        'user_type', 
        'first_name',
        'last_name',
        'email',
        'phone',
        'password',
        'status'
    ];

    protected $hidden = [
        'password'
    ];

    protected $casts = [
        'user_type' => 'integer',
        'status' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function accessRights(): HasMany
    {
        return $this->hasMany(CrmAccessRight::class, 'user_id');
    }

    public function fullAccessRights(): HasOne
    {
        return $this->hasOne(CrmFullAccessRight::class, 'user_id');
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'user_id');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class, 'user_id');
    }
}