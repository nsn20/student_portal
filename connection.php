<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "nitpy_project";

    //creating connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    //checking connection established or not
    if(!$conn){
        echo 'Connection Error: ' . mysqli_connect_error();
    }

?>
