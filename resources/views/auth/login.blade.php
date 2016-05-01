<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>SRDB - Log In</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/login.css">

    <link rel="shortcut icon" href="{{ asset('/images/favicon.ico') }}">
</head>
<body>
    <div class="container">

        <div class="login-form">
            <h1 class="logo"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> SRDB</h1>
            <h4 class="subheading">Student Records DataBase</h4>
            @if (session('success'))
                <div class="alert alert-success" style="text-align: center">
                    You have been logged out successfully.
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger" style="text-align: center">
                    {{ $errors->first() }}
                </div>
            @endif
            <form method="POST" action="/login">
                {{ csrf_field() }}
                <label for="username" class="sr-only">Username</label>
                <input type="text" id="username" name="username" class="form-control" placeholder="Username" value="{{ old('username') }}" autofocus>
                <label for="password" class="sr-only">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Log in</button>
                </div>
            </form>
        </div>

    </div> <!-- /container -->


    <footer class="footer">
        <div class="footer-container container text-center">
            <p class="text-muted">
                <span class="footer-text">30 April 2016</span>
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

    <script>
        $('div.alert').delay(3000).slideUp(300);
    </script>

</body>
</html>
