<?php


class signupController extends signup
{
    private $username;
    private $email;
    private $firstname;
    private $lastname;
    private $password;
    private $cpassword;


    public function __construct($username, $email, $password, $cpassword,$firstname,$lastname)
    {

        $this->username  = $username;
        $this->email     = $email;
        $this->firstname  = $firstname;
        $this->lastname     = $lastname;
        $this->password  = $password;
        $this->cpassword = $cpassword;
    }
    //------------------------------------
    public function signupUser()
    {

        if ($this->isEmpty() == false) {

            header("Location: ../index.php?error=regEmpty");
            exit();
        }
        if ($this->isValidUsername() == false) {
            header("Location: ../index.php?error=regInvalidUsername");
            exit();
        }
        if ($this->isValidEmail() == false) {
            header("Location: ../index.php?error=regInvalidEmail");
            exit();
        }
        if ($this->matchPassword() == false) {
            header("Location: ../index.php?error=regUnmatchedPassword");
            exit();
        }

        if ($this->UserEmailTaken() == false) {
            header("Location: ../index.php?error=regUsernameEmailTaken");
            exit();
        }
        if ($this->EmailTaken() == false) {
            header("Location: ../index.php?error=regEmailTaken");
            exit();
        }
        if ($this->validatePasswordstr() == false) {
            header("Location: ../index.php?error=passwordStrengthValidation");
            exit();
        }

        $this->signUp($this->username, $this->email, $this->password,$this->firstname,$this->lastname);
    }




    //-------------------------------------------------Handlers------------------------------------------------------------
    private function isEmpty()
    {

        $result = "";
        if (empty($this->username) && empty($this->email) && empty($this->password) && empty($this->cpassword)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function isValidUsername()
    {
        $result = "";
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function isValidEmail()
    {
        $result = "";
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function matchPassword()
    {
        $result = "";
        if ($this->password !== $this->cpassword) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function UserEmailTaken()
    {
        $result = "";
        if (!$this->checkUser($this->username)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function EmailTaken()
    {
        $result = "";
        if (!$this->checkEmail($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    private function validatePasswordstr()
    {
        $result = "";
        $uppercase = preg_match('@[A-Z]@', $this->password);
        $lowercase = preg_match('@[a-z]@', $this->password);
        $number    = preg_match('@[0-9]@', $this->password);
        $specialChars = preg_match('@[^\w]@', $this->password);



        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($this->password) < 8) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
