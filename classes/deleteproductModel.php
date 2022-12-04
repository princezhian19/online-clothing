<?php


class deleteProduct extends connection
{


    function deleteProduct($id)
    {
       

         $sql = "DELETE FROM products WHERE id = $id;";
         $stmt = $this->connect()->prepare($sql);
         $stmt->execute();
         return $stmt;  

    }
    function getProducts($id)
    {
        $sql = "SELECT * FROM products WHERE id = $id;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
    
    function deleteSupplierProduct($id)
    {
       

         $sql = "DELETE FROM purchase_orders WHERE id = $id;";
         $stmt = $this->connect()->prepare($sql);
         $stmt->execute();
         return $stmt;  

    }
    function getSupplierProducts($id)
    {
        $sql = "SELECT * FROM purchase_orders WHERE id = $id;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
}

