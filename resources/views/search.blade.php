@extends('layouts.master')
@section('page-title', 'Search')

@section('page-css')
    <link href="/css/search.css" rel="stylesheet">
@endsection

@section('content')

    <div class="container">
            <form action="/dvds" method="get" class="form-search">
                <h2 class="form-signin-heading">Search for a student</h2>
                <div class="form-group">
                    <label for="student" class="sr-only">Student name</label>
                    <input type="text" class="form-control" id="student" name="student" placeholder="Student name">
                </div>
                <button type="submit" class="btn btn-lg btn-primary btn-block">Search</button>
            </form>
    </div> <!-- /container -->

@endsection
