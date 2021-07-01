<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category'];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function contents()
    {        
        return $this->belongsToMany(Content::class, 'category_content')->using(CategoryContents::class)->withPivot('language_id')->withTimestamps();
    }

    // public function files()
    // {
    //     return $this->belongsToMany(Files::class, 'links_categories_files')->withTimestamps()->with('fileGallery');
    // }

    // public function contentsCategory()
    // {
    //     return $this->belongsToMany(Contents::class, 'links_categories_contents')->withTimestamps();
    // }

    public function primary()
    {
        return $this->belongsToMany(Category::class, 'category_category', 'secondary_id', 'primary_id')->withTimestamps();
    }

    public function secondary()
    {
        return $this->belongsToMany(Category::class, 'category_category', 'primary_id', 'secondary_id')->withTimestamps();
    }
}
