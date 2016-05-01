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
                    @if (session('success'))
                        <div class="alert alert-success" style="text-align: center">
                            User was successfully created.
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger" style="text-align: center">
                            {{ $errors->first() }}
                        </div>
                    @endif
                    <form action="/users" method="post" class="form-horizontal">
                        {{ csrf_field() }}
                        <div class="container-fluid">
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
                    <table class="table table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Admin</th>
                            <th>Create Date</th>
                            <th></th>
                            <th></th>
                        </tr>
                        @foreach($users as $user)
                            <tr @if($user->id == $current_user->id) class="info" @endif>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>@if($user->admin == 1) yes @else no @endif</td>
                                <td>{{ date('m/d/Y', strtotime($user->created_at)) }}</td>
                                <td><a href="">Edit</a></td>
                                <td>
                                    @if($user->id == $current_user->id)
                                        <span class="disabled-link">Delete</span>
                                    @else
                                        <a href="">Delete</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('page-js')
    <script>
        $('div.alert').delay(3000).slideUp(300);
    </script>
@endsection
