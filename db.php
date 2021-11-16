<?php

    $con = mysqli_connect("localhost","root","","tadreeb");
    mysqli_query($con , "set NAMES utf8");

    if (mysqli_connect_errno())
      {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

?>