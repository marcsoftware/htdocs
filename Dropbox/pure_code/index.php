<meta charset="UTF-8">
<title>monolith</title>
<?php include '../header.php';?>
<style>
input{
 margin-bottom: 0px;
 padding: 0px;
}

#filepath {
    font-size: 8px;
}

label{
    font-size: 8px;
    margin-bottom:0px;
    background-color: lightBlue;
}

#modesMenu{
 margin: 0px;
 float:left;

}

#menu{
    float:left;
}

#rightTable{
    width:25%;
     vertical-align: text-top;
     text-align: left;
}

.hyperlink{
    text-decoration: underline;
    cursor: pointer;
    color:blue;

}

body{


}

input {
 margin-bottom: 5px;
}
input[type="radio"] {
    font-size: 1px;
    color: red;


}
</style>

<script src="index.js"></script>

<body onload='main()'>
<input type='button' value='⌂' onclick='goHomePage()'></input>
<input type='button' value='⊲' onclick='moveLeft()'></input>
<input type='button' value='⊳' onclick='moveRight()'></input>

<!--
<input type = "radio" id = "type.php" name = "mode" value = "type.php" checked="checked" onclick="refreshMenu()">type.php
<input type = "radio" id = "easyType.php" name = "mode" value = "easyType.php" onclick="refreshMenu()">easyType.php
<input type = "radio" id = "typeWords.php" name = "mode" value = "typeWords.php" onclick="refreshMenu()">typeWords.php
<input type = "radio" id = "codeWithButtons.php" name = "mode" value = "codeWithButtons.php" onclick="refreshMenu()">codeWithButtons.php
-->

<hr/>
<p id='filepath'></p>




<table style="width:100%">
  <tr>
    <th>files</th>
    <th>modes</th> 

  </tr>
  <tr>
    <td ><p id="menu"></p></td>
    <td id='rightTable'><p id='modesMenu'></p></td>
  
  </tr>


</table>


</body>
