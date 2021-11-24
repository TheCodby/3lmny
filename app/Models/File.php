<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'path'
    ];
    protected static function boot() {
        parent::boot();

        static::deleting(function ($file) {
            $filepath = public_path().'/storage/uploads/materials/'.$file->path;
            if(\Illuminate\Support\Facades\File::isFile($filepath))
            {
                \Illuminate\Support\Facades\File::delete($filepath);
            }
        });
    }
}
