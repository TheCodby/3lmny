<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MaterialsTypes;

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
	public function materialTypes(){
        return $this->belongsTo(MaterialsTypes::class, 'type', 'id');
    }
}
