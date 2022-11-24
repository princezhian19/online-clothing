<?php
session_start();
class addpurchaseorder extends connection{


    protected function addPurchaseOrder($code,$supplier_id,$supplier_product_id,$unit,$cost,$discount,$tax)
    {
        $stmt = $this->connect()->prepare('INSERT INTO supplier_products (code,supplier_id,supplier_product_id,unit,cost,discount,tax) VALUES (?,?,?,?,?,?,?);');
        if (!$stmt->execute(array($name,$supplier_id,$supplier_product_id,$unit,$cost,$discount,$tax))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        $_SESSION['message']= "Purchase Order Item Added Successfully"; 
        $result = "";
        if ($stmt->rowCount() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}