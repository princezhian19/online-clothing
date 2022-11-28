<?php
$databaseHost = 'localhost';
$databaseName = 'ooplogin';
$databaseUsername = 'root';
$databasePassword = '';
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);

if($mysqli){
//    echo 'Connected'; 
}
else{
    // echo 'Error in connection';
}
?>