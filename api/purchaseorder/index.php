<?php 

    include "../../classes/connectiondb.php";
    include "../../classes/po/viewpurchaseorderModel.php";

    function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $result = date("Y-m-d");
        $randomString = 'PO-'.$result.'-';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    if (isset($_GET["get_supplier_by_id"])) {

        $supplier_id = $_GET["supplier_id"];
        $po = new viewpurchaseorder();
        $result = $po->getItems("supplier_products","supplier_id", $supplier_id); 

        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
    }
    if (isset($_POST["save_po"])) {
        $code = generateRandomString();
        foreach (json_decode($_POST['orders']) as $key => $value) {
            $supplier_id = $value->supplier_id;
            $quantity = $value->quantity;
            $supplier_product_id = $value->supplier_product_id;
            $unit = $value->unit;
            $cost = $value->cost;
            $discount = $_POST["discount"];
            $tax = $_POST["tax"];
            $po = new viewpurchaseorder();
            $po->savePo($code,$supplier_id,$supplier_product_id,$unit,$cost,$discount,$tax,$quantity);
        }
        echo json_encode(['message' => json_decode($_POST['orders']) ]);
    }
?>