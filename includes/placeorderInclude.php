<?php


if(isset($_POST['placeorderBtn']))
{

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$pincode = $_POST['pincode'];
$address = $_POST['address'];
$payment_mode = $_POST['payment_mode'];



include "../classes/connectiondb.php";
include "../classes/placeorderModel.php";
include "../classes/placeorderController.php";

$placeorder = new PlaceOrderController($name,$email,$phone,$pincode,$address,$payment_mode);
$placeorder->PlaceOrder();


 header('Location: ../my-orders.php');
}