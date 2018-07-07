<?php session_start(); 
    if(isset($_SESSION["customer_name"])){
        echo $_SESSION["customer_name"] . "<br/>";
    }

?>

<?php include '../header.php';?>

<style>
html, body {
    margin: 0;
    padding: 0;
}
            
body {
    background: #eee;
}

canvas {
    background: #fff;
    display: block;    
    margin-top:0px;
    
    margin: 0px auto;
    

}

#timer{
    text-align: center;
    margin-top: 0px;
    width:100%;
}
</style>


<!DOCTYPE html>
 <!-- in this version the user clicks based on the commentary -->
<html>
    <title>skill</title>


    <meta charset="UTF-8"> 
   
    </style>






<body >
<!-- attributes have to be defined here to prevent a COORDINATE bug and visible bluriness of the shapes-->
<canvas id="canvas"></canvas>
<p id='timer'>0</p>
<a href='graph_history.php'>progress graph</href>
</body>
<script src="skill.js"></script>
</html> 