<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

use App\Http\Requests;

class BillingController extends Controller
{
    public function show($id) {
        $students = Student::orderBy('fname')->get();
        $student = Student::with('billings')->find($id);
        return view('billing', [
            'students' => $students,
            'student' => $student,
        ]);
    }
}
