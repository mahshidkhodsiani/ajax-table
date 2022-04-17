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
                    <th>delet</th>
                    <th>edit</th>
                </tr>

                <?php
                foreach($data as $d){
                    echo "<tr id='{$d['id']}'>
                            <td> {$d['id']} </td>
                            <td> {$d['firstName']} </td>
                            <td> {$d['lastName']} </td> 
                            <td> {$d['Email']} </td> 
                            <td> <button class='delet_id' data-delid='{$d['id']}'> delete </button></td>
                            
                            <td> <button class='edit_id' data-edid='{$d['id']}'> edit </button> </td>       
                    </tr>";
                }
                ?>

            </table>
        

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        
        <script>
            $(document).ready(function (){

                $("#add").click(function(event) {

                    event.preventDefault();
                    
                    //formData yek motoghayer az no object ast
                    var formData ={
                        fn     : "add",
                        name   : $("#fn").val(),
                        family : $("#ln").val(),
                        email  : $("#em") .val() 
                    }

                    

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
                                        +"<td> <button class='delet_id' data-delid='"+ ans.idm +"'> delete </button> </td>"
                                        +"<td><button class='edit_id' data-edid='"+ ans.idm +"'> edit </button></td>"
                                    +"</tr>";
                                $("#demo").append(res);
                                
                            $("#con").html(ans.msg);
                        }else{
                            $("#con").html(ans.msg);  
                        }
                        
                    });

                     $("#form")[0].reset();
 
                });


                $("#form").submit(function(event){
                    event.preventDefault();
                });

                $(document).on("click",".delet_id",function(){

                    btn = $(this);
                    var formData ={
                        fn : "del",
                        id :  $(this).data("delid")
                    }

                    //ajax.php?fn=del&id=148
                    var r = $.ajax({
                        type :"GET",
                        url : 'ajax.php',
                        data: formData,
                        
                    });


                    r.done(function(result) {
                       
                        var ans = JSON.parse(result);


                        if(ans.status == true){
                            // console.log("hi");return;

                            btn.closest("tr").remove();
                            $("#con").html(ans.msg);
                        }
                        else{
                            $("#con").html(ans.msg);  
                        }

                    });
                   
                });

                $(document).on("click" ,".edit_id" , function(){

                    var id = $(this).data("edid");
                    var name = $(this).parents("tr").children("td:nth-child(2)").html();
                    var family = $(this).parents("tr").children("td:nth-child(3)").html();
                    var email = $(this).parents("tr").children("td:nth-child(4)").html();

                    $("#fn").val(name);
                    $("#ln").val(family);
                    $("#em").val(email);

                    $("#add").prop("disabled", true);
                    $(".delet_id").prop("disabled", true);
                    $(".edit_id").prop("disabled", true);


                    $("#form").append("<button id='above-edit' data-update='"+id+"'>update</button>");
                    $("#form").append("<button id='above-cancel'> cancel</button>");

                });

                $(document).on("click","#above-cancel" ,function(){
                    $("#form")[0].reset();
                    $("#add").prop("disabled", false);
                    $(".delet_id").prop("disabled", false);
                    $(".edit_id").prop("disabled", false);
                    $("#above-edit").remove();
                    $("#above-cancel").remove();
                });


                $(document).on("click","#above-edit" ,function(){
                   
                    var name = $("#fn").val();
                    var family = $("#ln").val();
                    var email = $("#em").val();
                   
                    var formData ={
                        id :  $(this).data("update"),
                        fn : "upd",
                        name : name,
                        family : family,
                        email : email
                    }

                    var r = $.ajax({
                        type :"GET",
                        url : 'ajax.php',
                        data: formData,
                    });


                    

                    r.done(function(result){
                        var ans = JSON.parse(result);
                        

                        if(ans.status == true){

                            $("#"+formData.id).children("td:nth-child(2)").html(formData.name);
                            $("#"+formData.id).children("td:nth-child(3)").html(formData.family);
                            $("#"+formData.id).children("td:nth-child(4)").html(formData.email);

                            $(".delet_id").prop("disabled", false);
                            $(".edit_id").prop("disabled", false);
                            $("#add").prop("disabled", false);

                            $("#above-edit").remove();
                            $("#above-cancel").remove();
                            

                            $("#con").html(ans.msg);
                        }else{
                            $("#con").html(ans.msg);
                        }

                        $("#form")[0].reset();
                    });

                    

                });




            });

            
        </script>
    </div>
   <script src="./materialize/mat2.js"></script>
</body>
</html>