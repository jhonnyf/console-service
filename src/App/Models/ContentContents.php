<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ContentContents extends Pivot
{
    public function id()
    {
        $this->belongsTo(Content::class);
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
