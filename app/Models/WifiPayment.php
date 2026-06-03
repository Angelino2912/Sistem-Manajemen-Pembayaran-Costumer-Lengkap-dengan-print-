<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WifiPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'phone',
        'package_name',
        'amount',
        'paid_at',
        'payment_proof',
        'submitted_at',
        'status',
        'note',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'integer',
            'paid_at' => 'date',
            'submitted_at' => 'datetime',
        ];
    }
}
