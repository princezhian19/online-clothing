<?php

if (isset($_POST["deleteSupplier"])) {



    include "../classes/connectiondb.php";
    include "../classes/deletesupplierModel.php";


    $supplier_id = $_POST["supplierId"];
    $deleteSup = new deletSupplier();
    

    $suppliers = new deleteSupplier();
    $items = $suppliers->getSuppliers($supplier_id);

    if($deletSup->deleteSupplier($supplier_id))
    {

        echo 200;
    }else
    {
        echo 500;
    }
    
   



   
}
