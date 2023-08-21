<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubscriptionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'st_payment_link',
        'name',
        'price',
        'trial_days',
        'info'
    ];

    protected $casts = [
        'info' => 'array'
    ];
}
