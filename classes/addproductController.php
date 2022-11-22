<?php

class addproductController extends addproduct{

    public function __construct($name,$slug,$description,$price,$quantity,$filename,$path)
    {
        $this->name = $name;
        $this->slug = $slug;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->filename = $filename;
        $this->path = $path;
       
    }
    public function addProduct(){

        if($this->isEmpty() == false){
            header("Location: ../add-product.php?error=addproductEmpty");     
            exit();
        }

        $this->addProd($this->name,$this->slug,$this->description,$this->price,$this->quantity,$this->filename);
       

    }

    private function isEmpty()
    {

        $result = "";
        if (empty($this->name) && empty($this->description) && empty($this->price) && empty($this->quantity) && empty($this->filename)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}
