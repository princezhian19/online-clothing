<?php

    class Model extends connection{
        public function fetch($sql)
        {
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            return $data;
        }
        public function executeQuery($sql)
        {
            $stmt = $this->connect()->prepare($sql);
            $res = $stmt->execute();
            return;
            if (!$stmt->execute(array($id,$image))) {
                $stmt = null;
                header("Location: ../index.php?error=stmtfailed");
                exit();
            }
            $_SESSION['message']= "Proof of payment uploaded successfully"; 
            
            $result = "";
            
            if ($stmt->rowCount() > 0) {
                $result = false;
            } else {
                $result = true;
                
            }
            
            return $result;
            
        }
    }