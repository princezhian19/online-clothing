<?php

class updateproductController extends editproducts{

    public function __construct($name,$description,$price,$quantity,$filename,$path,$product_id)
    {
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->quantity = $quantity;
        $this->filename = $filename;
        $this->product_id = $product_id;
        $this->path = $path;
       
    }
    public function updateProduct(){

        if($this->isEmpty() == false){
            header("Location: ../editProduct.php?error=editproductEmpty");     
            exit();
        }

        $this->updateDB($this->name,$this->description,$this->price,$this->quantity,$this->filename,$this->product_id);
        
       

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
