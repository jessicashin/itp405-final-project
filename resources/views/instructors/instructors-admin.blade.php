@extends('layouts.master')
@section('page-title', 'Instructors')

@section('page-css')
    <link rel="stylesheet" href="/css/instructors.css">
@endsection

@section('content')

    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h2 class="heading">Add New Instructor</h2>
                    <form action="/admin/instructors" method="post">
                        {{ csrf_field() }}
                        <div class="container-fluid">
                            @if (session('create-success'))
                                <div class="alert alert-success" style="text-align: center">
                                    Instructor was successfully created.
                                </div>
                            @endif
                            @if (count($errors->createErrors) > 0)
                                <div class="alert alert-danger" style="text-align: center">
                                    {{ $errors->createErrors->first() }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="fname" class="sr-only">First Name</label>
                                <input type="text" id="fname" name="fname" class="form-control" placeholder="First name" value="{{ old('fname') }}">
                            </div>
                            <div class="form-group">
                                <label for="lname" class="sr-only">Last Name</label>
                                <input type="text" id="lname" name="lname" class="form-control" placeholder="Last name" value="{{ old('lname') }}">
                            </div>
                            <div class="form-group">
                                <label for="phone" class="sr-only">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone" data-mask="9999999999" value="{{ old('phone') }}">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Create</button>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
                <div class="col-sm-offset-1 col-sm-7">
                    <h2 class="heading">Instructors</h2>
                    @if (session('edit-success'))
                        <div class="alert alert-success" style="text-align: center">
                            Instructor information was successfully updated.
                        </div>
                    @endif
                    @if (session('delete-success'))
                        <div class="alert alert-success" style="text-align: center">
                            Instructor was successfully deleted.
                        </div>
                    @endif
                    <table class="table table-striped">
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Phone</th>
                            <th>Hire Date</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($instructors as $instructor)
                            <tr>
                                <td>{{ $instructor->fname }}</td>
                                <td>{{ $instructor->lname }}</td>
                                <td><span class="phone">{{ $instructor->phone }}</span></td>
                                <td>{{ date('m/d/Y', strtotime($instructor->created_at)) }}</td>
                                <td><a href="#" data-toggle="modal" data-target="#edit{{ $instructor->id }}">Edit</a></td>
                                <td><a href="#" data-toggle="modal" data-target="#delete{{ $instructor->id }}">Delete</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($instructors as $instructor)
        <!-- Modal -->
        <div class="modal" id="edit{{ $instructor->id }}" tabindex="-1" role="dialog" aria-labelledby="edit{{ $instructor->id }}Label">
            <div class="modal-dialog edit-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="edit{{ $instructor->id }}Label">Edit Instructor:&nbsp; {{ $instructor->name() }}</h4>
                    </div>
                    <form action="/admin/instructors/{{ $instructor->id }}" method="post" class="form-horizontal">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="container-fluid modal-form">
                                @if (count($errors->editErrors) > 0)
                                    <div class="alert alert-danger" style="text-align: center">
                                        {{ $errors->editErrors->first() }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="{{ $instructor->id }}_name" class="control-label col-sm-3">First Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="{{ $instructor->id }}_fname" name="{{ $instructor->id }}_fname" class="form-control" placeholder="First name" value="@if(old($instructor->id.'_fname')){{ old($instructor->id.'_fname') }}@else{{ $instructor->fname }}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="{{ $instructor->id }}_lname" class="control-label col-sm-3">Last name</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="{{ $instructor->id }}_lname" name="{{ $instructor->id }}_lname" class="form-control" placeholder="Last name" value="@if(old($instructor->id.'_lname')){{ old($instructor->id.'_lname') }}@else{{ $instructor->lname }}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="{{ $instructor->id }}_phone" class="control-label col-sm-3">Phone</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="{{ $instructor->id }}_phone" name="{{ $instructor->id }}_phone" class="form-control" placeholder="Phone" data-mask="9999999999" value="@if(old($instructor->id.'_phone')){{ old($instructor->id.'_phone') }}@else{{ $instructor->phone }}@endif">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="delete{{ $instructor->id }}" tabindex="-1" role="dialog" aria-labelledby="delete{{ $instructor->id }}Label">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <form action="/admin/instructors/{{ $instructor->id }}" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="container-fluid modal-form">
                                <p class="delete-text">Are you sure you want to delete instructor <strong>{{ $instructor->name() }}</strong>?</p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('page-js')
    <script>
        $('div.alert').delay(3000).slideUp(300);
    </script>
    @if (session('edit'))
        <script>
            $(function() {
                $('#edit<?php echo session('edit') ?>').modal('show');
            });
        </script>
    @endif
    <script type="text/javascript">
        $(document).ready(function(){
            $(".phone").text(function(i, text) {
                text = text.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
                return text;
            });
        });
    </script>
@endsection
