<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('pages.admin.user.index', [
            'users' => $users
        ]);
    }

    public function create()
    {
        return view('pages.admin.user.create');
    }

    public function store(Request $request)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'roles' => 'required|string|in:ADMIN,AUTHOR',
        ]);

        $data['password'] = bcrypt($request->password);

        User::create($data);

        return redirect()->route('admin.user.index');
    }

    public function edit($id)
    {
        $user = User::find($id);

        return view('pages.admin.user.edit', [
            'user' => $user
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required|string|in:ADMIN,AUTHOR',
        ]);

        $user = User::find($id);

        if($request->password)
        {
            $data['password'] =  bcrypt($request->password);
        }
        else 
        {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('admin.user.index');
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->route('admin.user.index');
    }
}
