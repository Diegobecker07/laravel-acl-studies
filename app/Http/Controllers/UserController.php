<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:read_user')->only('index', 'show');
        $this->middleware('can:create_user')->only('create', 'store');
        $this->middleware('can:edit_user')->only('edit', 'update');
    }

    public function index()
    {
        $users = User::paginate(10);
        return view('user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role_id' => 'required',
        ]);
        $data['password'] = bcrypt($data['password']);

        $user = User::create($data);

        $user->roles()->attach($data['role_id']);

        return back();
    }

    public function show($id)
    {
        return view('user.show');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('user.edit', compact('roles', 'user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255',
            'password' => 'sometimes',
            'role_id' => 'sometimes',
        ]);

        $user = User::findOrFail($id);

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

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back();
    }
}
