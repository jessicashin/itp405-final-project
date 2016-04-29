@extends('layouts.master')
@section('page-title', 'Student Profile')

@section('content')

    <div class="container" style="margin-bottom: 20px">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ $photo->url_q }}" style="vertical-align: text-bottom; margin: 30px 20px 0 0;">
                <div style="display: inline-block; margin-bottom: 10px">
                    <h3>Student Information</h3>
                    <h2>{{ $student->name() }}</h2>
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
                        <td>{{ $student->cphone }}</td>
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
                <div class="row">
                    <h4 style="margin-top: 30px">Primary Parent/Guardian Information</h4>
                    <h4>{{ $student->parent1->name() }}</h4>
                    <table class="table table-striped">
                        <tr>
                            <td>Relationship</td>
                            <td>{{ $student->parent1Relationship->name }}</td>
                        </tr>
                        <tr>
                            <td>Home Phone</td>
                            <td>{{ $student->parent1->hphone }}</td>
                        </tr>
                        <tr>
                            <td>Cell Phone</td>
                            <td>{{ $student->parent1->cphone }}</td>
                        </tr>
                        <tr>
                            <td>Work Phone</td>
                            <td>@if ($student->parent1->wphone != null) {{ $student->parent1->wphone }} @endif</td>
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
                                    {{ $student->parent2->hphone }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Cell Phone</td>
                            <td>
                                @if ($student->parent2 != null && $student->parent2->cphone != null)
                                    {{ $student->parent2->cphone }}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Work Phone</td>
                            <td>
                                @if ($student->parent2 != null && $student->parent2->wphone != null)
                                    {{ $student->parent2->wphone }}
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

@endsection