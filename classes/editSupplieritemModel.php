<?php
session_start();

    class editsuppliersitem extends connection{

      
        protected function updateTable($name,$supplier_id,$slug,$description,$cost,$status,$supitemid, $size, $color)
        {
            $stmt = $this->connect()->prepare('UPDATE supplier_products SET name=?,supplier_id=?,slug=?,description=?,cost=?,status=?, size=?, color=? WHERE id=?;');
            if (!$stmt->execute(array($name,$supplier_id,$slug,$description,$cost,$status, $size, $color, $supitemid))) {
                $stmt = null;
                header("Location: ../index.php?error=stmtfailed");
                exit();
            }
            $_SESSION['message']= "Supplier Item Updated Successfully"; 
            
            $result = "";
            
            if ($stmt->rowCount() > 0) {
                $result = false;
            } else {
                $result = true;
                
            }
            
            return $result;
            
        }
        
       
    }