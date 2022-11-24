<?php 
        include "../classes/connectiondb.php";
        include "../classes/po/viewpurchaseorderModel.php";
    
        $po = new viewpurchaseorder();
        $result = $po->getAll("supplier_products"); 
        $data = $result->fetchAll(PDO::FETCH_ASSOC);

        $suppliersRes = $po->getAll("suppliers"); 
        $suppliers = $suppliersRes->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'supplier_products' => $data,
            'suppliers' => $suppliers
        ]);
?>