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
                $user_id = $_SESSION['userid'];
              

                include "../classes/connectiondb.php";
                include "../classes/viewproductModel.php";

                $addtocart = new viewproducts();

                $checkCart = $addtocart->existingCart($user_id, $prod_id);

                if ($checkCart->rowCount() > 0) {

                    echo "existing";
                } else {

                    $addcart = $addtocart->addtoCart($user_id, $prod_id, $prod_qty,$prod_size);
                    if ($addcart) {
                        echo 201;
                    } else {
                        echo 500;
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
