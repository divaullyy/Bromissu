<?php
  // Koneksi ke database (sesuaikan dengan pengaturan server)
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "toko_bromissu";

  // Membuat koneksi ke database
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Cek koneksi
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Ambil data dari form
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat'];
    $produk = $_POST['produk'];
    $jumlah = $_POST['jumlah'];

    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO pemesanan (nama, email, alamat, produk, jumlah)
            VALUES ('$nama', '$email', '$alamat', '$produk', '$jumlah')";

    if ($conn->query($sql) === TRUE) {
      // Redirect ke halaman form dengan pesan sukses
      header("Location: pemesanan.html?status=success");
    } else {
      // Redirect ke halaman form dengan pesan error
      header("Location: pemesanan.html?status=error");
    }

    $conn->close();
  }
?>
