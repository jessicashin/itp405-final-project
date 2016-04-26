@extends('layouts.master')
@section('page-title', 'Student Profile')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Student Information</h2>
                <h3>{{ $student->name() }}</h3>
                <p>Gender: {{ $student->gender() }}</p>
                <p>Birthdate: {{ $student->birthdate }}</p>
                <p>Grade: {{ $student->grade }}</p>
                <p>School: {{ $student->school->name }}</p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <h3>Primary Parent/Guardian Information</h3>
                    <h4>{{ $student->parent1->name() }}</h4>
                </div>
                @if ($student->parent2 != null)
                    <br>
                    <div class="row">
                        <h3>Parent/Guardian 2 Information</h3>
                        <h4>{{ $student->parent2->name() }}</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection