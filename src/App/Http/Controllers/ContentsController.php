<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use App\Models\Content as Model;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ContentsController extends MainController
{

    public function __construct()
    {
        $this->Route = 'content';
        parent::__construct(Model::class);
    }

    public function store(Request $request)
    {
        $create = $request->all();

        $create['slug'] = $this->checkSlug($create['title']);

        $response = Model::create($create);

        $languageDefault = Language::where('active', '<>', 2)
            ->where('default', true)
            ->first();

        $Content = Model::find($response->id);

        $Content->language_id = $languageDefault->id;
        $Content->save();

        $Content->categories()->attach($create['category_id']);

        $languages = Language::where('active', '<>', 2)
            ->where('default', false);
        if ($languages->exists()) {
            foreach ($languages->get() as $key => $value) {
                $newContent = $Content->toArray();

                $newContent['language_id']  = $value['id'];
                $newContent['slug']         = $this->checkSlug($newContent['title']);
                $newContent['created_at']   = date('Y-m-d H:i:s');
                $newContent['updated_at']   = date('Y-m-d H:i:s');
                $newContent['reference_id'] = $newContent['id'];

                unset($newContent['id']);

                Model::insert($newContent);
            }
        }

        return redirect()->route("{$this->Route}.form", ['id' => $response->id, 'language_id' => $Content->language_id, 'category_id' => $create['category_id']]);
    }

    public function update(int $id, Request $request)
    {
        $fill = $request->all();

        $fill['slug'] = $this->checkSlug($fill['title'], $id);

        $Content = Model::find($id);

        $Content->fill($fill)->save();

        $route_id = empty($Content->reference_id) ? $Content->id : $Content->reference_id;

        return redirect()->route("{$this->Route}.form", ['id' => $route_id, 'language_id' => $Content->language_id, 'category_id' => $fill['category_id']]);
    }

    /**
     * EXTRA
     */

    private function checkSlug(string $title, int $id = null)
    {
        $slug  = Str::slug($title);
        $check = Model::where('slug', $slug);

        if (is_null($id) === false) {
            $check->where('id', '<>', $id);
        }

        if ($check->exists()) {
            $slug = "{$slug}-" . rand(0, 100);
            return $this->checkSlug($slug, $id);
        }

        return $slug;
    }

}
