<?php

// echo json_encode($b);


$name = $_GET['name'];
$last = $_GET['family'];


if(empty($name) || empty($last)){
    $a = array('status'=> false , "msg" => "fill completely");
    $b = json_encode($a);
    echo $b;
}else {
    $a = array('status'=> true , "msg" => "completed successfully");
    $b = json_encode($a);
    echo $b;
}


 