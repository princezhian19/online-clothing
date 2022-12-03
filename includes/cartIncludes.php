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


                $ViewProducts2 = new viewproducts();
                $checkCart2 = $ViewProducts2->getbyId('products', $prod_id);
                $product2 = $checkCart2->fetch(PDO::FETCH_ASSOC);

                $cartModel = new Model();
                $cart = $cartModel->fetch("SELECT * from carts where prod_id = '".$prod_id."';");


                    $ViewProducts = new viewproducts();
                    $viewProductResult = $ViewProducts->getbyId('products', $prod_id);
                    $product = $viewProductResult->fetch(PDO::FETCH_ASSOC);


                    $model = new Model();
                    $res = $model->fetch("SELECT * from products where code = '".$code."' and size='".$prod_size."' and color='".$color."';");
                    // echo json_encode([$res, [$prod_size,$code,$color]]);
                    // return;
                    if($res) {
                        if( $res['color'] != $color || $res['size'] != $prod_size) {
                            echo 'Color not available';
                        }else if( $prod_qty > $product['quantity'] && $product['size'] == $prod_size) {
                            echo 'Available stocks is only '.$product['quantity'];
                        }
                        else if($product2['size'] == $prod_size && $product2['code'] == $code && $color == $product2['color'] ) {
                            echo "existing";
                        }
                        else {
                            $addcart = $addtocart->addtoCart($user_id, $res['id'], $prod_qty,$res['size']);
                            if ($addcart) {
                                echo 201;
                            } else {
                                echo 500;
                            }
                        }
                    }else {
                        echo 'Color/Size not available';
                    }


                break;
            case "update":
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];
                $user_id = $_SESSION['userid'];

                include "../classes/connectiondb.php";
                include "../classes/viewproductModel.php";
                include '../classes/model.php';

                $addtocart = new viewproducts();

                $checkCart = $addtocart->existingCart($user_id, $prod_id);

                
                $model = new Model();
                $p = $model->fetch('SELECT * FROM products where id='.$prod_id);
                if($p['quantity'] < $prod_qty) {
                    echo 'Stock available is only '.$p['quantity'];
                }else{
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
