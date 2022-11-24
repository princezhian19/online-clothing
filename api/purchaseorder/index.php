<?php 
    if (isset($_GET["get_supplier_by_id"])) {

        $supplier_id = $_GET["supplier_id"];
    
        include "../../classes/connectiondb.php";
        include "../../classes/po/viewpurchaseorderModel.php";
    
        $po = new viewpurchaseorder();
        $result = $po->getItems("supplier_products","supplier_id", $supplier_id); 
        // $supplier_products = [];
        // if( $result->rowCount() > 0) {
        //     foreach($result as $item) {
        //         $supplier_products[] = $item;
        //     }
        // }
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($data);
        // echo json_encode($supplier_products->fetchAll(PDO::FETCH_ASSOC));
    }
    
?>