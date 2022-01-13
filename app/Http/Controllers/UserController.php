<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Redirect;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(2);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserRequest $request)
    {
        $data = $request->all();
        $data['profile_photo_path'] = $request->file('profile_photo_path')
            ->store('assets/user', 'public');
        $data['password'] = Hash::make($request->password);
        User::create($data);
        return Redirect::route('users.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
