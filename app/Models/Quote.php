<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quote extends Model
{
    use HasFactory;
    protected $table = 'crm_quotes';

    protected $fillable = [
        'subject',
        'subtotal',
        'discount',
        'tax',
        'adjustment',
        'grand_total',
        'expired_at'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount' => 'decimal:2',
        'tax' => 'decimal:2',
        'adjustment' => 'decimal:2',
        'grand_total' => 'decimal:2',
        'expired_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class, 'quotes_id');
    }
}