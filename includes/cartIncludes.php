<?php
session_start();
if (isset($_SESSION['userid'])) {
    if (isset($_POST['scope'])) {
        $scope = $_POST['scope'];
        switch ($scope) {
            case "add":
                $prod_size = $_POST['sizes'];
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];
                $code = $_POST['code'];
                $color = $_POST['color'];
                $user_id = $_SESSION['userid'];
              
                


                include "../classes/connectiondb.php";
                include "../classes/viewproductModel.php";
                include "../classes/model.php";

                $addtocart = new viewproducts();

                $checkCart = $addtocart->existingCart($user_id, $prod_id);


                if ($checkCart->rowCount() > 0) {

                    echo "existing";
                } else {
                    
                    $ViewProducts = new viewproducts();
                    $viewProductResult = $ViewProducts->getbyId('products', $prod_id);
                    $product = $viewProductResult->fetch(PDO::FETCH_ASSOC);
                    // echo json_encode($product);


                    $model = new Model();
                    $res = $model->fetch("SELECT * from products where code = '".$code."' and size='".$prod_size."' and color='".$color."';");
                    // echo json_encode($res);
                    // return;
                    if( $prod_qty > $product['quantity'] && $product['color'] != $color) {
                        echo 'Wrong color selected';
                    }else if( $prod_qty > $product['quantity'] && $product['size'] == $prod_size) {
                        echo 'Available stocks is only '.$product['quantity'];
                    }else {
                        $addcart = $addtocart->addtoCart($user_id, $prod_id, $prod_qty,$prod_size);
                        if ($addcart) {
                            echo 201;
                        } else {
                            echo 500;
                        }
                    }
                    
                }


                break;
            case "update":
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];
                $user_id = $_SESSION['userid'];

                include "../classes/connectiondb.php";
                include "../classes/viewproductModel.php";

                $addtocart = new viewproducts();

                $checkCart = $addtocart->existingCart($user_id, $prod_id);

                if ($checkCart->rowCount() > 0) {

                    $updateCart = $addtocart->updateCart($prod_qty, $prod_id, $user_id);
                    if ($updateCart) {
                        echo 200;
                    } else {
                        echo 500;
                    }
                } else {
                    echo "Something went Wrong";
                }


                break;

            case "delete":
                $cart_id = $_POST['cart_id'];
                $user_id = $_SESSION['userid'];

                include "../classes/connectiondb.php";
                include "../classes/viewproductModel.php";

                $addtocart = new viewproducts();

                $checkCart = $addtocart->existingCartId($user_id, $cart_id);
                if ($checkCart->rowCount() > 0) {

                    $deleteCart = $addtocart->deleteCart($cart_id);
                    if ($deleteCart) {
                        echo 200;
                    } else {
                        echo "Something went Wrong";
                    }
                } else {
                    echo "Something went Wrong";
                }
                break;


            default:
                echo 500;
        }
    }
} else {
    echo 401;
}
