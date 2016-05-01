@extends('layouts.master')
@section('page-title', 'Register')

@section('page-css')
    <link rel="stylesheet" href="/css/register.css">
@endsection

@section('content')

    <div class="container">
        <form action="/register" method="post" class="register-form form-horizontal">
            {{ csrf_field() }}
            <div class="container-fluid">
                <h2 style="text-align: center;">Register New Student</h2>
                <hr>
                @if (session('success'))
                    <div class="alert alert-success" style="text-align: center">
                        Student was successfully registered.
                    </div>
                @endif
                @if (count($errors) > 0)
                    <div class="alert alert-danger" style="text-align: center">
                        {{ $errors->first() }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="s_fname" class="control-label col-sm-3"><span class="required">*</span> First Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="s_fname" name="s_fname" class="form-control" value="{{ old('s_fname') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_lname" class="control-label col-sm-3"><span class="required">*</span> Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="s_lname" name="s_lname" class="form-control" value="{{ old('s_lname') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_mname" class="control-label col-sm-3">Middle Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="s_mname" name="s_mname" class="form-control" value="{{ old('s_mname') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_gender" class="control-label col-sm-3"><span class="required">*</span> Gender</label>
                    <div class="col-sm-9">
                        <label class="radio-inline">
                            <input type="radio" name="s_gender" id="s_genderm" value="M" @if (old('s_gender') ==  'M') checked="checked" @endif> Male
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="s_gender" id="s_genderf" value="F" @if (old('s_gender') ==  'F') checked="checked" @endif> Female
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_birthdate" class="control-label col-sm-3"><span class="required">*</span> Birthdate</label>
                    <div class="col-sm-9">
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" id="s_birthdate" name="s_birthdate" value="{{ old('s_birthdate') }}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_grade" class="control-label col-sm-3"><span class="required">*</span> Grade</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="s_grade" name="s_grade">
                            <option></option>
                            @for ($i = 3; $i <= 12; $i++)
                                <option value="{{ $i }}" @if (old('s_grade') == $i) selected @endif>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_school" class="control-label col-sm-3"><span class="required">*</span> School</label>
                    <div class="col-sm-9">
                        <select class="form-control combobox" id="s_school" name="s_school">
                            <option></option>
                            @foreach ($schools as $school)
                                <option value="{{ $school->id }}" @if (old('s_school') == $school->id) selected @endif>{{ $school->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_cphone" class="control-label col-sm-3"><span class="required">*</span> Cell Phone</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="s_cphone" name="s_cphone" data-mask="(999) 999-9999" value="{{ old('s_cphone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_email" class="control-label col-sm-3"><span class="required">*</span> Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="s_email" name="s_email" value="{{ old('s_email') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_birth_country" class="control-label col-sm-3">Birth Country</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="s_birth_country" name="s_birth_country" value="{{ old('s_birth_country') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_date_to_us" class="control-label col-sm-3">Date to U.S.</label>
                    <div class="col-sm-9">
                        <div class="input-group date" data-provide="datepicker">
                            <input type="text" class="form-control" id="s_date_to_us" name="s_date_to_us" value="{{ old('s_date_to_us') }}">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_first_language" class="control-label col-sm-3">First Language</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="s_first_language" name="s_first_language">
                            <option></option>
                            @foreach ($firstLanguages as $firstLanguage)
                                <option value="{{ $firstLanguage->id }}" @if (old('s_first_language') == $firstLanguage->id) selected @endif>{{ $firstLanguage->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="s_ethnicity" class="control-label col-sm-3">Ethnicity</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="s_ethnicity" name="s_ethnicity">
                            <option></option>
                            @foreach ($ethnicities as $ethnicity)
                                <option value="{{ $ethnicity->id }}" @if (old('s_ethnicity') == $ethnicity->id) selected @endif>{{ $ethnicity->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <hr>
                <h3 style="text-align: center;margin-bottom: 20px">Primary Parent/Guardian</h3>

                <div class="form-group">
                    <label for="p1_title" class="control-label col-sm-3">Title</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="p1_title" name="p1_title">
                            <option></option>
                            @foreach ($titles as $title)
                                <option value="{{ $title->id }}" @if (old('p1_title') == $title->id) selected @endif>{{ $title->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="p1_fname" class="control-label col-sm-3"><span class="required">*</span> First Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="p1_fname" name="p1_fname" class="form-control" value="{{ old('p1_fname') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p1_lname" class="control-label col-sm-3"><span class="required">*</span> Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="p1_lname" name="p1_lname" class="form-control" value="{{ old('p1_lname') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p1_relationship" class="control-label col-sm-3"><span class="required">*</span> Relationship</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="p1_relationship" name="p1_relationship">
                            <option></option>
                            @foreach ($relationshipTypes as $relationshipType)
                                <option value="{{ $relationshipType->id }}" @if (old('p1_relationship') == $relationshipType->id) selected @endif>{{ $relationshipType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="p1_hphone" class="control-label col-sm-3"><span class="required">*</span> Home Phone</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="p1_hphone" name="p1_hphone" data-mask="(999) 999-9999" value="{{ old('p1_hphone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p1_cphone" class="control-label col-sm-3"><span class="required">*</span> Cell Phone</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="p1_cphone" name="p1_cphone" data-mask="(999) 999-9999" value="{{ old('p1_cphone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p1_wphone" class="control-label col-sm-3">Work Phone</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="p1_wphone" name="p1_wphone" data-mask="(999) 999-9999" value="{{ old('p1_wphone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p1_street" class="control-label col-sm-3"><span class="required">*</span> Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="p1_street" name="p1_street" value="{{ old('p1_street') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p1_city" class="control-label col-sm-3"><span class="required">*</span> City</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="p1_city" name="p1_city" value="{{ old('p1_city') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p1_state" class="control-label col-sm-3"><span class="required">*</span> State</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="p1_state" name="p1_state">
                            <option></option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" @if (old('p1_state') == $state->id) selected @endif>{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="p1_zip" class="control-label col-sm-3"><span class="required">*</span> Zip Code</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="p1_zip" name="p1_zip" value="{{ old('p1_zip') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p1_email" class="control-label col-sm-3"><span class="required">*</span> Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="p1_email" name="p1_email" value="{{ old('p1_email') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="p1_progress_report" name="p1_progress_report" checked> Send a copy of progress report
                            </label>
                        </div>
                    </div>
                </div>



                <hr>
                <h3 style="text-align: center;margin-bottom: 20px">Parent/Guardian 2 (Optional)</h3>

                <div class="form-group">
                    <label for="p2_title" class="control-label col-sm-3">Title</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="p2_title" name="p2_title">
                            <option></option>
                            @foreach ($titles as $title)
                                <option value="{{ $title->id }}" @if (old('p2_title') == $title->id) selected @endif>{{ $title->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="p2_fname" class="control-label col-sm-3">First Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="p2_fname" name="p2_fname" class="form-control" value="{{ old('p2_fname') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p2_lname" class="control-label col-sm-3">Last Name</label>
                    <div class="col-sm-9">
                        <input type="text" id="p2_lname" name="p2_lname" class="form-control" value="{{ old('p2_lname') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p2_relationship" class="control-label col-sm-3">Relationship</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="p2_relationship" name="p2_relationship">
                            <option></option>
                            @foreach ($relationshipTypes as $relationshipType)
                                <option value="{{ $relationshipType->id }}" @if (old('p2_relationship') == $relationshipType->id) selected @endif>{{ $relationshipType->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="p2_hphone" class="control-label col-sm-3">Home Phone</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="p2_hphone" name="p2_hphone" data-mask="(999) 999-9999" value="{{ old('p2_hphone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p2_cphone" class="control-label col-sm-3">Cell Phone</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="p2_cphone" name="p2_cphone" data-mask="(999) 999-9999" value="{{ old('p2_cphone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p2_wphone" class="control-label col-sm-3">Work Phone</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="p2_wphone" name="p2_wphone" data-mask="(999) 999-9999" value="{{ old('p2_wphone') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p2_street" class="control-label col-sm-3">Address</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="p2_street" name="p2_street" value="{{ old('p2_street') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p2_city" class="control-label col-sm-3">City</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="p2_city" name="p2_city" value="{{ old('p2_city') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p2_state" class="control-label col-sm-3">State</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="p2_state" name="p2_state">
                            <option></option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}" @if (old('p2_state') == $state->id) selected @endif>{{ $state->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="p2_zip" class="control-label col-sm-3">Zip Code</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="p2_zip" name="p2_zip" value="{{ old('p2_zip') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label for="p2_email" class="control-label col-sm-3">Email</label>
                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="p2_email" name="p2_email" value="{{ old('p2_email') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-9">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="p2_progress_report" name="p2_progress_report" @if (old('p2_progress_report') == true) checked @endif> Send a copy of progress report
                            </label>
                        </div>
                    </div>
                </div>



                <hr>

                <div class="form-group" style="margin-top: 30px">
                    <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-primary btn-lg btn-block">Register</button>
                    </div>
                </div>
                <div class="form-group" style="margin-top: 30px">
                    <div class="col-sm-offset-3 col-sm-9">
                        <span class="required">*</span> Indicates required field.
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection


@section('page-js')
    <script>
        $('div.alert').delay(3000).slideUp(300);
    </script>
@endsection
