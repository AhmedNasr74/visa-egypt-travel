<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\UserDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UserRequest;
use App\Models\Role;
use App\Models\User;

class UserController extends Controller
{

    public function index(UserDataTable $dataTable)
    {
        return $dataTable->render('dashboard.users.index');
    }


    public function create()
    {
        $roles = Role::all();
        return view('dashboard.users.create', compact('roles'));
    }


    public function store(UserRequest $request)
    {
        $user = User::create($request->getSanitized());
        $user->assignRole($request->get('roles'));
        session()->flash('message', 'User Created Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        $user->load('roles');
        $roles = Role::all();
        return view('dashboard.users.edit', compact('user', 'roles'));
    }


    public function update(UserRequest $request, User $user)
    {
        $user->update($request->getSanitized());
        $user->syncRoles($request->get('roles'));
        session()->flash('message', 'User Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }


    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'message' => 'User Deleted Successfully!'
        ]);
    }
}
