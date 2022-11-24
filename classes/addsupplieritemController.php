<?php

class addsupplieritemController extends addsupplieritem{

    public function __construct($name,$slug,$description,$cost,$status, $supplier_id)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->cost = $cost;
        $this->status = $status;
        $this->supplier_id = $supplier_id;
    }
    public function addSupplierItem(){

        if($this->isEmpty() == false){
            header("Location: ../add-supplier-item.php?error=addsupplieritemEmpty");     
            exit();
        }

        $this->addSupItem($this->name,$this->slug,$this->description,$this->cost,$this->status,$this->supplier_id);
       

    }

    private function isEmpty()
    {

        $result = "";
        if (empty($this->name) && empty($this->slug) && empty($this->description) && empty($this->cost) && empty($this->status && empty($this->supplier_id))) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}
