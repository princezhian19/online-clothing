<?php

if (isset($_POST["add_item_btn"])) {

    $supplier_id = $_POST["supplier_id"];
    $name = $_POST["name"];
    $slug = $_POST["slug"];
    $size = $_POST["size"];
    $color = $_POST["color"];
    $description = $_POST["description"];
    $cost = $_POST["cost"];
    $status = $_POST["status"];
    

    include "../classes/connectiondb.php";
    include "../classes/addsupplieritemModel.php";
    include "../classes/addsupplieritemController.php";

    $addsupplier = new addsupplieritemController($name,$slug,$description,$cost,$status, $supplier_id, $size,$color); 
    $addsupplier->addSupplierItem();
    
    header("Location: ../add-supplier-item.php?message=SupplierItemAddedSuccesfully");  

}
