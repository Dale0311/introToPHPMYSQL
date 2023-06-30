<?php 
    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dbPass = '';
    $dbName = 'enrollmentSystem';

    $con = mysqli_connect($dbHost,$dbUsername,$dbPass,$dbName);

    $con? "": die();
?>