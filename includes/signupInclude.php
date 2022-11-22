<?php

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];

    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    include "../classes/connectiondb.php";
    include "../classes/signupModel.php";
    include "../classes/signupController.php";

    $signup = new signupController($username, $email, $password, $cpassword,$firstname,$lastname);
    $signup->signupUser();
   

    header("Location: ../index.php?error=none");   
}
