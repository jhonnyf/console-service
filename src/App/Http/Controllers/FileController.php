<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use App\Models\Contents;
use App\Models\File;
use App\Models\FileGallery;
use App\Models\Files;
use App\Models\Languages;
use App\Models\User;
use App\Services\FormElement\FormElement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use SenventhCode\ConsoleService\App\Http\Requests\FileUpload;

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

    public function uploadForm(string $module, int $link_id, int $file_gallery_id)
    {
        $data = [
            'module'          => $module,
            'link_id'         => $link_id,
            'file_gallery_id' => $file_gallery_id,
        ];

        $response = [
            'error'   => false,
            'message' => 'sucesso',
            'result'  => view('files.upload-form', $data)->render(),
        ];

        return response()->json($response);
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

        $response = File::create($data);

        // $this->creteContent($response->id);

        $File = File::find($response->id);
        if ($module === 'user') {
            $File->user()->attach($link_id);
        } elseif ($module === 'contents') {
            // $File->contentsFile()->attach($link_id);
        } elseif ($module == 'categories') {
            // $File->categoriesFile()->attach($link_id);
        } elseif ($module == 'products') {
            // $File->productsFile()->attach($link_id);
        }

        return response()->json($response);
    }

    private function creteContent(int $id): void
    {
        $responseLanguages = Languages::where('active', '<>', 2)
            ->orderBy('default', 'desc');

        if ($responseLanguages->exists()) {
            $reference_id = null;
            foreach ($responseLanguages->get() as $language) {
                $responseContentFile = Files::find($id)->contents()->create();

                $ContentFile = Files::find($id)
                    ->contents()
                    ->where('id', $responseContentFile->id)
                    ->first();

                $ContentFile->language_id = $language->id;
                if (is_null($reference_id) === false) {
                    $ContentFile->reference_id = $reference_id;
                }

                $ContentFile->save();

                $reference_id = $ContentFile->id;
            }
        }
    }

    public function form(int $id, Request $request)
    {
        $data = [
            'id'                     => $id,
            'route'                  => 'files',
            'btn_back'               => false,
            'languages'              => Languages::where('active', '<>', 2)->orderBy('default', 'desc'),
            'navLanguageRoute'       => 'files.form',
            'navLanguageRouteParams' => ['id' => $id],
            'classItem'              => ['edit-form', 'ajax-item'],
        ];

        $LanguageDefault = Languages::where('default', true)->first();

        $language_id             = isset($request->language_id) ? $request->language_id : $LanguageDefault->id;
        $data['language_id']     = $language_id;
        $data['languageDefault'] = $LanguageDefault;

        $file = Files::find($id)->contents->where('language_id', $language_id)->first();

        $form = new FormElement;

        $form->setAction(route('files.form', ['id' => $id]));
        $form->setAutocomplete(false);
        $form->setMethod('post');
        $form->setClass(['form-ajax']);

        $content_id = $form->newElement('input');
        $content_id->setName('content_id');
        $content_id->setType('hidden');
        $content_id->setValue($file->id);

        $form->addElement($content_id);

        $title = $form->newElement('input');
        $title->setName('title');
        $title->setType('text');
        $title->setLabel('Título');
        $title->setValue($file->title);

        $form->addElement($title);

        $content = $form->newElement('textarea');
        $content->setName('content');
        $content->setLabel('Conteúdo');
        $content->setValue($file->content);

        $form->addElement($content);

        $data['form'] = $form->render($data);

        $response = [
            'error'   => false,
            'message' => 'sucesso',
            'result'  => view('files.form', $data)->render(),
        ];

        return response()->json($response);
    }

    public function update(int $id, Request $request)
    {
        $response = Files::find($id)->contents->where('id', $request->content_id)->first()->fill($request->all())->save();

        $data = [
            'class'   => $response ? 'success' : 'danger',
            'message' => $response ? 'Ação realizada com sucesso' : 'Não foi possivel realizar a ação',
        ];

        $response = [
            'error'   => $response,
            'message' => view('system.alert', $data)->render(),
            'result'  => Files::with('contents')->find($id),
        ];

        return response()->json($response);
    }

    public function active(int $id)
    {
        $Object = Files::find($id);

        $Object->active = $Object->active === 1 ? 0 : 1;
        $Object->save();

        return redirect()->back();
    }

    public function destroy(int $id)
    {
        $Object = Files::find($id);

        $Object->active = 2;
        $Object->save();

        return redirect()->back();
    }

}
