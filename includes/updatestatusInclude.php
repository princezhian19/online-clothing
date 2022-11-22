<?php
if (isset($_POST['updateStatus'])) {

    $tackingNo = $_POST['tracking_no'];
    $orderStatus = $_POST['order_status'];


    include "../classes/connectiondb.php";
    include "../classes/viewproductModel.php";

    $updateStatus= new viewproducts();
    $checkCart = $updateStatus->updateStatus($orderStatus, $tackingNo);

    header("Location: ../view-orderAdmin.php?t=$tackingNo","Order status updated successfully");
    
}
