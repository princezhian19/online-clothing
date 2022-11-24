<?php

class updatesupplierController extends editsuppliers{

    public function __construct($name,$address,$contact_person,$contact_number,$status,$supplier_id)
    {
        $this->name = $name;
        $this->address = $address;
        $this->contact_person = $contact_person;
        $this->contact_number = $contact_number;
        $this->status = $status;
        $this->supplier_id = $supplier_id;
       
    }
    public function updateSupplier(){

        if($this->isEmpty() == false){
            header("Location: ../editSupplier.php?error=editsupplierEmpty");     
            exit();
        }

        $this->updateDB($this->name,$this->address,$this->contact_person,$this->contact_number,$this->status,$this->supplier_id);

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
