<?php
    $servername="proyectoagendat-server.mysql.database.azure.com";
    $database="agendat";
    $username="agendat";
    $password="Yuyacast9021";

    $conn= mysqli_connect($servername,$username,$password,$database);

    if(!$conn){
        die("Conexión fallida". mysqli_connect_error());
    }
    

