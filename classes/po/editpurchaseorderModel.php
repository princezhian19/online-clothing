<?php
session_start();

    class editpurchaseorder extends connection{

      
        protected function updateTable($code,$supplier_id,$supplier_product_id,$unit,$cost,$discount,$tax,$po_id)
        {
            $stmt = $this->connect()->prepare('UPDATE purchase_orders SET code=?,supplier_id=?,supplier_product_id=?,unit=?,cost=?,discount=?,tax=? WHERE id=?;');

            if (!$stmt->execute(array($code,$supplier_id,$supplier_product_id,$unit,$cost,$discount,$tax,$po_id))) {
                $stmt = null;
                header("Location: ../index.php?error=stmtfailed");
                exit();
            }
            $_SESSION['message']= "Purchase Order Item Updated Successfully"; 
            
            $result = "";
            
            if ($stmt->rowCount() > 0) {
                $result = false;
            } else {
                $result = true;
                
            }
            
            return $result;
            
        }
        
       
    }