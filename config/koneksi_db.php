<?php
    define('HOST','localhost');
    define('USER','root');
    define('DB','uas');
    define('PASS','');
    $conn = new mysqli(HOST,USER,PASS,DB) or die('Koneksi error ntuk mengakses database');
?>
