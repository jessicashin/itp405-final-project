<?php

namespace App\Http\Controllers;

use App\Models\ClassSection;
use App\Models\Course;
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

    public function search() {
        $courses = Course::with(
            'courseSession',
            'classSections',
            'enrollments')
            ->get();

        return view('courses.course-search', [
            'courses' => $courses,
        ]);
    }

    public function show($id) {
        $course = Course::with(
            'courseSession',
            'classSections',
            'enrollments')
            ->find($id);

        return view('courses.course-show', [
            'course' => $course,
        ]);
    }

    public function enroll($id, Request $request) {
        $course = Course::find($id);
    }

    public function create() {
        $classSessions = ClassSection::all();
        return view('courses.course-create', [
            'classSessions' => $classSessions
        ]);
    }

    public function store(Request $request) {

    }

}
