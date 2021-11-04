<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment',
        'u_id',
        'm_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'u_id', 'id');
    }
}
