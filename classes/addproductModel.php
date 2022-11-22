<?php
session_start();
class addproduct extends connection{


    protected function addProd($name,$slug,$description,$price,$quantity,$filename)
    {
        $stmt = $this->connect()->prepare('INSERT INTO products (name,slug,image,description,price,quantity) VALUES (?,?,?,?,?,?);');
        if (!$stmt->execute(array($name,$slug,$filename,$description,$price,$quantity))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        $_SESSION['message']= "Product Added Successfully"; 
        $result = "";
        if ($stmt->rowCount() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}