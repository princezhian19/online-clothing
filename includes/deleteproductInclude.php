<?php

if (isset($_POST["deleteProduct"])) {



    include "../classes/connectiondb.php";
    include "../classes/deleteproductModel.php";


    $product_id = $_POST["prodid"];
    $deleteProd = new deleteProduct();
    

    $products = new deleteProduct();
    $items = $products->getProducts($product_id);

    $image = $items[0]['image'];


    if($deleteProd->deleteProduct($product_id))
    {
        if(file_exists("../uploads/".$image)){
            unlink("../uploads/".$image);
    
        }
        echo 200;
    }else
    {
        echo 500;
    }
}
if (isset($_POST["deleteSupplierProduct"])) {



    include "../classes/connectiondb.php";
    include "../classes/deleteproductModel.php";


    $product_id = $_POST["prodid"];
    $deleteProd = new deleteProduct();
    

    $products = new deleteProduct();
    $items = $products->getSupplierProducts($product_id);

    if($deleteProd->deleteSupplierProduct($product_id))
    {
        echo 200;
    }else
    {
        echo 500;
    }
}