<?php

    $dbServerName='localhost';
    $dbUserName='root';
    $dbPassword='';
    $dbName='student_db';

    $dbConnection=mysqli_connect($dbServerName,$dbUserName,$dbPassword,$dbName);

    // trying to display error if the connection to the database failed
    if(!$dbConnection){
        die("Could not connect to the database. Please try again". mysqli_connect_error());
    }

?>