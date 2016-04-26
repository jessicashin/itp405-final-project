<?php

namespace App\Http\Controllers;

use App\Models\Lookup\Ethnicity;
use App\Models\Lookup\RelationshipType;
use App\Models\Lookup\State;
use App\Models\Lookup\Title;
use App\Models\Lookup\School;
use App\Models\Lookup\FirstLanguage;
use App\Models\Student;
use Illuminate\Http\Request;

use Validator;
use App\Http\Requests;

class StudentController extends Controller
{
    public function search() {
        $students = Student::orderBy('fname')->get();
        return view('search', [
            'students' => $students,
        ]);
    }

    public function show(Request $request) {
        $messages = [
            'student.required' => 'No student was selected!',
        ];

        $validator = Validator::make($request->all(), ['student' => 'required'], $messages);
        if ($validator->fails()) {
            return redirect('/search')->withErrors($validator);
        }

        $studentId = $request->input('student');
        $student = Student::with('parent1', 'parent2')->find($studentId);

        return view('profile', [
            'student' => $student
        ]);
    }

    public function create() {
        $schools = School::orderBy('name')->get();
        $firstLanguages = FirstLanguage::all();
        $ethnicities = Ethnicity::all();
        $relationshipTypes = RelationshipType::all();
        $titles = Title::all();
        $states = State::all();

        return view('register', [
            'schools' => $schools,
            'firstLanguages' => $firstLanguages,
            'ethnicities' => $ethnicities,
            'relationshipTypes' => $relationshipTypes,
            'titles' => $titles,
            'states' => $states
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'student' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/register')
                ->withInput()
                ->withErrors($validator);
        }
    }

    public function messages()
    {
        return [
            'student.required' => 'No search was entered'
        ];
    }

}
