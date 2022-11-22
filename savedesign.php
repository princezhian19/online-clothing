<?php
$path = "customizedProducts";
$design = $_FILES['design']['name'];
$image_ext = pathinfo($design, PATHINFO_EXTENSION);
$filename = time().'.'.$image_ext;

move_uploaded_file($_FILES['design']['tmp_name'],$path.'/'.$filename);

header("Location: customizationShirt.php");

