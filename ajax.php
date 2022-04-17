<?php
require_once("./conection/conn.php");


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
            $b = array ("status"=> false , "msg"=>"sorry a problem");
            $a = json_encode($b);
            echo $a;
        }
         
    break;

    case "del":
        
        $sql = "DELETE FROM student WHERE id={$_REQUEST['id']}";

        if($conn->query($sql) == true){ 
            
            $b = array ("status"=> true , "msg"=>"your data successfully deleted" , "idm"=>$_REQUEST['id']);
            $a = json_encode($b);
            echo $a;
        }else{
            $b = array ("status"=> false , "msg"=>"sorry a problem " .$conn->error);
            $a = json_encode($b);
            echo $a;
        }

        break;

    case "upd":
        $name = $_REQUEST['name'];
        $last = $_REQUEST['family'];
        $email = $_REQUEST['email'];
        $sql = "UPDATE student SET firstName='$name' , lastName ='$last' , Email='$email' WHERE id={$_REQUEST['id']} ";

        if($conn->query($sql) == true){ 
            $b = array ("status"=> true , "msg"=>"your data successfully updated"  );
            $a = json_encode($b);
            echo $a;
        }else{
            $b = array ("status"=> false , "msg"=>"sorry a problem " .$conn->error);
            $a = json_encode($b);
            echo $a;
        }

        break;

}





 