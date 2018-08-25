<?php 
    if(isset($_SESSION["customer_name"])){
        echo $_SESSION["customer_name"] . "<br/>";
    }

?>
 <title>skill</title>
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

label{
   text-decoration: none !important;
   color:red;
}

input{

}
</style>


<!DOCTYPE html>
 <!-- in this version the user clicks based on the commentary -->
<html>
   


    <meta charset="UTF-8"> 
   
    </style>






<body >
<!-- attributes have to be defined here to prevent a COORDINATE bug and visible bluriness of the shapes-->
<canvas id="canvas"></canvas>
<p id='timer'>0</p>

</body>
<script src="skill.js"></script>
 <div>
    <input type="radio" id='defaultPattern' onclick="handleClick(this);"
     name="pattern" value="h" checked="checked">
    <label for="patternChoice1">horizontal</label>

    <input type="radio" onclick="handleClick(this);"
     name="pattern" value="v">
    <label for="patternChoice2">vertial</label>

    <input type="radio"  onclick="handleClick(this);"
     name="pattern" value="all">
    <label for="patternChoice3">all</label>
  </div>

   <div>
    <input type="radio" id='defaultSize' onclick="handleClickSize(this);"
     name="size" value="small" checked="checked">
    <label for="">small </label>

    <input type="radio"  onclick="handleClickSize(this);"
     name="size" value="medium">
    <label for="">medium</label>

    <input type="radio"  onclick="handleClickSize(this);"
     name="size" value="large">
    <label for="">large</label>

    <input type="radio"  onclick="handleClickSize(this);"
     name="size" value="giant">
    <label for="">giant</label>
  </div>

</html> 