<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SRDB - @yield('page-title')</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    <link rel="stylesheet" href="/css/bootstrap-combobox.css">
    <link rel="stylesheet" href="/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="/css/master.css">
    @yield('page-css')

    <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}">
</head>
<body>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/search" style="margin-right: 5px;"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> SRDB</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="{{ Request::is('search') ? 'active' : '' }}"><a href="/search">Search</a></li>
                    <li class="{{ Request::is('register') ? 'active' : '' }}"><a href="/register">Register</a></li>
                    @if (\Illuminate\Support\Facades\Auth::user()->admin == 1)
                        <li class="dropdown {{ (Request::is('courses') || Request::is('admin/courses')) ? 'active' : '' }}">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Courses <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="courses">Manage courses</a></li>
                                <li><a href="admin/courses">Add new course</a></li>
                            </ul>
                        </li>
                        <li class="{{ Request::is('admin/instructors') ? 'active' : '' }}"><a href="/admin/instructors">Instructors</a></li>
                        <li class="{{ Request::is('admin/users') ? 'active' : '' }}"><a href="/admin/users">Users</a></li>
                    @else
                        <li class="{{ Request::is('courses') ? 'active' : '' }}"><a href="/courses">Courses</a></li>
                        <li class="{{ Request::is('instructors') ? 'active' : '' }}"><a href="/instructors">Instructors</a></li>
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden-sm"><a href="http://itpweb.herokuapp.com/assignments/405-final-project">Final Project</a></li>
                    <li class="hidden-sm"><a href="https://github.com/jessicashin/itp405-final-project">Github Repo</a></li>
                    <li><a href="/logout"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Log Out</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>

    @yield('content')

    <footer class="footer">
        <div class="footer-container container text-center">
            <p class="text-muted">
                <span class="footer-text">2 May 2016</span>
                <span class="footer-text">Jessica Shin</span>
                <span class="footer-text hidden-xs">ITP-405 Final Project</span>
                <span class="footer-text hidden-xs">Student Records DataBase</span>
            </p>
        </div>
    </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    <script src="/js/bootstrap-combobox.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>

    @yield('page-js')

</body>
</html>