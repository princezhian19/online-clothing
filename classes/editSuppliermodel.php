<?php
session_start();

    class editsuppliers extends connection{

      
        protected function updateDB($name,$address,$contact_person,$contact_number,$status,$supplier_id)
        {
            $stmt = $this->connect()->prepare('UPDATE suppliers SET name=?,address=?,contact_person=?,contact_number=?,status=? WHERE id=?;');

            if (!$stmt->execute(array($name,$address,$contact_person,$contact_number,$status,$supplier_id))) {
                $stmt = null;
                header("Location: ../index.php?error=stmtfailed");
                exit();
            }
            $_SESSION['message']= "Supplier Updated Successfully"; 
            
            $result = "";
            
            if ($stmt->rowCount() > 0) {
                $result = false;
            } else {
                $result = true;
                
            }
            
            return $result;
            
        }
        
       
    }