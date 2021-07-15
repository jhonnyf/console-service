<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FileContents extends Pivot
{
    public function file()
    {
        $this->belongsTo(File::class);
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
