<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use App\Models\Category;
use App\Models\Content;
use App\Models\Language;
use Illuminate\Http\Request;

class DashboardController extends MainController
{
    public function index(Request $request)
    {
        /**
         * ROOT
         */

        $this->create('Root'); // 1

        /**
         * BASE
         */

        $this->create('Usuários', 1); // 2
        $this->create('Páginas', 1); // 3

        /**
         * Usuários
         */

        $this->create('Roots', 2);
        $this->create('Administrador', 2);
        $this->create('Cliente', 2);

        /**
         * Páginas
         */

        $this->create('Home', 3);

        exit('-- | --');
        
        return view('console-service::dashboard.index');
    }

    private function create(string $name, int $category_id = null): void
    {
        $response = Category::create(['default' => true]);

        $Languages = Language::where('active', '<>', 2)->orderBy('default', 'desc')->get();
        foreach ($Languages as $language) {
            $responseContent = Content::create(['title' => $name]);
            $response->contents()->attach($responseContent->id, ['language_id' => $language->id]);
        }

        if (is_null($category_id)) {
            return;
        }

        $response->primary()->attach($category_id);

        return;
    }
}
