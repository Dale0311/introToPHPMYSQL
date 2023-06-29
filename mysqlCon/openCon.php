<?php 
    $host = 'localhost';
    $username = 'root';
    $pass = '';
    $dbname = 'enrollmentSystem';

    $con = mysqli_connect($host,$username,$pass,$dbname);

    $con? "": die();
?>