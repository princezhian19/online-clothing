<?php

class PlaceOrderController extends PlaceOrder
{

    public function __construct($name, $email, $phone, $pincode, $address, $payment_mode)
    {
        $this->name = $name;
        $this->email = $email;
        $this->phone = $phone;
        $this->pincode = $pincode;
        $this->address = $address;
        $this->payment_mode = $payment_mode;

    }
    public function PlaceOrder()
    {

        if ($this->isEmpty() == false) {
            header("Location: ../checkout.php?error=CheckOutEmpty");
            exit();
        }
        $this->PlaceOrd($this->name,$this->email,$this->phone,$this->pincode,$this->address,$this->payment_mode);


    }
    private function isEmpty()
    {

        $result = "";
        if (empty($this->name) && empty($this->email) && empty($this->phone) && empty($this->pincode) && empty($this->address)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
