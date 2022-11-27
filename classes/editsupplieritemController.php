<?php

class updatesupplieritemController extends editsuppliersitem{

    public function __construct($name,$supplier_id,$slug,$description,$cost,$status,$supitemid, $size, $color)
    {
        $this->supitemid = $supitemid;
        $this->name = $name;
        $this->supplier_id = $supplier_id;
        $this->slug = $slug;
        $this->description = $description;
        $this->cost = $cost;
        $this->status = $status;
        $this->size = $size;
        $this->color = $color;
       
    }
    public function updateSupplierItem(){

        if($this->isEmpty() == false){
            header("Location: ../editSupplierItem.php?error=editsupplieritemEmpty");     
            exit();
        }

       $this->updateTable($this->name,$this->supplier_id,$this->slug,$this->description,$this->cost,$this->status,$this->supitemid, $this->size, $this->color);
    }

    private function isEmpty()
    {

        $result = "";
        if (empty($this->name) && empty($this->supplier_id) && empty($this->slug) && empty($this->description) && empty($this->cost) && empty($this->status) && empty($this->size) && empty($this->color)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
  

}
