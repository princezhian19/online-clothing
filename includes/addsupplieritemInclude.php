<?php

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (isset($_POST["add_item_btn"])) {

    $supplier_id = $_POST["supplier_id"];
    $name = $_POST["name"];
    $slug = $_POST["slug"];
    $size = $_POST["size"];
    $color = $_POST["color"];
    $description = $_POST["description"];
    $cost = $_POST["cost"];
    $status = $_POST["status"];
    $image = $_FILES['image']['name'];
    $path = "../uploads";
    
    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    include "../classes/connectiondb.php";
    include "../classes/addsupplieritemModel.php";
    include "../classes/addsupplieritemController.php";
    include "../classes/model.php";

    $code = '';
    $model = new Model();
    $prodEx = $model->fetch("SELECT * FROM supplier_products where name = '".$name."'");
    if(!empty($prodEx)) {
        $code = $prodEx['code'];
    }else {
        $code = generateRandomString();
    }
    $addsupplier = new addsupplieritemController($name, $slug, $description, $cost, $status, $supplier_id, $size, $color, $filename,$code); 
    $addsupplier->addSupplierItem();
    
    move_uploaded_file($_FILES['image']['tmp_name'],$path.'/'.$filename);
    
    header("Location: ../add-supplier-item.php?message=SupplierItemAddedSuccesfully");  

}
