@extends('layouts.master')
@section('page-title', 'Profile')

@section('content')

    <div class="container">

        <ul class="nav nav-pills" style="margin-bottom: 10px">
            <li role="presentation" class="active"><a href="#">Profile</a></li>
            <li role="presentation"><a href="/students/{{ $student->id }}/enrollment">Enrollment</a></li>
            <li role="presentation" style="margin-right: 20px"><a href="/students/{{ $student->id }}/billing">Billing</a></li>
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

        <div class="row">
            <div class="col-md-6">
                <img src="{{ $photo->url_q }}" style="vertical-align: text-bottom; margin: 30px 20px 0 0;">
                <div style="display: inline-block; margin-bottom: 10px">
                    <h3>Student Information</h3>
                    <h2 style="margin-top: 0">{{ $student->name() }}</h2>
                </div>

                <table class="table table-striped">
                    <tr>
                        <td>Student ID</td>
                        <td>{{ $student->id }}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>{{ $student->gender() }}</td>
                    </tr>
                    <tr>
                        <td>Birthdate</td>
                        <td>{{ date('n/j/Y', strtotime($student->birthdate)) }}</td>
                    </tr>
                    <tr>
                        <td>Grade</td>
                        <td>{{ $student->grade }}</td>
                    </tr>
                    <tr>
                        <td>School</td>
                        <td>{{ $student->school->name }}</td>
                    </tr>
                    <tr>
                        <td>Cell Phone</td>
                        <td><span class="phone">{{ $student->cphone }}</span></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $student->email }}</td>
                    </tr>
                    <tr>
                        <td>Birth Country</td>
                        <td>@if($student->birth_country != null) {{ $student->birth_country }} @endif</td>
                    </tr>
                    <tr>
                        <td>Date to U.S.</td>
                        <td>@if($student->date_to_us != null){{ date('n/j/Y', strtotime($student->date_to_us)) }} @endif</td>
                    </tr>
                    <tr>
                        <td>First Language</td>
                        <td>@if($student->firstLanguage != null) {{ $student->firstLanguage->name }} @endif</td>
                    </tr>
                    <tr>
                        <td>Ethnicity</td>
                        <td>@if($student->ethnicity != null) {{ $student->ethnicity->name }} @endif</td>
                    </tr>
                    <tr>
                        <td>Register Date</td>
                        <td>{{ date('n/j/Y', strtotime($student->created_at)) }}</td>
                    </tr>
                </table>
            </div>

            <div class="col-md-offset-1 col-md-5">
                <div style="margin: 25px 15px 0">
                    <div class="row">
                        <h4>Primary Parent/Guardian Information</h4>
                        <h4>{{ $student->parent1->name() }}</h4>
                        <table class="table table-striped">
                            <tr>
                                <td>Relationship</td>
                                <td>{{ $student->parent1Relationship->name }}</td>
                            </tr>
                            <tr>
                                <td>Home Phone</td>
                                <td><span class="phone">{{ $student->parent1->hphone }}</span></td>
                            </tr>
                            <tr>
                                <td>Cell Phone</td>
                                <td><span class="phone">{{ $student->parent1->cphone }}</span></td>
                            </tr>
                            <tr>
                                <td>Work Phone</td>
                                <td>
                                    @if ($student->parent1->wphone != null)
                                        <span class="phone">{{ $student->parent1->wphone }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    {{ $student->parent1->address->street }}<br>
                                    {{ $student->parent1->address->city }},
                                    {{ $student->parent1->address->state->code }}
                                    {{ $student->parent1->address->zip }}
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>{{ $student->parent1->email }}</td>
                            </tr>
                            <tr>
                                <td>Progress Report</td>
                                <td>{{ $student->parent1->progressReport() }}</td>
                            </tr>
                        </table>
                    </div>
                    <br>
                    <div class="row">
                        <h4>Parent/Guardian 2 Information</h4>
                        <h4>@if ($student->parent2 != null) {{ $student->parent2->name() }} @endif</h4>
                        <table class="table table-striped">
                            <tr>
                                <td>Relationship</td>
                                <td>
                                    @if ($student->parent2 != null)
                                        {{ $student->parent2->relationship->name }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Home Phone</td>
                                <td>
                                    @if ($student->parent2 != null && $student->parent2->hphone != null)
                                        <span class="phone">{{ $student->parent2->hphone }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Cell Phone</td>
                                <td>
                                    @if ($student->parent2 != null && $student->parent2->cphone != null)
                                        <span class="phone">{{ $student->parent2->cphone }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Work Phone</td>
                                <td>
                                    @if ($student->parent2 != null && $student->parent2->wphone != null)
                                        <span class="phone">{{ $student->parent2->wphone }}</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    @if ($student->parent2 != null && $student->parent2->address != null)
                                        {{ $student->parent2->address->street }}<br>
                                        {{ $student->parent2->address->city }},
                                        {{ $student->parent2->address->state->code }}
                                        {{ $student->parent2->address->zip }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    @if ($student->parent2 != null && $student->parent2->email != null)
                                        {{ $student->parent2->email }}
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Progress Report</td>
                                <td>
                                    @if ($student->parent2 != null)
                                        {{ $student->parent2->progressReport() }}
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
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
                window.location = '/students/' + this.value;
            }
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".phone").text(function(i, text) {
                text = text.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
                return text;
            });
        });
    </script>
@endsection