<?php

namespace SenventhCode\ConsoleService\App\Http\Controllers;

use App\Exports\UsersExport;
use App\Models\Category;
use App\Models\UserAddress;
use App\Models\User as Model;
use App\Models\UserExtension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use SenventhCode\ConsoleService\App\Http\Requests\Password;
use SenventhCode\ConsoleService\App\Http\Requests\UsersAddressStore;
use SenventhCode\ConsoleService\App\Http\Requests\UsersAddressUpdate;
use SenventhCode\ConsoleService\App\Http\Requests\UsersStore;
use SenventhCode\ConsoleService\App\Http\Requests\UsersUpdate;
use SenventhCode\FormGenerator\FormGenerator;

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

        $User->category()->associate($category_id)->save();

        return;
    }

    /**
     * ADDRESS
     */

    public function address(int $id, int $address_id = null, Request $request)
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

        $data['addresses'] = Model::find($id)->addresses;

        $valuesForm = [];
        if (is_null($address_id) === false) {
            $valuesForm = $data['addresses']->where('id', $address_id)->first()->toArray();
        }

        $routeForm = is_null($address_id) ? route('user.address-store', ['id' => $id]) : route('user.address-update', ['id' => $id]);

        $Form = new FormGenerator($routeForm);
        $Form->modelForm(new UserAddress, $valuesForm);

        $data['form'] = $Form->render();

        return view('console-service::user.address', $data);
    }

    public function addressStore(int $id, UsersAddressStore $request)
    {
        $User = Model::find($id);
        $User->addresses()->create($request->all());

        return redirect()->route('user.address', ['id' => $id, 'category_id' => $User->category_id]);
    }

    public function addressUpdate(int $id, UsersAddressUpdate $request)
    {
        $User = Model::find($id);
        $User->addresses()->where('id', $request->id)->first()->fill($request->all())->save();

        return redirect()->route('user.address', ['id' => $id, 'category_id' => $User->category_id]);
    }

    public function addressDestroy(int $id, int $address_id)
    {
        $User = Model::find($id);
        $User->addresses()->where('id', $address_id)->update(['active' => 2]);

        return redirect()->route('user.address', ['id' => $id, 'category_id' => $User->category_id]);
    }

    /**
     * EXTENSION
     */

    public function extension(int $id, Request $request)
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

        $valuesForm = Model::find($id)->extension->toArray();

        $Form = new FormGenerator(route('user.extension-update', ['id' => $id]));
        $Form->modelForm(new UserExtension, $valuesForm);

        $data['form'] = $Form->render();

        return view('console-service::module-base.form', $data);
    }

    public function extensionUpdate(int $id, Request $request)
    {
        $User = Model::find($id);
        $User->extension->fill($request->all())->save();

        return redirect()->route('user.extension', ['id' => $id, 'category_id' => $User->category_id]);
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

        $options = [];

        $categories = Category::find(2)->secondary;
        if ($categories->count() > 0) {
            foreach ($categories as $key => $value) {
                $options[$value->id] = $value->contents->first()->title;
            }
        }

        $FormGenerator = new FormGenerator(route('user.category-store', ['id' => $id]));

        $FormGenerator->select('category_id')->setLabel('Categoria')->setOptions($options)->setRequired(true)->setValue(Model::find($id)->category_id);
        $FormGenerator->button('enviar')->setLabel('Enviar');

        $data['form'] = $FormGenerator->render();

        return view('console-service::module-base.form', $data);
    }

    public function categoryStore(int $id, Request $request)
    {
        $this->saveLink($id, $request->category_id);

        $request->session()->flash('success', 'Ação realizada com sucesso!');

        $category_id = Model::find($id)->category_id;

        return redirect()->route('user.category', ['id' => $id, 'category_id' => $category_id]);
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

        $form = new FormGenerator(route('user.password-store', ['id' => $id]));

        $form->input('password')->setLabel('Senha')->setType('password')->setRequired(true);
        $form->input('co-password')->setLabel('Confirmação de senha')->setType('password')->setRequired(true);
        $form->button('enviar')->setLabel('Enviar');

        $data['form'] = $form->render();

        return view('console-service::module-base.form', $data);
    }

    public function passwordStore(int $id, Password $request)
    {
        Model::find($id)->fill(['password' => Hash::make($request->password)])->save();

        $request->session()->flash('success', 'Ação realizada com sucesso!');

        return redirect()->route("{$this->Route}.password", ['id' => $id, 'category_id' => $request->category_id]);
    }

    /**
     * EXPORT
     */

    public function export(Request $request)
    {
        return Excel::download(new UsersExport($request->category_id), 'users.xlsx');
    }
}
