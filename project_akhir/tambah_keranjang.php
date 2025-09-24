<?php
session_start();

$id = $_POST['id_produk'];
$nama = $_POST['nama_produk'];
$harga = $_POST['harga'];

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// kalau produk sudah ada di keranjang → tambahkan jumlah
if (isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id]['jumlah'] += 1;
} else {
    $_SESSION['cart'][$id] = [
        'nama' => $nama,
        'harga' => $harga,
        'jumlah' => 1
    ];
}

header("Location: pesanan.php");
exit;
?>
