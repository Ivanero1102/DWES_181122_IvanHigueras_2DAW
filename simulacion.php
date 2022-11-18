<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(isset($_POST['tiradas'])){
        if($_POST['tiradas']==null){
            header("Location: tiradas.php");
        }
        $array = array();
        $min = 1;
        $max = 6;
        $uno = 0;
        $dos = 0;
        $tres = 0;
        $cuatro= 0;
        $cinco = 0;
        $seis = 0;
        for ($i=0; $i < $_POST['tiradas']; $i++) { 
            array_push($array, mt_rand($min, $max));
        }
        for ($i=0; $i < count($array); $i++) { 
            if($array[$i] == 1){
                $uno++;
            }
            if($array[$i] == 2){
                $dos++;
            }
            if($array[$i] == 3){
                $tres++;
            }
            if($array[$i] == 4){
                $cuatro++;
            }
            if($array[$i] == 5){
                $cinco++;
            }
            if($array[$i] == 6){
                $seis++;
            }
        }
        echo "El resultado de las tiradas es: </br>";
        if($uno != 0){
            if($uno> 1){
                echo "El número 1 aparece ".$uno. " veces </br>";
            }else{
                echo "El número 1 aparece ".$uno. " vez </br>";
            }
        }
        if($dos != 0){
            if($uno> 1){
                echo "El número 2 aparece ".$dos. " veces </br>";
            }else{
                echo "El número 2 aparece ".$uno. " vez </br>";
            }
        }
        if($tres != 0){
            if($uno> 1){
                echo "El número 3 aparece ".$tres. " veces </br>";
            }else{
                echo "El número 3 aparece ".$tres. " vez </br>";
            }
        }
        if($cuatro != 0){
            if($uno> 1){
                echo "El número 4 aparece ".$cuatro. " veces </br>";
            }else{
                echo "El número 4 aparece ".$cuatro. " vez </br>";
            }
        }
        if($cinco != 0){
            if($uno> 1){
                echo "El número 5 aparece ".$cinco. " veces </br>";
            }else{
                echo "El número 5 aparece ".$cinco. " vez </br>";
            }
        }
        if($seis != 0){
            if($uno> 1){
                echo "El número 6 aparece ".$seis. " veces </br>";
            }else{
                echo "El número 6 aparece ".$seis. " vez </br>";
            }
        }
    }
    ?>
</body>
</html>