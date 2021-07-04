<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use App\Models\Category;
use App\Models\User as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use SenventhCode\ConsoleService\App\Http\Requests\Password;
use SenventhCode\ConsoleService\App\Http\Requests\UsersStore;
use SenventhCode\ConsoleService\App\Http\Requests\UsersUpdate;
use SenventhCode\FormGenerator\FormService;

class UserController extends MainController
{
    public function __construct()
    {
        $this->Route = 'user';
        parent::__construct(Model::class);
    }

    public function store(UsersStore $request)
    {
        $create = $request->all();

        if (empty($create['password']) === false) {
            $create['password'] = Hash::make($create['password']);
        } else {
            unset($create['password']);
        }

        $response = Model::create($create);
        $this->saveLink($response->id, $create['category_id']);

        return redirect()->route("{$this->Route}.form", ['id' => $response->id, 'category_id' => $request->category_id]);
    }

    public function update(int $id, UsersUpdate $request)
    {
        $fill = $request->all();

        if (empty($fill['password']) === false) {
            $fill['password'] = Hash::make($fill['password']);
        } else {
            unset($fill['password']);
        }

        Model::find($id)->fill($fill)->save();

        return redirect()->route("{$this->Route}.form", ['id' => $id, 'category_id' => $request->category_id]);
    }

    /**
     * OTHERS
     */

    private function saveLink(int $id, int $category_id): void
    {
        $User = Model::find($id);

        $User->categories()->detach();
        $User->categories()->attach($category_id);

        return;
    }

    /**
     * CATEGORY
     */

    public function category(int $id, Request $request)
    {
        $data = [
            'id'    => $id,
            'route' => $this->Route,
            'name'  => $this->Name,
            'nav'   => $this->setNav($request, $id),
        ];

        $setData = $this->setData($request);
        if (count($setData) > 0) {
            $data['extraData'] = $setData;
            $data              = array_merge($data, $setData);
        }

        $form = new FormService;

        $form->setAction(route('users.category-store', ['id' => $id]));
        $form->setAutocomplete(false);
        $form->setMethod('post');

        $categoryId = $form->newElement('select');
        $categoryId->setName('category_id');
        $categoryId->setLabel('Categoria');

        $categories = Category::find(2)->categorySecondary;
        if ($categories->count() > 0) {
            $options = [];
            foreach ($categories as $key => $value) {
                $options[$value->id] = $value->contents->first()->title;
            }

            $categoryId->setOptions($options);
            $categoryId->setValue(Model::find($id)->categories->first()->id);
        }

        $form->addElement($categoryId);

        $data['form'] = $form->render($data);

        return view('users.category', $data);
    }

    public function categoryStore(int $id, Request $request)
    {
        $this->saveLink($id, $request->category_id);

        return redirect()->route('users.category', ['id' => $id]);
    }

    /**
     * PASSWORD
     */

    public function password(int $id, Request $request)
    {
        $data = [
            'id'    => $id,
            'route' => $this->Route,
            'name'  => $this->Name,
            'nav'   => $this->setNav($request, $id),
        ];

        $setData = $this->setData($request);
        if (count($setData) > 0) {
            $data['extraData'] = $setData;
            $data              = array_merge($data, $setData);
        }

        $form = new FormElement;

        $form->setAction(route('users.password-store', ['id' => $id]));
        $form->setAutocomplete(false);
        $form->setMethod('post');

        $password = $form->newElement('input');
        $password->setName('password');
        $password->setType('password');
        $password->setLabel('Senha');

        $form->addElement($password);

        $coPassword = $form->newElement('input');
        $coPassword->setName('co-password');
        $coPassword->setType('password');
        $coPassword->setLabel('Confirmação de senha');

        $form->addElement($coPassword);

        $data['form'] = $form->render($data);

        return view('users.password', $data);
    }

    public function passwordStore(int $id, Password $request)
    {
        Model::find($id)->fill(['password' => Hash::make($request->password)])->save();

        return redirect()->route("{$this->Route}.password", ['id' => $id, 'category_id' => $request->category_id]);
    }
}
