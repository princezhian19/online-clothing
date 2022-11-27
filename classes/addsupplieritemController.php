<?php

class addsupplieritemController extends addsupplieritem{

    public function __construct($name, $slug, $description, $cost, $status, $supplier_id, $size, $color, $image)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->cost = $cost;
        $this->status = $status;
        $this->supplier_id = $supplier_id;
        $this->size = $size;
        $this->color = $color;
        $this->image = $image;
    }
    public function addSupplierItem(){

        if($this->isEmpty() == false){
            header("Location: ../add-supplier-item.php?error=addsupplieritemEmpty");     
            exit();
        }

        $this->addSupItem($this->name, $this->slug, $this->description, $this->cost, $this->status, $this->supplier_id, $this->size, $this->color, $this->image);
       

    }

    private function isEmpty()
    {

        $result = "";
        if (empty($this->name) && empty($this->slug) && empty($this->description) && empty($this->cost) && empty($this->supplier_id) && empty($this->size) && empty($this->color) && empty($this->image)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}
