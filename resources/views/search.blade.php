@extends('layouts.master')
@section('page-title', 'Search')

@section('page-css')
    <link rel="stylesheet" href="/css/search.css" >
    <link rel="stylesheet" href="/css/bootstrap-combobox.css">
@endsection

@section('content')

    <div class="container">
            <form action="/student" method="get" class="search-form">
                <h2 class="search-form-heading">Search for a student</h2>
                <div class="form-group">
                    <label for="student" class="sr-only">Student Name or ID</label>
                    <select class="form-control combobox" id="student" name="student" onchange="this.form.submit()">
                        <option></option>
                        <?php foreach ($students as $student) : ?>
                            <option value="<?php echo $student->id ?>"><?php echo $student->id . ' ' .$student->name() ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </form>
    </div> <!-- /container -->

@endsection

@section('page-js')
    <script src="/js/bootstrap-combobox.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.combobox').combobox();
        });
    </script>
@endsection
