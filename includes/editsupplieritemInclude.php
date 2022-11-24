<?php

if (isset($_POST["update_supplieritem_btn"])) {

    $supitemid = $_POST["supitemid"];
    $name = $_POST["name"];
    $supplier_id = $_POST["supplier_id"];
    $slug = $_POST["slug"];
    $description = $_POST["description"];
    $cost = $_POST['cost'];
    $status = $_POST["status"];

    
    include "../classes/connectiondb.php";
    include "../classes/editsupplieritemModel.php";
    include "../classes/editsupplieritemController.php";
    
    $updateSupplierItem = new updatesupplieritemController($name,$supplier_id,$slug,$description,$cost,$status,$supitemid);
    $updateSupplierItem->updateSupplierItem();
   
    header("Location: ../editSupplierItem.php?myid=$supitemid","SupplierItemUpdatedSuccessfully");
    

}
