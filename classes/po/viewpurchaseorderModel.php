<?php


class viewpurchaseorder extends connection
{
    function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $result = date("Y-m-d");
        $randomString = 'PO-'.$result.'-';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    function savePo($code,$supplier_id,$supplier_product_id,$unit,$cost,$discount,$tax,$quantity) {
        $stmt = $this->connect()->prepare('INSERT INTO purchase_orders (code,supplier_id,supplier_product_id,unit,cost,discount,tax,quantity) VALUES (?,?,?,?,?,?,?,?);');
        if (!$stmt->execute(array($code,$supplier_id,$supplier_product_id,$unit,$cost,$discount,$tax,$quantity))) {
            return $stmt;
        }
        return 'success';
    }
    function getAll($table)
    {
        $sql = "SELECT * FROM $table";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function getAllQuantity($table)
    {
        $sql = "SELECT * FROM $table";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function getTableUsers()
    {
        $sql = "SELECT * FROM users WHERE role = 0";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function getbyId($table, $id)
    {
        $sql = "SELECT * FROM $table WHERE id = $id ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function getItems($table, $ref, $id)
    {
        $sql = "SELECT * FROM $table WHERE $ref = $id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        return $stmt;
    }
    function getItemsByCol($table, $ref, $id)
    {
        $sql = "SELECT * FROM $table WHERE $ref = '$id'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        return $stmt;
    }
    function getItemsByIdSizeColor($table, $id, $size, $color)
    {
        $sql = "SELECT * FROM $table WHERE code = '$id' and size = '$size' and color = '$color'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        return $stmt;
    }
    function getItemsByIdSizeColorV2($table, $id, $size, $color)
    {
        $sql = "SELECT * FROM $table WHERE name = '$id' and size = '$size' and color = '$color'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();

        return $stmt;
    }
    function getSlug($table, $slug)
    {
        $sql = "SELECT * FROM $table WHERE slug = '$slug'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function addtoCart($user_id, $prod_id, $prod_qty,$size)
    {
        $query = "INSERT INTO carts (user_id,prod_id,prod_qty,size) VALUES ('$user_id','$prod_id','$prod_qty','$size')";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    function existingCart($user_id, $prod_id)
    {
        $query = "SELECT * FROM carts WHERE prod_id='$prod_id' AND user_id ='$user_id' ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    function existingCartId($user_id, $cart_id)
    {
        $query = "SELECT * FROM carts WHERE id='$cart_id' AND user_id ='$user_id' ";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    function getcartItems()
    {
        $userId = $_SESSION['userid'];
        $sql = "SELECT c.id as cid, c.prod_id, c.prod_qty, c.size, p.id as pid, p.name, p.image, p.price FROM carts c, products p
        WHERE c.prod_id=p.id AND c.user_id='$userId' ORDER BY c.id DESC ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function updateCart($prod_qty, $prod_id, $user_id)
    {

        $sql = "UPDATE carts set prod_qty='$prod_qty' WHERE prod_id='$prod_id' AND user_id='$user_id'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function cartCount($user_id)
    {

        $sql = "SELECT * FROM carts WHERE user_id=$user_id";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();

        return $count;
    }
    function deleteCart($cart_id)
    {

        $sql = "DELETE FROM carts WHERE id='$cart_id'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function insertOrdItems($order_id, $prod_id, $qty, $price,$size)
    {

        $sql = "DELETE FROM order_items (order_id,prod_id,qty,price,size) VALUES 
        ('$order_id','$prod_id','$qty','$price',$size)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function getOrders($user_id)
    {

        $sql = "SELECT * FROM orders WHERE user_id ='$user_id' ORDER BY id DESC";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function checkTracking($tracking_no)
    {
        $userId = $_SESSION['userid'];
        $sql = "SELECT * FROM orders WHERE tracking_id ='$tracking_no' AND user_id = '$userId'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function displayOrder($tracking_no)
    {
        $userId = $_SESSION['userid'];
        $sql = "SELECT o.id AS oid, o.tracking_id,o.user_id, oi.*,p.* FROM orders o, order_items oi, products p WHERE o.user_id = '$userId' AND
        oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_id='$tracking_no'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function getAllOrders()
    {
        
        $sql = "SELECT * FROM orders WHERE status='0'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function checkTrackingA($tracking_no)
    {
       
        $sql = "SELECT * FROM orders WHERE tracking_id ='$tracking_no'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function displayOrderA($tracking_no,$userId)
    {
        
        $sql = "SELECT o.id AS oid, o.tracking_id,o.user_id, oi.*,p.* FROM orders o, order_items oi, products p WHERE o.user_id = '$userId' AND
        oi.order_id=o.id AND p.id=oi.prod_id AND o.tracking_id='$tracking_no'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function updateStatus($orderStatus,$trackingNo)
    {

        $sql = "UPDATE orders set status='$orderStatus' WHERE tracking_id='$trackingNo'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function getAllOrderHistory()
    {

        $sql = "SELECT * FROM orders WHERE status !='0'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
   
    function updateProduct($prod_qty, $code)
    {

        $sql = "UPDATE products set quantity=$prod_qty WHERE code='$code'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function updateProductV2($prod_qty, $name, $size, $color)
    {

        $sql = "UPDATE products set quantity=$prod_qty WHERE name='$name' and size ='$size' and color='$color'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    function saveNewProduct($code,$name,$slug,$image,$description,$price,$quantity, $size, $color) {
        $stmt = $this->connect()->prepare('INSERT INTO products (code,name,slug,image,description,price,quantity, size, color) VALUES (?,?,?,?,?,?,?,?,?);');
        if (!$stmt->execute(array($code,$name,$slug,$image,$description,$price,$quantity, $size, $color))) {
            return $stmt;
        }
        return 'success';
    }
    function deletePO($code)
    {
        $sql = "DELETE FROM purchase_orders WHERE code='$code'";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
