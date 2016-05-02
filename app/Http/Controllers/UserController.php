<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

use App\Http\Requests;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function show() {
        $users = User::all();
        $current_user = Auth::user();
        return view('users', [
            'users' => $users,
            'current_user' => $current_user,
        ]);
    }

    protected function create(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:45',
            'username' => 'required|max:30|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect('/users')
                ->withErrors($validator, 'createErrors')
                ->withInput();
        }

        if (!empty($request->input('admin'))) {
            $admin = 1;
        } else {
            $admin = 0;
        }

        User::create([
            'name' => $request->input('name'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'admin' => $admin,
        ]);

        return redirect('/users')->with('create-success', true);
    }

    public function update($id, Request $request) {
        $user = User::find($id);

        $validator = Validator::make($request->all(), [
            $id.'_name' => 'required',
            $id.'_username' => 'required|unique:users,username,'.$id,
            'current_password' => 'required_with:new_password|max:45',
            'new_password' => 'sometimes|min:6|confirmed',
        ], [
            'required' => 'The name and username are required.',
            'unique' => 'The username is already taken.',
            'required_with' => 'Please enter the current password.',
        ]);
        if (!empty($request->input('current_password')) && !empty($request->input('new_password'))) {
            if (!Hash::check($request->input('current_password'), $user->password)) {
                $validator->errors()->add('current_password', 'Current password is incorrect.');
                return redirect('/users')
                    ->withErrors($validator, 'editErrors')
                    ->with('edit', $id)
                    ->withInput();
            }
        }
        if ($validator->fails()) {
            return redirect('/users')
                ->withErrors($validator, 'editErrors')
                ->with('edit', $id)
                ->withInput();
        }

        if (!empty($request->input($id.'_admin'))) {
            $admin = 1;
        } else {
            $admin = 0;
        }

        $user->name = $request->input($id.'_name');
        $user->username = $request->input($id.'_username');
        $user->admin = $admin;
        if (!empty($request->input('new_password'))) {
            $user->password = bcrypt($request->input('new_password'));
        }

        $user->save();

        return redirect('/users')->with('edit-success', true);
    }

    public function destroy($id) {
        $user = User::find($id);
        $user->delete();
        return redirect('/users')->with('delete-success', true);
    }

}
