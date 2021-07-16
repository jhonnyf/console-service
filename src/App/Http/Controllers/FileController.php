<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use App\Models\Content;
use App\Models\File as Model;
use App\Models\FileGallery;
use App\Models\Language;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use SenventhCode\ConsoleService\App\Http\Requests\FileUpload;
use SenventhCode\FormGenerator\FormGenerator;

class FileController
{
    public function listGalleries(string $module, int $link_id, Request $request)
    {
        $ModuleConfig = App::make("\SenventhCode\ConsoleService\App\Services\ModuleConfig\Module\\" . ucwords($module) . "ModuleConfig");

        $data = [
            'module'          => $module,
            'link_id'         => $link_id,
            'nav'             => $ModuleConfig->setNav($request, $link_id),
            'route'           => $ModuleConfig->Route,
            'name'            => $ModuleConfig->Name,
            'file_gallery_id' => $request->file_gallery_id,
            'filesGalleries'  => FileGallery::where(['active' => 1, 'module' => $module])
                ->orWhere(function ($q) {
                    $q->where('module', null)->orWhere('module', "");
                })
                ->get(),
        ];

        if ($data['file_gallery_id'] > 0) {

            if ($module == 'user') {
                $data['files'] = User::find($link_id)
                    ->files()
                    ->where('active', '<>', 2)
                    ->where('file_gallery_id', $data['file_gallery_id'])
                    ->get();
            } elseif ($module == 'contents') {
                // $data['entity'] = Contents::find($link_id)
                //     ->files()
                //     ->where('active', '<>', 2);
            } elseif ($module == 'categories') {
                // $data['entity'] = Categories::find($link_id)
                //     ->files()
                //     ->where('active', '<>', 2);
            }
        }

        return view('console-service::file.list-galleries', $data);
    }

    public function submitFiles(string $module, int $link_id, int $file_gallery_id, FileUpload $request)
    {
        if ($request->hasFile('file') === false) {
            return response()->isInvalid();
        }

        $file = $request->file('file');

        $data = [
            'file_gallery_id' => $file_gallery_id,
            'original_name'   => $file->getClientOriginalName(),
            'extension'       => $file->getClientOriginalExtension(),
            'size'            => round($file->getSize() / 1024 / 1024, 4),
            'mime_type'       => $file->getMimeType(),
        ];

        $data['file_path'] = $request->file->store("public/{$module}");
        $data['file_path'] = str_replace("public/", "", $data['file_path']);

        $response = Model::create($data);

        $this->creteContent($response->id);

        $File = Model::find($response->id);
        if ($module === 'user') {
            $File->userFiles()->attach($link_id);
        } elseif ($module === 'contents') {
            // $File->contentsFile()->attach($link_id);
        } elseif ($module == 'categories') {
            // $File->categoriesFile()->attach($link_id);
        } elseif ($module == 'products') {
            // $File->productsFile()->attach($link_id);
        }

        return response()->json([
            'error'   => false,
            'message' => 'Upload feito com sucesso!',
            'result'  => [
                'html' => view('console-service::components.file-item', ['file' => $File])->render(),
            ],
        ]);
    }

    private function creteContent(int $id): void
    {
        $responseLanguages = Language::where('active', '<>', 2)
            ->orderBy('default', 'desc');

        if ($responseLanguages->exists()) {
            $File = Model::find($id);
            foreach ($responseLanguages->get() as $language) {
                $responseContent = Content::create(['title' => ""]);
                $File->contents()->attach($responseContent->id, ['language_id' => $language->id]);
            }
        }
    }

    public function form(int $id, Request $request)
    {
        $data = [
            'id'                     => $id,
            'route'                  => 'files',
            'btn_back'               => false,
            'languages'              => Language::where('active', '<>', 2)->orderBy('default', 'desc'),
            'navLanguageRoute'       => 'file.form',
            'navLanguageRouteParams' => ['id' => $id],
            'classItem'              => ['edit-form', 'ajax-item'],
        ];

        $LanguageDefault = Language::where('default', true)->first();

        $language_id             = isset($request->language_id) ? $request->language_id : $LanguageDefault->id;
        $data['language_id']     = $language_id;
        $data['languageDefault'] = $LanguageDefault;

        $fileContent = Model::find($id)->contents()->where('language_id', $language_id)->first();

        $Form = new FormGenerator(route('file.update', ['id' => $id]));
        $Form->modelForm(new Content, $fileContent->toArray());
        $Form->setClass(['form-ajax']);

        $Form->destroyElement('date');
        $Form->destroyElement('video');

        $data['form'] = $Form->render();

        if ($request->return_json) {
            return response()->json([
                'error'   => false,
                'message' => 'Ação realizada com sucesso!',
                'result'  => [
                    'html' => view('console-service::file.form', $data)->render()
                ],
            ]);
        }

        return view('console-service::file.form', $data);
    }

    public function update(int $id, Request $request)
    {
        $response = Model::find($id)
            ->contents()->where('id', $request->id)->first()->fill($request->all())->save();

        return response()->json([
            'error'   => $response,
            'message' => 'Ação realizada com sucesso!',
            'result'  => [],
        ]);
    }

    public function active(int $id)
    {
        $Object = Model::find($id);

        $Object->active = $Object->active === 1 ? 0 : 1;
        $Object->save();

        return response()->json([
            'error'   => false,
            'message' => 'Ação realizada com sucesso',
            'result'  => $Object,
        ]);
    }

    public function destroy(int $id)
    {
        $Object = Model::find($id);

        $Object->active = 2;
        $Object->save();

        return response()->json([
            'error'   => false,
            'message' => 'Ação realizada com sucesso',
            'result'  => [],
        ]);
    }

}
