<?php

namespace SenventhCode\ConsoleService\App\Services;

use App\Models\Content;
use App\Models\File;
use App\Models\Language;
use SenventhCode\ConsoleService\App\Http\Requests\FileUpload;

class Upload
{
    public function uploadFIle(string $module, int $link_id, int $file_gallery_id,  $request, string $fileName = ''): File
    {
        $file = $request->file('file');

        $data = [
            'file_gallery_id' => $file_gallery_id,
            'original_name'   => $file->getClientOriginalName(),
            'extension'       => $file->getClientOriginalExtension(),
            'size'            => round($file->getSize() / 1024 / 1024, 4),
            'mime_type'       => $file->getMimeType(),
        ];

        if (empty($fileName)) {
            $data['file_path'] = $request->file->store("public/{$module}");
        } else {
            $data['file_path'] = $request->file->storeAs("public/{$module}", "{$fileName}.{$data['extension']}");
        }

        $data['file_path'] = str_replace("public/", "", $data['file_path']);

        $response = File::create($data);

        $this->creteContent($response->id);

        $File = File::find($response->id);
        if ($module === 'user') {
            $File->userFiles()->attach($link_id);
        } elseif ($module === 'content') {
             $File->contentFiles()->attach($link_id);
        } elseif ($module == 'category') {
             $File->categoryFiles()->attach($link_id);
        } elseif ($module == 'products') {
            // $File->productsFile()->attach($link_id);
        }

        return $File;
    }

    private function creteContent(int $id): void
    {
        $responseLanguages = Language::where('active', '<>', 2)
            ->orderBy('default', 'desc');

        if ($responseLanguages->exists()) {
            $File = File::find($id);
            foreach ($responseLanguages->get() as $language) {
                $responseContent = Content::create(['title' => ""]);
                $File->contents()->attach($responseContent->id, ['language_id' => $language->id]);
            }
        }
    }
}
