<?php
require_once('../config/koneksi_db.php');
header('Content-Type: application/json');

// Ambil data JSON dari input
$data = json_decode(file_get_contents("php://input"));

// Validasi dan ambil data yang diperlukan
if (isset($data->id_buku, $data->judul, $data->pengarang, $data->penerbit)) {
    $id_buku = $data->id_buku;
    $judul = $data->judul;
    $pengarang = $data->pengarang;
    $penerbit = $data->penerbit;

    // Persiapkan query update
    $sql = $conn->prepare("UPDATE perpustakaan SET judul=?, pengarang=?, penerbit=? WHERE id_buku=?");
    if (!$sql) {
        http_response_code(500); // Internal Server Error
        echo json_encode(array('RESPONSE' => 'FAILED', 'MESSAGE' => 'Query preparation error: ' . $conn->error));
        exit;
    }

    // Bind parameter dan eksekusi query
    $sql->bind_param('sssi', $judul, $pengarang, $penerbit, $id_buku);
    $sql->execute();

    // Periksa apakah update berhasil atau tidak
    if ($sql->affected_rows > 0) {
        echo json_encode(array('RESPONSE' => 'SUCCESS'));
    } else {
        echo json_encode(array('RESPONSE' => 'FAILED', 'MESSAGE' => 'No rows updated'));
    }

    $sql->close(); // Tutup statement SQL
} else {
    http_response_code(400); // Bad Request
    echo json_encode(array('RESPONSE' => 'FAILED', 'MESSAGE' => 'Missing required data'));
}

$conn->close(); // Tutup koneksi database
?>
