<?php

class log extends connection
{

    protected function getUser($username, $password)
    {
        $stmt = $this->connect()->prepare('SELECT password FROM users WHERE username = ? OR email = ?;');
        if (!$stmt->execute(array($username, $username))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../index.php?error=NoUserFound");
            exit();
        }

        $data_password = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
       // $password !== $data_password[0]["password"]


        if ($password !== $data_password[0]["password"]) {
            $stmt = null;
            header("Location: ../index.php?error=WrongPassword");
            exit();

        } elseif ($password == $data_password[0]["password"]) {
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE username = ? or email = ? and password = ?;');

            if (!$stmt->execute(array($username, $username, $data_password[0]["password"]))) {
                $stmt = null;
                header("Location: ../index.php?error=stmtfailed");
                exit();
            }
           
            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("Location: ../index.php?error=NoUserFound");
                exit();
            }
            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
           

            session_start();
            $_SESSION["auth"] = true;

            $_SESSION["userid"] = $user[0]["id"];
            $_SESSION["usernameid"] = $user[0]["username"];
            $_SESSION["usermail"] = $user[0]["email"];
            $_SESSION["verifiedAt"] = $user[0]["verified_at"];
            $_SESSION["verifiedC"] = $user[0]["verification_code"];
            $_SESSION["userrole"] = $user[0]["role"];
            $_SESSION["fname"] = $user[0]["firstname"];
            $_SESSION["lname"] = $user[0]["lastname"];

           

            if($user[0]["verified_at"] == null)
            {
                header("Location: ../verification.php");
                exit();
            }

            if($user[0]["role"] == 1)
            {
                header("Location: ../adminDashboard.php");
                exit();
            }
           
            if($user[0]["role"] == 0)
            {
                header("Location: ../customerPage.php");
                exit();
            }
           





            $stmt = null;
        }
        $stmt = null;
    }
}
