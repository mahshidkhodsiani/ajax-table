<?php
require_once("./conection/conn.php");


// echo json_encode($b);
// echo "data from ajax.php";
// echo '$_REQUEST : ';
// print_r($_REQUEST);
// die;



// if(empty($name) || empty($last)){
//     $a = array('status'=> false , "msg" => "fill completely");
//     $b = json_encode($a);
//     echo $b;
// }else {
//     $a = array('status'=> true , "msg" => "completed successfully");
//     $b = json_encode($a);
//     echo $b;
// }

// ini_set('display_errors', 1);

// if(isset($_POST['aaa']) && $_POST['aaa']== "add"){
//     $name = $_POST['name'];
//     $last = $_POST['family'];
//     $email = $_POST['email'];

//     $sql = "INSERT INTO student (firstName,lastName,Email) VALUES ($name , $last , $email)";

//     if($conn -> query($sql)){
//         $b = "<p> your data successfully added </p>";
//         $a = json_encode($b);
//         echo $a;
//     }else{
//         $b = "<p> sorry a problem happend </p>";
//         $a = json_encode($b);
//         echo $a;
//     }
// }

// echo $_REQUEST['fn'];
// die;
switch($_REQUEST['fn']){
    case "add":
        
        $name = $_REQUEST['name'];
        $last = $_REQUEST['family'];
        $email = $_REQUEST['email'];

        $sql = "INSERT INTO student (firstName,lastName,Email) VALUES ('$name' , '$last' , '$email')";
        // print_r($sql);die;
        if($conn->query($sql) == true){ 
            $last_id = $conn->insert_id;   
            $b = array ("status"=> true , "msg"=>"your data successfully added" , "idm"=>$last_id);
            $a = json_encode($b);
            echo $a;
        }else{
            $b = array ("status"=> true , "msg"=>"your data successfully added");
            $a = json_encode($b);
            echo $a;
        }
            
        
    break;
}





 