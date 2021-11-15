<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Material;

class Bookmark extends Model
{
    use HasFactory;
    protected $fillable = [
        'u_id',
        'm_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'u_id');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'm_id');
    }
}
