<?php
// Koneksi ke database
$servername = "localhost";
$username = "username"; // Ganti dengan username database kamu
$password = "password"; // Ganti dengan password database kamu
$dbname = "toko_bromissu"; // Ganti dengan nama database kamu

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Memeriksa apakah data dikirim melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telepon = $_POST['no_telepon'];

    // Menyiapkan dan mengeksekusi pernyataan SQL
    $sql = "UPDATE pelanggan SET nama=?, email=?, no_telepon=? WHERE id_pelanggan=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nama, $email, $no_telepon, $id_pelanggan);

    if ($stmt->execute()) {
        echo "Data pelanggan berhasil diperbarui.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Menutup pernyataan dan koneksi
    $stmt->close();
}

// Menutup koneksi
$conn->close();
?>