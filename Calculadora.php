<?php

$v1 = $_GET["a"];
$v2 = $_GET["b"];
$op = $_GET["op"];
$result = 0;

if($op == "+"){
        $result = $v1+$v2;       
}else if($op == "-"){
        $result = $v1-$v2;       
}else if($op == "/"){
        $result = $v1/$v2;      
}else if($op == "x"){
        $result = $v1*$v2;       
}
?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<tittle>Calculadora</tittle>
</head>
<body>

<?php echo "<h1>resultado: $result </h1>"?>

</body>
</html>
