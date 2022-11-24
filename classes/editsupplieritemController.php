<?php

class updatesupplieritemController extends editsuppliersitem{

    public function __construct($name,$supplier_id,$slug,$description,$cost,$status,$supitemid)
    {
        $this->supitemid = $supitemid;
        $this->name = $name;
        $this->supplier_id = $supplier_id;
        $this->slug = $slug;
        $this->description = $description;
        $this->cost = $cost;
        $this->status = $status;
       
    }
    public function updateSupplierItem(){

        if($this->isEmpty() == false){
            header("Location: ../editSupplierItem.php?error=editsupplieritemEmpty");     
            exit();
        }

        $this->updateTable($this->name,$this->supplier_id,$this->slug,$this->description,$this->cost,$this->status,$this->supitemid);

    }

    private function isEmpty()
    {

        $result = "";
        if (empty($this->name) && empty($this->supplier_id) && empty($this->slug) && empty($this->description) && empty($this->cost) && empty($this->status)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
  

}
