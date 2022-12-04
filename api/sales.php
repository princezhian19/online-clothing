<?php 

include "../classes/connectiondb.php";
include '../classes/model.php';


$model = new Model();

$sql = "select year(created_at) as year,month(created_at) as month,count(id) as total_transaction, sum(total_price) as total_price
        from orders
        group by year(created_at),month(created_at)
        order by year(created_at),month(created_at);";

$data = $model->fetchAll($sql);
echo json_encode($data);

?>