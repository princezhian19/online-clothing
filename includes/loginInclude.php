<?php

if (isset($_POST["submit"])) {

    $username = $_POST["logusername"];
    $password = $_POST["logpassword"];


    include "../classes/connectiondb.php";
    include "../classes/loginModel.php";
    include "../classes/loginController.php";


    
    $login = new loginController($username, $password);
    $login->loginUser();
   

    header("Location: ../adminDashboard.php");   
}
