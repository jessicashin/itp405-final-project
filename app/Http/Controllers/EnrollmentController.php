<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

use App\Http\Requests;

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id) {
        $students = Student::orderBy('fname')->get();
        $student = Student::with('enrollments')->find($id);
        return view('enrollment', [
            'students' => $students,
            'student' => $student,
        ]);
    }
}
