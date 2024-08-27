<?php

$v1 = $_GET["a"];
$v2 = $_GET["b"];
$op = $_GET["op"];
$result1 = 0;
$result2 = 0;

if($op == "+"){
        $result1 = $v1+$v2;       
}else if($op == "-"){
        $result1 = $v1-$v2;       
}else if($op == "/"){
        if($v2 == 0){
        $result1 = "Erro!,Não é possivel Dividir por 0!!";
        }else{
        $result1 = $v1/$v2;
        }      
}else if($op == "x"){
        $result1 = $v1*$v2;       
}else if($op == "√"){
        if(($v1!=null) && ($v2!=null)){
        $result1 = sqrt($v1);
        $result2 = sqrt($v2);
        }
}else if($op == "Invert"){  
        if(($v1!=null) && ($v2!=null)){     
        $result1 = $v1*(-1);
        $result2 = $v2*(-1);
        }else{
        $result1 = $v1*(-1);
        }      
}else if($op == "div1"){
        if(($v1!=null) && ($v2!=null)){
        $result1 = (1/$v1);
        $result2 = (1/$v2);
        }else{
        $result1 = (1/$v1);     
        }
}else if($op=="Sen"){
        if(($v1!=null) && ($v2!=null)){
        $result1 = sin($v1);
        $result2 = sin($v2);
        }else{
        $result1 = sin($v1);    
        }
}else if($op == "Cos"){
        if(($v1!=null) && ($v2!=null)){
        $result1 = cos($v1);
        $result2 = cos($v2);
        }else{
        $result1 = cos($v1);
        }
}else if($op=="Tag"){
        if(($v1!=null) && ($v2!=null)){
        $result1 = tan($v1);
        $result2 = tan($v2);
        }else{
        $result1 = tan($v1);
        }
}
?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">

</head>
        <body>
                <div class="container">
                        <?php 
                        if(($result1!=0) && ($result2!=0)){
                        echo "<h1>resultado: $result1 </h1>";
                        echo "<h1>resultado: $result2 </h1>";
                        }elseif($result1 == 0){
                        echo "<h1>resultado: $result2 </h1>";
                        }elseif($result2==0){
                        echo "<h1>resultado: $result1 </h1>";
                        }

                        
                        ?>
                </div>
        </body>
</html>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f0f0;
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .container {
        text-align: center;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 400px;
        width: 100%;
    }
    h1 {
        font-size: 2em;
        margin: 20px 0;
        color: #007bff;
        border-bottom: 2px solid #007bff;
        padding-bottom: 10px;
        transition: color 0.3s, border-color 0.3s;
    }
    h1:hover {
        color: #0056b3;
        border-color: #0056b3;
    }
</style>
