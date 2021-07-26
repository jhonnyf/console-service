<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $fillable = ['slug', 'date', 'title', 'subtitle', 'content', 'link', 'video'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug']  = \Illuminate\Support\Str::slug($value, '-');
    }

    public function contentLanguage()
    {
        return $this->belongsToMany(Content::class, 'file_content')
            ->using(FileContents::class)
            ->withPivot('language_id')
            ->withTimestamps();
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'content_file');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'links_categories_contents')->withTimestamps();
    }
}
