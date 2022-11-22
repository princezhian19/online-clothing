<?php
session_start();

    class editproducts extends connection{

      
        protected function updateDB($name,$description,$price,$quantity,$filename,$product_id)
        {
            $stmt = $this->connect()->prepare('UPDATE products SET name=?,image=?,description=?,price=?,quantity=? WHERE id=?;');

            if (!$stmt->execute(array($name,$filename,$description,$price,$quantity,$product_id))) {
                $stmt = null;
                header("Location: ../index.php?error=stmtfailed");
                exit();
            }
            $_SESSION['message']= "Product Updated Successfully"; 
            
            $result = "";
            
            if ($stmt->rowCount() > 0) {
                $result = false;
            } else {
                $result = true;
                
            }
            
            return $result;
            
        }
        
       
    }