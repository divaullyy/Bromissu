<?php
// Koneksi ke database
$host = 'localhost'; // Ganti dengan host database Anda
$dbname = 'nama_database'; // Ganti dengan nama database Anda
$username = 'username_database'; // Ganti dengan username database Anda
$password = 'password_database'; // Ganti dengan password database Anda

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
    exit;
}

// Cek apakah data telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST['nama']);
    $ulasan = htmlspecialchars($_POST['ulasan']);

    // Siapkan dan jalankan query untuk menyimpan ulasan
    $sql = "INSERT INTO ulasan (nama, ulasan) VALUES (:nama, :ulasan)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':ulasan', $ulasan);

    if ($stmt->execute()) {
        echo "Ulasan berhasil dikirim!";
        header("Location: ulasan.html"); // Redirect kembali ke halaman ulasan
        exit;
    } else {
        echo "Terjadi kesalahan saat mengirim ulasan.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Terkirim</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Status Pengiriman</h2>
        <p><?php echo $message; ?></p>
        <a href="ulasan.html" class="btn btn-primary">Kembali ke Halaman Ulasan</a>
    </div>
</body>
</html>