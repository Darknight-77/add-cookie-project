<?php

    $conn = mysqli_connect('localhost', 'root', '', 'add-cookie_db');

    // check the connection
    if(!$conn) {
       echo 'The connnection failed ' . mysqli_connect_error(); 
    }

?>