<?php

require_once("./conection/conn.php");

//select fataha : hamishe select mikonad
$sql = "SELECT * FROM student";
$result = $conn ->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row; 

    }
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./materialize/mat1.css">

    <title>Document</title>
    <style>
        table,tr,th,td{
            border: solid;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <div class="container">

        <form id="form">
            <input type="text" id="fn"  placeholder="input your name">
            <input type="text" id="ln"  placeholder="input your lastname">
            <input type="email" id="em" n placeholder="input your email">

            <input type="submit" id="add" value="add">
        </form>
    <br>
    <div id="con"></div>
            <table id="demo">
                <tr>
                    <th>id</th>
                    <th>first name</th>
                    <th>last name</th>
                    <th>Email</th>
                </tr>

                <?php
                foreach($data as $d){
                    echo "<tr>
                            <td> {$d['id']} </td>
                            <td> {$d['firstName']} </td>
                            <td> {$d['lastName']} </td> 
                            <td> {$d['Email']} </td>        
                    </tr>";
                }
                ?>

            </table>
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        
        <script>
            $(document).ready(function (){

                $("#form").submit(function(event) {

                    event.preventDefault();
                    
                    //formData yek motoghayer az no object ast
                    var formData ={
                        fn     : "add",
                        name   : $("#fn").val(),
                        family : $("#ln").val(),
                        email  : $("#em") .val() 
                    }

                    // $( '#form' ).each(function(){
                    //     this.reset();

                    //ajax.php?name=mahshid&family=khodsini
                    var r = $.ajax({
                        type :"GET",
                        url : 'ajax.php',
                        data: formData,
                    })
                    //?ajax.ph?

                    r.done(function(result){

            
                   
                       var ans = JSON.parse(result);
                     

                        if(ans.status == true){
                            var res = "<tr>"
                                        +"<td>"+ans.idm +"</td>"
                                        +"<td>"+formData.name +"</td>"
                                        +"<td>"+formData.family +"</td>"
                                        +"<td>"+formData.email +"</td>"
                                    +"</tr>";
                                $("#demo").append(res);
                                
                            $("#con").html(ans.msg);
                        }else{
                            $("#con").html(ans.msg);  
                        }
                        
                    });

                     $("#form")[0].reset();
 
                });

            });

            



        </script>
    </div>
   <script src="./materialize/mat2.js"></script>
</body>
</html>