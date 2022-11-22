<?php

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <script src="script/main.js"></script>
    <link rel="icon" href="assets/logo.png" type="image/ico">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>




    <div class="container" id="blur">
        <div class="row">
            <div class="col-md-6 mb-3" id="logo">
                <div class="col-md-7 mb-3">
                    <a id="quote">Where Awesome people wear our shirts</a>
                </div>
                <h1 id="quote1">GraphiteeShirt</h1>
            </div>


            <div class="col-md-6">

                <form action="includes/loginInclude.php" method="POST">
                    <h2 id="loginh" class="h1">Log in</h2>
                    <p id="loginp">log in you account</p>

                    <div class="form-group">
                        <a id="a1"></a> <a id="countdown"></a>
                        <input class="form-control" type="text" placeholder="Enter your username" name="logusername"></br>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" placeholder="Enter your password" name="logpassword"></br>
                    </div>
                    <div class="button">
                        <input type="submit" name="submit" class="row-s" value="Log in" id="log-button">
                    </div>
                    <hr>
                    <div class="register">
                        <label onclick="showregCon()" id="showbtn" class="showbtn"> Create new account</label>
                    </div>

                </form>
            </div>

        </div>
    </div>


    <div class="container" id="signupCon">
        <div class="col-md-6">
            <form action="includes/signupInclude.php" method="POST">
                <i onclick="exitregCon()" class="fa fa-window-close" aria-hidden="true" id="iconx"></i>
                <h2 class="h1">Sign up</h2>
                <p>sign up for an account</p>
                <hr>
                <div class="form-group">
                    <a id="a2"> Hello world</a></br>
                    <input class="form-control" type="text" placeholder="Username" name="username" id="username">
                </div>
                <div class="form-group">
                    <input class="form-control" type="email" placeholder="Email" name="email" id="email">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Firstname" name="firstname" id="firstname">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" placeholder="Lastname" name="lastname" id="lastname">
                </div>
                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Password" name="password">
                </div>

                <div class="form-group">
                    <input class="form-control" type="password" placeholder="Confirm Password" name="cpassword">
                </div>
                <div class="regsubmit">
                    <input class="form-control" type="submit" name="submit" id="regsub" value="Sign up">
                </div>
            </form>
        </div>
    </div>




    <!--  <h1 class="h1">Login</h1>

    <form action="includes/loginInclude.php" method="POST">
        <a id="a1">Empty fields </a></br>
        <input type="text" placeholder="Username" name="logusername"></br>
        <input type="password" placeholder="Password" name="logpassword"></br>
        <input type="submit" name="submit" class=log-button value="Login" id="log">
    </form>-->



</body>

</html>