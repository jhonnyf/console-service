<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CategoryContents extends Pivot
{
    public function category()
    {
        $this->belongsTo(Category::class);
    }

    public function content()
    {
        $this->belongsTo(Content::class);
    }

    public function language()
    {
        $this->belongsTo(Language::class);
    }
}
