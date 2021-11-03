<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MaterialsTypes;
use App\Models\Level;

class Material extends Model
{
    use HasFactory;
	protected $fillable = [
		'subject',
		'description',
		'url',
		'type',
		'level',
		'keywords',
	];
	public function type(){
        return $this->belongsTo(MaterialsTypes::class, 'type', 'id');
    }
	public function level(){
        return $this->belongsTo(Level::class, 'level', 'id');
    }
}
