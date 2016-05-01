@extends('layouts.master')
@section('page-title', 'Search')

@section('page-css')
    <link rel="stylesheet" href="/css/search.css">
@endsection

@section('content')

    <div class="container">

        <div class="search-form">
            <h2 class="search-form-heading">Search for a student</h2>
            <div class="form-group">
                <label for="student" class="sr-only">Student Name or ID</label>
                <select class="form-control combobox" id="student">
                    <option></option>
                    @foreach ($students as $student)
                        <option value="{{$student->id}}">{{$student->id}} {{$student->name()}}</option>
                    @endforeach;
                </select>
                <span id="helpBlock" class="help-block">You can search by name or student ID number.</span>
            </div>
        </div>

    </div> <!-- /container -->

@endsection

@section('page-js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.combobox').combobox();
        });
    </script>

    <script type="text/javascript">
        document.getElementById('student').onchange = function(){
            if (this.value != '') {
                window.location = '/students/' + this.value;
            }
        }
    </script>
@endsection
