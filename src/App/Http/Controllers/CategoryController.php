<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use App\Models\Category as Model;
use App\Models\Content;
use App\Models\Language;
use Illuminate\Http\Request;
use SenventhCode\ConsoleService\App\Http\Requests\CategoriesStore;
use SenventhCode\ConsoleService\App\Http\Requests\CategoriesUpdate;
use SenventhCode\FormGenerator\FormGenerator;

class CategoryController extends MainController
{
    public function __construct()
    {
        $this->Route = 'category';
        parent::__construct(Model::class);
    }

    public function index(Request $request)
    {
        $data = [
            'route'    => $this->Route,
            'category' => Model::find(1),
        ];

        return view("console-service::{$this->Route}.index", $data);
    }

    public function show(int $id)
    {
        $data = [
            'route'    => $this->Route,
            'category' => Model::find($id),
        ];

        return view("console-service::{$this->Route}.index", $data);
    }

    public function structure(Request $request)
    {
        $data = [
            'id'       => $request->id,
            'category' => Model::find($request->id),
        ];

        $response = [
            'error'   => false,
            'message' => 'success',
            'result'  => [
                'parent_id' => $data['id'],
                'html'      => view("console-service::{$this->Route}.structure", $data)->render(),
            ],
        ];

        return response()->json($response);
    }

    public function store(CategoriesStore $request)
    {
        $create = $request->all();

        $response = Model::create($create);
        $this->saveLink($response->id, $create['category_id']);

        $languages = Language::where('active', '<>', 2)->orderBy('default', 'desc');
        if ($languages->exists()) {
            $reference_id = null;
            foreach ($languages->get() as $language) {
                $responseContent = Model::find($response->id)->contents()->create();

                $content = Model::find($response->id)
                    ->contents()
                    ->where('id', $responseContent->id)
                    ->first();

                $content->language_id = $language->id;
                if (is_null($reference_id) === false) {
                    $content->reference_id = $reference_id;
                }

                $content->save();

                $reference_id = $content->id;
            }
        }

        return redirect()->route("{$this->Route}.form", ['id' => $response->id, 'category_id' => $create['category_id']]);
    }

    public function update(int $id, CategoriesUpdate $request)
    {
        Model::find($id)
            ->fill($request->all())
            ->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id]);
    }

    private function saveLink(int $id, int $category_id): void
    {
        $Category = Model::find($id);

        $Category->categoryPrimary()->detach();
        $Category->categoryPrimary()->attach($category_id);

        return;
    }

    /**
     * CONTENT
     */

    public function content(int $id, Request $request)
    {
        $data = [
            'id'                     => $id,
            'route'                  => $this->Route,
            'name'                   => $this->Name,
            'nav'                    => $this->setNav($request, $id),
            'category_id'            => $request->category_id,
            'navLanguageRoute'       => 'category.content',
            'navLanguageRouteParams' => ['id' => $id, 'category_id' => $request->category_id],
            'enableLanguages'        => true,
            'classItem'        => [],
        ];

        $LanguageDefault = Language::where('default', true)->first();

        $language_id             = isset($request->language_id) ? $request->language_id : $LanguageDefault->id;
        $data['language_id']     = $language_id;
        $data['languageDefault'] = $LanguageDefault;

        $CategoryContent = Model::find($id)->contents()->where('language_id', $language_id)->first()->toArray();

        $Form = new FormGenerator(route('category.content-update', ['id' => $id, 'language_id' => $language_id]));
        $Form->modelForm(new Content() , $CategoryContent);
        $Form->setVars('id', $CategoryContent['id']);

        $data['form'] = $Form->render();

        return view('console-service::module-base.form', $data);
    }

    public function contentUpdate(int $id, Request $request)
    {
        $CategoryContent = Model::find($id)->contents()->where('language_id', $request->language_id)->first();

        $CategoryContent->fill($request->all())->save();

        return redirect()->route('category.content', ['id' => $id, 'language_id' => $request->language_id]);
    }
}
