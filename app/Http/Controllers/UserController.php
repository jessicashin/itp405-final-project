<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
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
        return view('auth.users', [
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
                ->withErrors($validator)
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

        return redirect('/users')->with('success', true);
    }
}
