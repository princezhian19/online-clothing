<?php

class addpurchaseorderController extends addpurchaseorder{

    public function __construct($code,$supplier_id,$supplier_product_id,$unit,$cost,$discount,$tax)
    {
        $this->code = $code;
        $this->supplier_id = $supplier_id;
        $this->supplier_product_id = $supplier_product_id;
        $this->unit = $unit;
        $this->discount = $discount;
        $this->tax = $tax;
    }
    public function addSupplierItem(){

        if($this->isEmpty() == false){
            header("Location: ../add-purchase-order.php?error=addpurchaseorderEmpty");     
            exit();
        }
        $this->addPO($this->code,$this->supplier_id,$this->supplier_product_id,$this->unit,$this->cost,$this->discount,$this->tax);
    }

    private function isEmpty()
    {

        $result = "";
        if (empty($this->code) && empty($this->supplier_id) && empty($this->supplier_product_id) && empty($this->unit) && empty($this->cost) && empty($this->discount) && empty($this->tax) && empty($this->po_id)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}
