<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $table = 'crm_courses';

    protected $fillable = [
        'sku',
        'course_name',
        'rate',
        'total_seats',
        'allotted_seats',
        'available_seats'
    ];

    protected $casts = [
        'rate' => 'decimal:2',
        'total_seats' => 'integer',
        'allotted_seats' => 'integer',
        'available_seats' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'courses_id');
    }
}