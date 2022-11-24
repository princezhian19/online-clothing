<?php

class updatepurchaseorderController extends editpurchaseorder{

    public function __construct($code,$supplier_id,$supplier_product_id,$unit,$cost,$discount,$tax,$po_id)
    {
        $this->code = $code;
        $this->supplier_id = $supplier_id;
        $this->supplier_product_id = $supplier_product_id;
        $this->unit = $unit;
        $this->cost = $cost;
        $this->discount = $discount;
        $this->tax = $tax;
        $this->po_id = $po_id;
       
    }
    public function updatePurchaseOrder(){

        if($this->isEmpty() == false){
            header("Location: ../editPurchaseOrder.php?error=editpurchaseorderEmpty");     
            exit();
        }

        $this->updateTable($this->name,$this->supplier_id,$this->supplier_product_id,$this->unit,$cost,$this->discount,$this->tax,$this->po_id);

    }

    private function isEmpty()
    {

        $result = "";
        if (empty($this->name) && empty($this->supplier_id) && empty($this->supplier_product_id) && empty($this->unit) && empty($this->cost)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
  

}
