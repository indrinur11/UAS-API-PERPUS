<?php
    require_once('../config/koneksi_db.php');

    $myArray = array();
    if (isset($_GET['id_buku'])){
        $id_buku=$_GET['id_buku'];

        if ($result = mysqli_query($conn, "SELECT * FROM perpustakaan WHERE id_buku=$id_buku")){
            while ($row = $result->fetch_array(MYSQLI_ASSOC)){
                $myArray[] = $row;
            }
            mysqli_close($conn);
            echo json_encode($myArray);
        }
    }
?>