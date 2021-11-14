<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MaterialsTypes;
use App\Models\Level;
use App\Models\File;

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
		'image_id',
	];
	public function typeRow(){
        return $this->belongsTo(MaterialsTypes::class, 'type');
    }
	public function levelRow(){
        return $this->belongsTo(Level::class, 'level');
    }
	public function image(){
        return $this->belongsTo(File::class, 'image_id');
    }
}
