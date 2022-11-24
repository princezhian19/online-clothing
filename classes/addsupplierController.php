<?php

class addsupplierController extends addsupplier{

    public function __construct($name,$address,$contact_person,$contact_number,$status)
    {
        $this->name = $name;
        $this->address = $address;
        $this->contact_person = $contact_person;
        $this->contact_number = $contact_number;
        $this->status = $status;
    }
    public function addSupplier(){

        if($this->isEmpty() == false){
            header("Location: ../add-supplier.php?error=addsupplierEmpty");     
            exit();
        }

        $this->addSup($this->name,$this->address,$this->contact_person,$this->contact_number,$this->status);
       

    }

    private function isEmpty()
    {

        $result = "";
        if (empty($this->name) && empty($this->address) && empty($this->contact_person) && empty($this->contact_number) && empty($this->status)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}
