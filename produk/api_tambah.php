<?php
    require_once('../config/koneksi_db.php');
    
    // Pastikan method POST dan data yang diperlukan telah tersedia
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['judul']) && isset($_POST['pengarang']) && isset($_POST['penerbit'])) {
        $judul = $_POST['judul'];
        $pengarang = $_POST['pengarang'];
        $penerbit = $_POST['penerbit'];
        
        // Persiapan query dengan prepared statement
        $sql = $conn->prepare("INSERT INTO perpustakaan (judul, pengarang, penerbit) VALUES (?, ?, ?)");
        
        // Periksa apakah preparasi query berhasil
        if ($sql === false) {
            // Jika gagal, tangani kesalahan (contoh sederhana, bisa dimodifikasi untuk menangani lebih detail)
            die('Query preparation failed: ' . htmlspecialchars($conn->error));
        }
        
        // Binding parameter ke dalam query
        $sql->bind_param('sss', $judul, $pengarang, $penerbit);
        
        // Eksekusi query
        $sql->execute();
        
        // Periksa apakah query berhasil dieksekusi
        if ($sql->affected_rows > 0) {
            // Jika berhasil
            echo json_encode(array('RESPONSE' => 'SUCCESS'));
            // atau redirect ke halaman lain jika diperlukan
            // header("Location: ../readapi/tampil.php");
        } else {
            // Jika gagal
            echo json_encode(array('RESPONSE' => 'FAILED'));
        }
        
        // Tutup statement
        $sql->close();
    } else {
        // Jika data yang diperlukan tidak tersedia
        echo "GAGAL";
    }
?>
