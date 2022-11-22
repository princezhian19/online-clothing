<?php
if (isset($_POST["submit"])) {

    $verificationCode = $_POST["verificationc"];
    $email = $_POST["email"];
    include "../classes/connectiondb.php";
    include "../classes/verificationModel.php";

    $verify = new verify();
    $verify->checkVerify($verificationCode,$email);

    


}
