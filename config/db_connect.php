<?php 

    //connect to database
    $conn = mysqli_connect('localhost', 'patrick', 'star', 'db_the_pizza');

    //check connection
    if(!$conn) {
        echo 'connection error:' . mysqli_connect_error();
    }

?>