<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\CreateRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;

        $this->middleware('can:read_user')->only('index', 'show');
        $this->middleware('can:create_user')->only('create', 'store');
        $this->middleware('can:edit_user')->only('edit', 'update');
    }

    public function index()
    {
        $users = $this->user->paginate(10);
        return view('user.index', ['users' => $users]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', ['roles' => $roles]);
    }

    public function store(CreateRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);

        $user = $this->user->create($data);

        $user->roles()->attach($data['role_id']);

        return back();
    }

    public function show($id)
    {
        return view('user.show');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('user.edit', ['roles' => $roles, 'user' => $user]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();

        if(!$data['password']){
            $data['password'] = $user->password;
        }
        else{
            $data['password'] = bcrypt($data['password']);
        }

        $user->update($data);

        $user->roles()->sync($data['role_id']);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back();
    }
}
