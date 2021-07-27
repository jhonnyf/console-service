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

    public function contents()
    {
        return $this->belongsToMany(Content::class, 'content_content', 'id')
            ->using(ContentContents::class)
            ->withPivot('language_id')
            ->withTimestamps();
    }

    public function files()
    {
        return $this->belongsToMany(File::class, 'content_file');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'content_category')->withTimestamps();
    }
}
