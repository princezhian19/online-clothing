<?php

if (isset($_POST["update_supplier_btn"])) {

    $name = $_POST["name"];
    $address = $_POST["address"];
    $contact_person = $_POST["contact_person"];
    $contact_number = $_POST["contact_number"];
    $status = $_POST["status"];
    $supplier_id = $_POST['supplier_id'];


    include "../classes/connectiondb.php";
    include "../classes/editsupplierModel.php";
    include "../classes/editsupplierController.php";
    
    $updateSupplier = new updatesupplierController($name,$address,$contact_person,$contact_number,$status,$supplier_id);
    $updateSupplier->updateSupplier();
   
    header("Location: ../editSupplier.php?myid=$supplier_id","SupplierUpdatedSuccessfully");
}
