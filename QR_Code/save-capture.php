<?php

    
    $image = $_POST["image"];
    
    $arr1 = explode(";", $image);
    $image = $arr1[1];

   
    $arr2 = explode(",", $image);
    $image = $arr2[1];

   
    $image = str_replace(" ", "+", $image);

   
    $image = base64_decode($image);

   
    file_put_contents("Cards\Card.jpeg", $image);

    
    echo "Done";

?>
