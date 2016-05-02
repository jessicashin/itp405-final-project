@extends('layouts.master')
@section('page-title', 'Instructors')

@section('page-css')
    <link rel="stylesheet" href="/css/instructors.css">
@endsection

@section('content')

    <div class="container">
        <div class="container" style="max-width: 700px">
            <h2 class="heading">Instructor Information</h2>
            <table class="table table-striped">
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    <th>Hire Date</th>
                </tr>
                @foreach ($instructors as $instructor)
                    <tr>
                        <td>{{ $instructor->fname }}</td>
                        <td>{{ $instructor->lname }}</td>
                        <td><span class="phone">{{ $instructor->phone }}</span></td>
                        <td>{{ date('m/d/Y', strtotime($instructor->created_at)) }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

@endsection

@section('page-js')
    <script type="text/javascript">
        $(document).ready(function(){
            $(".phone").text(function(i, text) {
                text = text.replace(/(\d{3})(\d{3})(\d{4})/, "($1) $2-$3");
                return text;
            });
        });
    </script>
@endsection
