<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Lookup\Ethnicity;
use App\Models\Lookup\RelationshipType;
use App\Models\Lookup\State;
use App\Models\Lookup\Title;
use App\Models\Lookup\School;
use App\Models\Lookup\FirstLanguage;
use App\Models\Parent1;
use App\Models\Parent2;
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
        $validator = Validator::make($request->all(), ['student' => 'required',],
            ['student.required' => 'No student was selected!',]);
        if ($validator->fails()) {
            return redirect('/search')->withErrors($validator);
        }

        $studentId = $request->input('student');
        $student = Student::with('parent1', 'parent2', 'school')->find($studentId);

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
            's_fname' => 'required',
            's_lname' => 'required',
            's_gender' => 'required',
            's_birthdate' => 'required',
            's_grade' => 'required',
            's_school' => 'required',
            's_cphone' => 'required',
            's_email' => 'required',
            'p1_fname' => 'required',
            'p1_lname' => 'required',
            'p1_relationship' => 'required',
            'p1_hphone' => 'required',
            'p1_lname' => 'required',
            'p1_cphone' => 'required',
            'p1_street' => 'required',
            'p1_city' => 'required',
            'p1_state' => 'required',
            'p1_zip' => 'required',
            'p1_email' => 'required',
            'p2_fname' => 'required_with:p2_relationship',
            'p2_lname' => 'required_with:p2_relationship',
            'p2_relationship' => 'required_with:p2_title,p2_fname,p2_lname,p2_hphone,p2_cphone,p2_wphone,p2_street,p2_email',
            'p2_street' => 'required_with:p2_city,p2_state,p2_zip',
            'p2_city' => 'required_with:p2_street,p2_state,p2_zip',
            'p2_state' => 'required_with:p2_street,p2_city,p2_zip',
            'p2_zip' => 'required_with:p2_street,p2_city,p2_state',
        ], [
            'required' => 'All required fields must be filled.',
            'p2_fname.required_with' => 'Please enter the First Name for Parent 2.',
            'p2_lname.required_with' => 'Please enter the Last Name for Parent 2.',
            'p2_relationship.required_with' => 'Please enter the Relationship for Parent 2.',
            'p2_street.required_with' => 'Please enter the Address for Parent 2.',
            'p2_city.required_with' => 'Please enter the City for Parent 2.',
            'p2_state.required_with' => 'Please enter the State for Parent 2.',
            'p2_zip.required_with' => 'Please enter the Zip Code for Parent 2.'
        ]);
        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        $parent1 = Parent1::where([
            'hphone' => $request->input('p1_hphone'),
            'fname' => $request->input('p1_fname'),
        ])->first();

        if ($parent1 == null) {

            // Create Parent 1 Address
            $address1 = Address::create([
                'street' => $request->input('p1_street'),
                'city' => $request->input('p1_city'),
                'state_id' => $request->input('p1_state'),
                'zip' => $request->input('p1_zip'),
            ]);

            // Create Parent 1
            $parent1 = new Parent1();
            if (!empty($request->input('p1_title'))) {
                $parent1->title_id = $request->input('p1_title');
            }
            $parent1->fname = $request->input('p1_fname');
            $parent1->lname = $request->input('p1_lname');
            $parent1->hphone = $request->input('p1_hphone');
            $parent1->cphone = $request->input('p1_cphone');
            if (!empty($request->input('p1_wphone'))) {
                $parent1->wphone = $request->input('p1_wphone');
            }
            $parent1->address_id = $address1->id;
            $parent1->email = $request->input('p1_email');
            if (!empty($request->input('p1_progress_report'))) {
                $parent1->progress_report = 1;
            } else {
                $parent1->progress_report = 0;
            }
            $parent1->save();
        }

        // Create Student
        $student = new Student();
        $studentId = $this->studentId($request->input('p1_hphone'));
        $student->id = $studentId;
        $student->fname = $request->input('s_fname');
        $student->lname = $request->input('s_lname');
        if (!empty($request->input('s_mname'))) {
            $student->mname = $request->input('s_mname');
        }
        $student->gender = $request->input('s_gender');
        $student->birthdate = date('Y-m-d', strtotime($request->input('s_birthdate')));
        $student->grade = $request->input('s_grade');
        $student->school_id = $request->input('s_school');
        $student->cphone = $request->input('s_cphone');
        $student->email = $request->input('s_email');
        if (!empty($request->input('s_birth_country'))) {
            $student->birth_country = $request->input('s_birth_country');
        }
        if (!empty($request->input('s_date_to_us'))) {
            $student->date_to_us = date('Y-m-d', strtotime($request->input('s_date_to_us')));
        }
        if (!empty($request->input('s_first_language'))) {
            $student->first_language_id = $request->input('s_first_language');
        }
        if (!empty($request->input('s_ethnicity'))) {
            $student->ethnicity_id = $request->input('s_ethnicity');
        }
        $student->parent1_relationship_id = $request->input('p1_relationship');
        $parent1->students()->save($student);

        // Create Parent 2 Address
        $address2 = null;
        if (!empty($request->input('p2_street'))) {
            $address2 = Address::where([
                'street' => $request->input('p2_street'),
                'zip' => $request->input('p2_zip'),
            ])->first();
            if ($address2 == null) {
                $address2 = Address::create([
                    'street' => $request->input('p2_street'),
                    'city' => $request->input('p2_city'),
                    'state_id' => $request->input('p2_state'),
                    'zip' => $request->input('p2_zip'),
                ]);
            }
        }

        // Create Parent 2
        if (!empty($request->input('p2_fname'))) {
            $parent2 = new Parent2();
            if (!empty($request->input('p2_title'))) {
                $parent2->title_id = $request->input('p2_title');
            }
            $parent2->fname = $request->input('p2_fname');
            $parent2->lname = $request->input('p2_lname');
            $parent2->relationship_id = $request->input('p2_relationship');
            if (!empty($request->input('p2_hphone'))) {
                $parent2->hphone = $request->input('p2_hphone');
            }
            if (!empty($request->input('p2_cphone'))) {
                $parent2->cphone = $request->input('p2_cphone');
            }
            if (!empty($request->input('p2_wphone'))) {
                $parent2->wphone = $request->input('p2_wphone');
            }
            if (!empty($address2)) {
                $parent2->address_id = $address2->id;
            }
            if (!empty($request->input('p2_email'))) {
                $parent2->email = $request->input('p2_email');
            }
            if (!empty($request->input('p2_progress_report'))) {
                $parent2->progress_report = 1;
            } else {
                $parent2->progress_report = 0;
            }
            $parent2->student_id = $studentId;
            $parent2->save();
        }
        return redirect('/register')->with('success', true);
    }

    public function studentId($hphone) {
        $branch_code = '129';
        $last_four_digits = substr($hphone, -4);
        $base_id = $branch_code . $last_four_digits;
        $count = 0;
        $student_id = $base_id . '00';
        $student = Student::find($student_id);
        while ($student != null) {
            $count++;
            $num_padded = sprintf("%02d", $count);
            $student_id = $base_id . $num_padded;
            $student = Student::find($student_id);
        }
        return $student_id;
    }

}
