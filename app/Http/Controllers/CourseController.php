<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin', ['only' => [
            'create',
            'store',
        ]]);
    }

    public function index() {

    }

    public function show($id) {

    }

    public function enroll($id) {

    }

    public function create() {

    }

    public function store(Request $request) {

    }

}
