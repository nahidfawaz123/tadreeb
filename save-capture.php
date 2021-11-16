<?php

    $image = $_POST["image"];
    $name = $_POST["name"];
    $type = $_POST['type'];
    
    $arr1 = explode(";", $image);
    $image = $arr1[1];

    
    $arr2 = explode(",", $image);
    $image = $arr2[1];

  
    $image = str_replace(" ", "+", $image);

   
    $image = base64_decode($image);

    
    
    
    if($type=='card'){

        $image_name="Cards\\";
        $image_name.= $name;
        $image_name.="_Card.jpeg";

    }else if($type=='certificate'){

        $image_name="Certificates\\";
        $image_name.= $name;
        $image_name.="_Certificate.jpeg";
    }
    
    file_put_contents($image_name, $image);

    
    echo $image_name;

?>
