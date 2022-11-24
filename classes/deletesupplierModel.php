<?php


class deleteSupplier extends connection
{


    function deleteSupplier($id)
    {
       

         $sql = "DELETE FROM suppliers WHERE id = $id;";
         $stmt = $this->connect()->prepare($sql);
         $stmt->execute();
         return $stmt;  

    }
    function getSuppliers($id)
    {
        $sql = "SELECT * FROM suppliers WHERE id = $id;";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }
    

}

