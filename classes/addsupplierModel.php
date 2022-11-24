<?php
session_start();
class addsupplier extends connection{


    protected function addSup($name,$address,$contact_person,$contact_number,$status)
    {
        $stmt = $this->connect()->prepare('INSERT INTO suppliers (name,address,contact_person,contact_number,status) VALUES (?,?,?,?,?);');
        if (!$stmt->execute(array($name,$address,$contact_person,$contact_number,$status))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        $_SESSION['message']= "Supplier Added Successfully"; 
        $result = "";
        if ($stmt->rowCount() > 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}