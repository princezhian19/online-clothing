<?php



class verify extends connection
{
    public function checkVerify($verificationCode,$email)
    {
        //$stmt = $this->connect()->prepare('SELECT verification_code FROM users WHERE verification_code = ? and email = ?;');
        $stmt = $this->connect()->prepare('UPDATE users SET verified_at = NOW() WHERE verification_code = ? and email = ?;');
       

        if (!$stmt->execute(array($verificationCode,$email))) {
            $stmt = null;
            header("Location: ../index.php?error=stmtfailed");
            exit();
        }
        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("Location: ../verification.php?error=VerificationCodeNotMatch");
            exit();
        }
   
        header("location: ../customerPage.php");
        
        $stmt=null;
    }

}

