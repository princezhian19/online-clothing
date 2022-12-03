<?php
if (isset($_POST["upload_payment"])) {
    $order_id = $_POST['order_id'];
    $address = $_POST['address'];
    $image = $_FILES['image']['name'];
    $path = "../uploads";

    $sql = '';
    if(empty($image) && !empty($address)) {
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_ext;
        $sql = "UPDATE orders SET address='" . $address . "' WHERE id='".$order_id."';";
    }else {
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_ext;
        $sql = "UPDATE orders SET address='" . $address . "', proof_of_payment='". $filename . "' WHERE id=".$order_id.";";
    }

    include "../classes/connectiondb.php";
    include "../classes/editProductmodel.php";
    $addprod = new editproducts(); 

    $addprod->uploadProofOfPayment($sql);

    move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);  
   
    header("Location: ../view-order.php?t=".$_POST['t']."&status=proof of payment submitted");  
}



if (isset($_POST["save_gcash"])) {
    $account_id = $_POST['account_id'];
    $account_name = $_POST['account_name'];
    $contact_number = $_POST['contact_number'];
    $image = $_FILES['image']['name'];
    $path = "../uploads";

    $sql = '';
    if(empty($image) && !empty($account_name) && !empty($contact_number)) {
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_ext;
        $sql = "UPDATE accounts SET account_name='" . $account_name . "', contact_number='". $contact_number ."' WHERE id='".$account_id."';";
        // echo $sql;return;
    }else {
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $filename = time().'.'.$image_ext;
        $sql = "UPDATE accounts SET account_name='" . $account_name . "', contact_number='" . $contact_number ."', gcash_qr='". $filename . "' WHERE id=".$account_id.";";
        // echo $sql;return;
    }

    include "../classes/connectiondb.php";
    include "../classes/editProductmodel.php";
    $addprod = new editproducts(); 

    $addprod->uploadProofOfPayment($sql);

    move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);  
   
    header("Location: ../gcash-account.php?t=".$_POST['t']."&status=gcash account updated");  
}