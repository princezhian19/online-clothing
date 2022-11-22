<?php

if (isset($_POST["add_product_btn"])) {

    $name = $_POST["name"];
    $slug = $_POST["slug"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $image = $_FILES['image']['name'];
    
    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    include "../classes/connectiondb.php";
    include "../classes/addproductModel.php";
    include "../classes/addproductController.php";

    $addprod = new addproductController($name,$slug,$description, $price, $quantity,$filename,$path); 
    $addprod->addProduct();
    
    move_uploaded_file($_FILES['image']['tmp_name'],$path.'/'.$filename);   

    header("Location: ../add-product.php?message=ProductAddedSuccesfully");  

}
