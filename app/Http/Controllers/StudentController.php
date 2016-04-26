<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Models\Student;

class StudentController extends Controller
{
    public function search() {
        $students = Student::all();
        return view('search', [
            'students' => $students
        ]);
    }

    public function show(Request $request) {
        $studentId = $request->input('student');
        $student = Student::with('parent1', 'parent2')->find($studentId);

        return view('profile', [
            'student' => $student,
        ]);
    }

    public function create() {

    }

    public function store(Request $request) {

    }

}
