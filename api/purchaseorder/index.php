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
    if(isset($_POST['receive'])) {
        $code = $_POST['code'];
        $po = new viewpurchaseorder();
        $result = $po->getItemsByCol("purchase_orders","code", $code); 
        $purchase_orders = $result->fetchAll(PDO::FETCH_ASSOC);
        
        foreach($purchase_orders as $poItem) {

            // $supplier_products = new viewpurchaseorder();
            // $supplier_product = $po->getItems("supplier_products","id",$poItem['supplier_product_id']); 

            $result = $po->getItemsByIdSizeColor("products", $poItem['supplier_product_id'], $poItem['size'], $poItem['color']); 
            $product = $result->fetch(PDO::FETCH_ASSOC);

            if($product) {
                $result = $po->updateProduct($product['quantity'] + $poItem['quantity'], $poItem['supplier_product_id']); 
            }else {
                $res = $po->getItemsByCol("supplier_products","id", $poItem['supplier_product_id']); 
                $supplierProduct = $res->fetch(PDO::FETCH_ASSOC);
                $result = $po->saveNewProduct(
                    $poItem['supplier_product_id'],
                    $supplierProduct['name'],
                    $supplierProduct['slug'],
                    'null',
                    $supplierProduct['description'],
                    $supplierProduct['cost'],
                    $poItem['quantity']);
            }
        }
        $result = $po->deletePO($code); 
        echo json_encode(['message' => 'PO received successfuly']);
    }
?>