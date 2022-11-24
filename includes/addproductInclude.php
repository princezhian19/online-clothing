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

function generateRandomString($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $result = date("custom-".time());
    return $result;
}


if (isset($_POST["add_custom_product_btn"])) {
    
    
    $generatedName = generateRandomString();
    $name = $generatedName;
    $slug = $generatedName;
    $description = $generatedName;
    $price = 300;
    $quantity = 1;
    $img = $_POST["base64"];
    $img = str_replace('data:image/jpeg;base64,', '', $img);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
    // $image = $_FILES['image']['name'];
    
    $path = "../uploads";

    // $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = 'custom-'.time().'.jpg';

    include "../classes/connectiondb.php";
    include "../classes/addproductModel.php";
    include "../classes/viewproductModel.php";
    include "../classes/addproductController.php";

    $addprod = new addproductController(str_replace('.jpg', '',$filename),str_replace('.jpg', '',$filename),str_replace('.jpg', '',$filename), $price, $quantity,$filename,$path); 
    $addprod->addProduct();

    $productsModel = new viewproducts();
    $products = $productsModel->getbyName('products',str_replace('.jpg', '',$filename));
    $product = $products->fetchAll(PDO::FETCH_ASSOC);

    $prod_size = $_POST['sizes'];
    $_POST['prod_id'] = $product[0]['id'];
    $prod_qty = $_POST['prod_qty'];

    $success = file_put_contents($path.'/'.$filename, $data);  
    
    include "./cartIncludes2.php";

    echo json_encode(['result' => $success ? $filename : 'Unable to save the file.']);

}