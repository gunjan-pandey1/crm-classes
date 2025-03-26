<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $table = 'crm_students';
    public $timestamps = false; // Add this line to handle timestamps manually

    protected $fillable = [
        'quotes_id',
        'organization_id',
        'courses_id',
        'name',
        'email',
        'contact_number',
        'created_at',
        'updated_at'  // Add updated_at to fillable
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class, 'quotes_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'organization_id');
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'courses_id');
    }
}