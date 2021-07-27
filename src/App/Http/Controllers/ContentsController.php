<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use App\Models\Content as Model;
use App\Models\ContentContents;
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

        $Content = Model::find($response->id);
        $Content->category()->attach($request->category_id);

        $responseLanguages = Language::where('active', '<>', 2)
            ->orderBy('default', 'desc');

        if ($responseLanguages->exists()) {
            foreach ($responseLanguages->get() as $language) {

                $insert = [
                    'id'          => $Content->id,
                    'language_id' => $language->id,
                    'created_at'  => date('Y-m-d H:i:s'),
                    'updated_at'  => date('Y-m-d H:i:s'),
                ];

                if ($language->default == 0) {
                    $responseContent = Model::create(['title' => ""]);

                    $insert['content_id'] = $responseContent->id;
                } else {
                    $insert['content_id'] = $Content->id;
                }

                ContentContents::insert($insert);
            }
        }

        $language_id = $responseLanguages->first()->id;

        return redirect()->route("{$this->Route}.form", ['id' => $response->id, 'language_id' => $language_id, 'category_id' => $create['category_id']]);
    }

    public function update(int $id, Request $request)
    {
        $fill = $request->all();

        $content_id_by_langague = $request->id;

        $fill['slug'] = $this->checkSlug($fill['title'], $content_id_by_langague);

        $Content = Model::find($content_id_by_langague);
        $Content->fill($fill)->save();
        
        $ContentBase = Model::find($id);

        $language_id = $ContentBase->contents()->where('content_id', $content_id_by_langague)->first()->pivot->language_id;

        return redirect()->route("{$this->Route}.form", ['id' => $id, 'language_id' => $language_id, 'category_id' => $fill['category_id']]);
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
