<?php



class loginController extends log
{

    public function __construct($username, $password)
    {

        $this->username  = $username;
        $this->password  = $password;
    }
    public function loginUser()
    {
        if(strpos($this->username, "'") !== FALSE)
        {             
                header("Location: ../index.php?error=SQLinjectionattempt");
                exit();       
        }
        if ($this->isEmpty() == false) {

            header("Location: ../index.php?error=Empty");                  
            exit();
        }
        $this->getUser($this->username,$this->password);
    }
 


    private function isEmpty()
    {

        $result = "";
        if (empty($this->username) && empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
   

}
