<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;
    protected $table = 'crm_organizations';

    protected $fillable = [
        'name',
        'student_count'
    ];

    protected $casts = [
        'student_count' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'integer'
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'organization_id');
    }
}