<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['file_gallery_id', 'file_path', 'original_name', 'extension', 'size', 'mime_type'];

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'file_content')
            ->using(FileContents::class)
            ->withPivot('language_id')
            ->withTimestamps();
    }

    public function fileGallery()
    {
        return $this->belongsTo(FilesGalleries::class);
    }

    /**
     *
     */

    public function userFiles()
    {
        return $this->belongsToMany(User::class, 'user_file')->withTimestamps();
    }

    public function categoryFiles()
    {
        return $this->belongsToMany(Categories::class, 'links_categories_files')->withTimestamps();
    }
}
