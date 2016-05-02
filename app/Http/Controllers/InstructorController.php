<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Http\Request;

use Validator;
use App\Http\Requests;

class InstructorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['except' => ['show']]);
    }

    public function show() {
        $instructors = Instructor::all();
        return view('instructors.instructors', [
            'instructors' => $instructors,
        ]);
    }

    public function adminShow() {
        $instructors = Instructor::all();
        return view('instructors.instructors-admin', [
            'instructors' => $instructors,
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
        ], [
            'required' => 'All fields are required.',
        ]);
        if ($validator->fails()) {
            return redirect('/admin/instructors')
                ->withErrors($validator, 'createErrors')
                ->withInput();
        }

        Instructor::create([
            'fname' => $request->input('fname'),
            'lname' => $request->input('lname'),
            'phone' => $request->input('phone'),
        ]);

        return redirect('/admin/instructors')->with('create-success', true);
    }

    public function update($id, Request $request) {
        $instructor = Instructor::find($id);
        $validator = Validator::make($request->all(), [
            $id.'_fname' => 'required',
            $id.'_lname' => 'required',
            $id.'_phone' => 'required',
        ], [
            'required' => 'All fields are required.',
        ]);
        if ($validator->fails()) {
            return redirect('/admin/instructors')
                ->withErrors($validator, 'editErrors')
                ->with('edit', $id)
                ->withInput();
        }

        $instructor->fname = $request->input($id.'_fname');
        $instructor->lname = $request->input($id.'_lname');
        $instructor->phone = $request->input($id.'_phone');
        $instructor->save();

        return redirect('/admin/instructors')->with('edit-success', true);
    }

    public function destroy($id) {
        $instructor = Instructor::find($id);
        $instructor->delete();
        return redirect('/admin/instructors')->with('delete-success', true);
    }

}
