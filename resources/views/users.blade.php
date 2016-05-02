@extends('layouts.master')
@section('page-title', 'Users')

@section('page-css')
    <link rel="stylesheet" href="/css/users.css">
@endsection

@section('content')

    <div class="container">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h2 class="heading">Create New User</h2>
                    <form action="/admin/users" method="post">
                        {{ csrf_field() }}
                        <div class="container-fluid">
                            @if (session('create-success'))
                                <div class="alert alert-success" style="text-align: center">
                                    User was successfully created.
                                </div>
                            @endif
                            @if (count($errors->createErrors) > 0)
                                <div class="alert alert-danger" style="text-align: center">
                                    {{ $errors->createErrors->first() }}
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="name" class="sr-only">Full Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" value="{{ old('name') }}">
                            </div>
                            <div class="form-group">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" id="password" name="password" placeholder="Password" class="form-control">
                            </div>
                            <div class="form-group" style="margin-bottom: 5px">
                                <label for="password_confirmation" class="sr-only">Confirm Password</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" class="form-control">
                            </div>
                            <div class="form-group checkbox" style="margin-bottom: 15px">
                                <label>
                                    <input type="checkbox" id="admin" name="admin" @if (old('admin') == true) checked @endif> Admin Account
                                </label>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Create</button>
                            </div>
                        </div>
                    </form>
                    <br>
                </div>
                <div class="col-sm-offset-1 col-sm-7">
                    <h2 class="heading">Existing Users</h2>
                    @if (session('edit-success'))
                        <div class="alert alert-success" style="text-align: center">
                            User account was successfully updated.
                        </div>
                    @endif
                    @if (session('delete-success'))
                        <div class="alert alert-success" style="text-align: center">
                            User account was successfully deleted.
                        </div>
                    @endif
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Admin</th>
                            <th>Create Date</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach ($users as $user)
                            <tr @if($user->id == $current_user->id) class="info" @endif>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>@if($user->admin == 1) yes @else no @endif</td>
                                <td>{{ date('m/d/Y', strtotime($user->created_at)) }}</td>
                                <td><a href="#" data-toggle="modal" data-target="#editUser{{ $user->id }}">Edit</a></td>
                                <td>
                                    @if($user->id == $current_user->id)
                                        <span class="disabled-link">Delete</span>
                                    @else
                                        <a href="#" data-toggle="modal" data-target="#deleteUser{{ $user->id }}">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

    @foreach ($users as $user)
        <!-- Modal -->
        <div class="modal" id="editUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="editUser{{ $user->id }}Label">
            <div class="modal-dialog edit-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="editUser{{ $user->id }}Label">
                            @if ($user->id == $current_user->id)
                                Edit Your Account
                            @else
                                Edit User:&nbsp; {{ $user->name }}
                            @endif
                        </h4>
                    </div>
                    <form action="/admin/users/{{ $user->id }}" method="post" class="form-horizontal">
                        <div class="modal-body">
                            @if (count($errors->editErrors) > 0)
                                <div class="alert alert-danger" style="text-align: center">
                                    {{ $errors->editErrors->first() }}
                                </div>
                            @endif
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                            <div class="container-fluid modal-form">
                                <div class="form-group">
                                    <label for="{{ $user->id }}_name" class="control-label col-sm-3">Full Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="{{ $user->id }}_name" name="{{ $user->id }}_name" class="form-control" placeholder="Full Name" value="@if(!empty(old($user->id.'_name'))){{ old($user->id.'_name') }}@else{{ $user->name }}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="{{ $user->id }}_username" class="control-label col-sm-3">Username</label>
                                    <div class="col-sm-9">
                                        <input type="text" id="{{ $user->id }}_username" name="{{ $user->id }}_username" class="form-control" placeholder="Username" value="@if(!empty(old($user->id.'_username'))){{ old($user->id.'_username') }}@else{{ $user->username }}@endif">
                                    </div>
                                </div>
                                <div class="form-group checkbox" style="margin-bottom: 10px">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <label>
                                            <input type="checkbox" id="{{ $user->id }}_admin" name="{{ $user->id }}_admin" @if (old($user->id.'_admin') == true) checked @elseif ($user->admin == 1) checked @endif> Admin Account
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-header" style="margin-bottom: 20px;">
                                    <h4 class="modal-title">Change Password</h4>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">Current</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="current_password" placeholder="Current Password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-3">New</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="new_password" placeholder="New Password" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 5px">
                                    <label class="control-label col-sm-3">Confirm</label>
                                    <div class="col-sm-9">
                                        <input type="password" name="new_password_confirmation" placeholder="Confirm Password" class="form-control">
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
        <div class="modal fade" id="deleteUser{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteUser{{ $user->id }}Label">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="deleteUser{{ $user->id }}Label">Delete User:&nbsp; {{ $user->name }}</h4>
                    </div>
                    <form action="/admin/users/{{ $user->id }}" method="post">
                        <div class="modal-body">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <div class="container-fluid modal-form">
                                <p class="delete-text">Are you sure you want to delete user <strong>{{ $user->username }}</strong>?</p>
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
                $('#editUser<?php echo session('edit') ?>').modal('show');
            });
        </script>
    @endif
@endsection
