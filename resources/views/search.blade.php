@extends('layouts.master')
@section('page-title', 'Search')

@section('page-css')
    <link rel="stylesheet" href="/css/search.css" >
@endsection

@section('content')

    <div class="container">

        <form action="/student" method="get" class="search-form">
            <h2 class="search-form-heading">Search for a student</h2>

            @if (count($errors) > 0)
                <div class="alert alert-danger" style="text-align: center">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <div class="form-group">
                <label for="student" class="sr-only">Student Name or ID</label>
                <select class="form-control combobox" id="student" name="student" onchange="this.form.submit()">
                    <option></option>
                    @foreach ($students as $student)
                        <option value="{{$student->id}}">{{$student->id}} {{$student->name()}}</option>
                    @endforeach;
                </select>
                <span id="helpBlock" class="help-block">You can search by name or student ID number.</span>
            </div>
        </form>

    </div> <!-- /container -->

@endsection

@section('page-js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.combobox').combobox();
        });
    </script>
    <script>
        $('div.alert').delay(3000).slideUp(300);
    </script>
@endsection
