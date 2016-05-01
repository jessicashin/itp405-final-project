@extends('layouts.master')
@section('page-title', 'Billing')

@section('content')

    <div class="container" style="margin-bottom: 20px">

        <ul class="nav nav-pills">
            <li role="presentation"><a href="/students/{{ $student->id }}">Profile</a></li>
            <li role="presentation"><a href="/students/{{ $student->id }}/enrollment">Enrollment</a></li>
            <li role="presentation" class="active" style="margin-right: 20px"><a href="#">Billing</a></li>
            <li class="hidden-xs">
                <div class="nav-combobox">
                    <select class="form-control combobox" id="student_search">
                        <option></option>
                        @foreach ($students as $s)
                            <option value="{{$s->id}}" @if ($s->id == $student->id)
                            selected @endif>{{$s->id}} {{$s->name()}}</option>
                        @endforeach;
                    </select>
                </div>
            </li>
        </ul>


    </div>

@endsection


@section('page-js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('.combobox').combobox();
        });
    </script>

    <script type="text/javascript">
        document.getElementById('student_search').onchange = function(){
            if (this.value != '') {
                window.location = '/students/' + this.value + '/billing';
            }
        }
    </script>
@endsection