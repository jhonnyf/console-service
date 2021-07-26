<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use App\Models\Language;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\App;
use SenventhCode\ConsoleService\App\Services\Metadata\Metadata;
use SenventhCode\ConsoleService\App\Services\QueryService;
use SenventhCode\FormGenerator\FormGenerator;

abstract class MainController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $Model;
    protected $Route;
    protected $TableName;
    protected $Name;
    protected $EnableLanguages = false;

    public function __construct($Model = null)
    {
        if (is_null($Model) === false) {
            $this->Model = new $Model;
            $this->setModuleVariables();
        }
    }

    public function index(Request $request)
    {
        $data = [
            'search' => isset($request->search) ? $request->search : '',
            'route'  => $this->Route,
            'name'   => $this->Name,
        ];

        $setData = $this->setData($request);
        if (count($setData) > 0) {
            $data['extraData'] = $setData;
            $data              = array_merge($data, $setData);
        }

        $list = $this->Model->query();

        $setCondition = $this->setCondition($request);
        if (count($setCondition) > 0) {
            foreach ($setCondition as $field => $value) {
                if (is_array($value)) {
                    $list->whereIn($field, $value);
                } else {
                    $list->where($field, $value);
                }
            }
        }

        if (isset($request->search)) {
            $fields = QueryService::fieldsLike($this->TableName);
            $list->where(function ($q) use ($fields, $request) {
                foreach ($fields as $column) {
                    $q->orWhere($column, 'LIKE', "%{$request->search}%");
                }
            });
        }

        $data['tableFields'] = Metadata::tableFields($this->Model->getTable());
        $data['tableValues'] = $list->where('active', '<>', 2)
            ->orderBy('id', 'desc')
            ->get();

        $view = view()->exists("console-service::{$this->Route}.index") ? "console-service::{$this->Route}.index" : "console-service::module-base.index";

        return view($view, $data);
    }

    public function form(int $id = null, Request $request)
    {
        $data = [
            'id'                     => $id,
            'route'                  => $this->Route,
            'name'                   => $this->Name,
            'nav'                    => $this->setNav($request, $id),
            'navLanguageRoute'       => "{$this->Route}.form",
            'navLanguageRouteParams' => ['id' => $id],
            'classItem'              => [],
            'enableLanguages'        => $this->EnableLanguages,
        ];

        $LanguageDefault = Language::where('default', true)->first();

        $language_id             = isset($request->language_id) ? $request->language_id : $LanguageDefault->id;
        $data['language_id']     = $language_id;
        $data['languageDefault'] = $LanguageDefault;

        $formValues = $this->Model->find($id);
        if (isset($request->language_id)) {
            
        }
        $formValues = $formValues ? $formValues->toArray() : [];

        $routeFrom = is_null($id) ? route("{$this->Route}.store", ['id' => $id]) : route("{$this->Route}.update", ['id' => $id]);

        $FormGenerator = new FormGenerator($routeFrom);
        $setData       = $this->setData($request);
        if (count($setData) > 0) {
            foreach ($setData as $key => $value) {

                $input = $FormGenerator->input($key)
                    ->setType('hidden');

                if (empty($value) == false) {
                    $input->setValue($value);
                }
            }
        }

        if (is_null($id) === false) {
            $FormGenerator->setVars('id', $id);
        }

        $FormGenerator->modelForm($this->Model, $formValues);

        $data['form'] = $FormGenerator->render();

        $view = view()->exists("console-service::{$this->Route}.form") ? "console-service::{$this->Route}.form" : "console-service::module-base.form";

        return view($view, $data);
    }

    public function active(int $id)
    {
        $Object = $this->Model->find($id);

        $Object->active = $Object->active === 1 ? 0 : 1;
        $Object->save();

        return redirect()->back();
    }

    public function destroy(int $id)
    {
        $Object = $this->Model->find($id);

        $Object->active = 2;
        $Object->save();

        return redirect()->back();
    }

    /**
     * EXTRA
     */

    private function setModuleVariables(): void
    {
        $ModuleConfig = App::make("\SenventhCode\ConsoleService\App\Services\ModuleConfig\Module\\" . ucwords($this->Route) . "ModuleConfig");

        $this->Route     = $ModuleConfig->Route;
        $this->TableName = $ModuleConfig->TableName;
        $this->Name      = $ModuleConfig->Name;
        if (isset($ModuleConfig->EnableLanguages)) {
            $this->EnableLanguages = $ModuleConfig->EnableLanguages;
        }
    }

    protected function setData(Request $request): array
    {
        $ModuleConfig = App::make("\SenventhCode\ConsoleService\App\Services\ModuleConfig\Module\\" . ucwords($this->Route) . "ModuleConfig");

        return $ModuleConfig->setData($request);
    }

    protected function setCondition(Request $request): array
    {
        $ModuleConfig = App::make("\SenventhCode\ConsoleService\App\Services\ModuleConfig\Module\\" . ucwords($this->Route) . "ModuleConfig");

        return $ModuleConfig->setCondition($request);
    }

    protected function setNav(Request $request, int $id = null): array
    {
        $ModuleConfig = App::make("\SenventhCode\ConsoleService\App\Services\ModuleConfig\Module\\" . ucwords($this->Route) . "ModuleConfig");

        return $ModuleConfig->setNav($request, $id);
    }
}
