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



    // $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    // $filename = time().'.'.$image_ext;

    // include "../classes/connectiondb.php";
    // include "../classes/editProductmodel.php";
    // $addprod = new editproducts(); 


    // "UPDATE orders SET proof_of_payment='" . $image . "' WHERE id=?;"




    // $addprod->uploadProofOfPayment($order_id, $filename, $address);

    // move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);   

    // header("Location: ../view-order.php?t=".$_POST['t']."&status=proof of payment submitted");  
}