<?php

if (isset($_POST["update_product_btn"])) {

    $name = $_POST["name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];
    $product_id = $_POST['product_id'];

    $path = "../uploads";


    if($new_image != "" )
    {
        $update_filename = $new_image;
    }
    else
    {
        $update_filename = $old_image;
    }

    include "../classes/connectiondb.php";
    include "../classes/editproductModel.php";
    include "../classes/editproductController.php";
    
    $updateProduct = new updateproductController($name,$description,$price,$quantity,$update_filename,$path,$product_id);
    $updateProduct->updateProduct();
  
    
    
    
        if($_FILES['image']['name'] != "")
        {
            move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$new_image);
            if(file_exists("../uploads/".$old_image))
            {
                unlink("../uploads/".$old_image);
            }
        }
       

    
   
    header("Location: ../editProduct.php?myid=$product_id","ProductUpdatedSuccessfully");
    

}
