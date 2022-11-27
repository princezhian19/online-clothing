<?php
session_start();
class addsupplieritem extends connection{


    protected function addSupItem($name,$slug,$description,$cost,$status, $supplier_id, $size, $color)
    {
        $stmt = $this->connect()->prepare('INSERT INTO supplier_products (name,slug,description,cost,status, supplier_id, size, color) VALUES (?,?,?,?,?,?,?,?);');
        if (!$stmt->execute(array($name,$slug,$description,$cost,$status,$supplier_id, $size, $color))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        $_SESSION['message']= "Supplier Item Added Successfully"; 
        $result = "";
        if ($stmt->rowCount() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}