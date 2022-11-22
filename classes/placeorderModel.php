<?php
session_start();
require "viewproductModel.php";

class placeOrder extends connection
{
    protected function PlaceOrd($name, $email, $phone, $address, $pincode, $payment_mode)
    {
        $conn = $this->connect();
        $viewCart = new viewproducts();
        $cart = $viewCart->getcartItems();
        $totalprice = 0;
        foreach ($cart as $items) {
            $totalprice += $items['price'] * $items['prod_qty'];
        }

            $user_id = $_SESSION['userid'];
            $tracking_no = "GraphShirt" . rand(111, 999) . substr($phone, 2);
            $stmt = $conn->prepare('INSERT INTO orders (tracking_id,user_id,name,email,phone,address,pincode,total_price,payment_mode) VALUES (?,?,?,?,?,?,?,?,?);');

            if (!$stmt->execute(array($tracking_no, $user_id, $name, $email, $phone, $pincode, $address, $totalprice, $payment_mode))) {
                $stmt = null;
                header("Location: ../checkout.php?error=stmtfailed");
                exit();
            }
            $order_id = $conn->lastInsertId();
        $this->OrderItems($order_id);
        $this->UpdateQuantity();
        $this->deleteCart($user_id);


        $_SESSION['message'] = "Order Placed Successfully";

        $result = "";
        if ($stmt->rowCount() > 0) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    protected function OrderItems($order_id)
    {
        $viewCart = new viewproducts();
        $cart = $viewCart->getcartItems();


        foreach ($cart as $items) {
            $prod_id = $items['prod_id'];
            $prod_qty = $items['prod_qty'];
            $size = $items['size'];
            $prod_price = $items['price'];
            $stmt = $this->connect()->prepare("INSERT INTO order_items (order_id,prod_id,qty,price,size) VALUES (?,?,?,?,?);");
            if (!$stmt->execute(array($order_id, $prod_id, $prod_qty, $prod_price,$size))) {
                $stmt = null;
                header("Location: ../checkout.php?error=stmtfailed");
                exit();
            }
        }
        $result = "";
        if ($stmt->rowCount() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    protected function deleteCart($user_id)
    {
        $stmt = $this->connect()->prepare("DELETE FROM carts WHERE user_id='$user_id'");
        $stmt->execute();
        $result = "";
        if ($stmt->rowCount() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    protected function UpdateQuantity()
    {
   

        $viewCart = new viewproducts();
        $cart = $viewCart->getcartItems();


        foreach ($cart as $items) {
            $prod_id = $items['prod_id'];
            $prod_qty = $items['prod_qty'];
 
            $connSelect = $this->connect();
            $connUpdate = $this->connect();
    
            $stmt = $connSelect->prepare("SELECT * FROM products WHERE id='$prod_id' LIMIT 1");
            $stmt->execute();
    
            $data_product = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $current_quantity = $data_product[0]["quantity"];
    
            $new_quantity = $current_quantity - $prod_qty;
    
            $updatestmt = $connUpdate->prepare("UPDATE products SET quantity='$new_quantity' WHERE id ='$prod_id'");
            $updatestmt->execute();
        }

        $result = "";
        if ($updatestmt->rowCount() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
