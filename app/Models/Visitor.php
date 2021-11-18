<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip'
    ];
    public static function hit() {
        static::updateOrCreate([
            'ip'   => $_SERVER['REMOTE_ADDR'],
        ])->save();
    }
}
