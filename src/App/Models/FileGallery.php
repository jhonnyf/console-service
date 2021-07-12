<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FileGallery extends Model
{
    protected $fillable = ['file_gallery', 'module'];
    protected $table    = 'files_galleries';
}
