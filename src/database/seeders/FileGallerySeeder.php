<?php

namespace Database\Seeders;

use App\Models\FileGallery;
use Illuminate\Database\Seeder;

class FileGallerySeeder extends Seeder
{

    public function run()
    {
        FileGallery::create([
            'file_gallery' => 'Principal',
            'module'       => '',
        ]);

        FileGallery::create([
            'file_gallery' => 'Perfil',
            'module'       => 'user',
        ]);
    }
}
