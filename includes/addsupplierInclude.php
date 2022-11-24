<?php

if (isset($_POST["add_supplier_btn"])) {

    $name = $_POST["name"];
    $address = $_POST["address"];
    $contact_person = $_POST["contact_person"];
    $contact_number = $_POST["contact_number"];
    $status = $_POST["status"];
    

    include "../classes/connectiondb.php";
    include "../classes/addsupplierModel.php";
    include "../classes/addsupplierController.php";

    $addsupplier = new addsupplierController($name,$address,$contact_person,$contact_number,$status); 
    $addsupplier->addSupplier();
    
    header("Location: ../add-supplier.php?message=SupplierAddedSuccesfully");  

}
