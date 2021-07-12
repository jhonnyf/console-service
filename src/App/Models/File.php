<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $fillable = ['file_gallery_id', 'file_path', 'original_name', 'extension', 'size', 'mime_type'];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_file')->withTimestamps();
    }

    public function category()
    {
        return $this->belongsToMany(Categories::class, 'links_categories_files')->withTimestamps();
    }

    public function content()
    {
        return $this->belongsToMany(Contents::class, 'links_files_contents')->withTimestamps();
    }

    public function fileGallery()
    {
        return $this->belongsTo(FilesGalleries::class);
    }

    // public function contents()
    // {
    //     return $this->hasMany(ContentsFiles::class);
    // }
}
