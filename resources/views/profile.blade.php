@extends('layouts.master')
@section('page-title', 'Student Profile')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2>Student Information</h2>
                <h3><?php echo $student->name() ?></h3>
                <p>Gender: <?php echo $student->gender() ?></p>
                <p>Birthdate: <?php echo $student->birthdate ?></p>
                <p>Grade: <?php echo $student->grade ?></p>
                <p>School: <?php echo $student->school->name ?></p>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <h3>Primary Parent/Guardian Information</h3>
                    <h4><?php echo $student->parent1->name() ?></h4>
                </div>
                <?php if ($student->parent2 != null) { ?>
                    <br>
                    <div class="row">
                        <h3>Parent/Guardian 2 Information</h3>
                        <h4><?php echo $student->parent2->name() ?></h4>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

@endsection