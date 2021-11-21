<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'vendor_payment_id',
        'status',
        'message',
        'email',
        'name',
        'country',
    ];
}
