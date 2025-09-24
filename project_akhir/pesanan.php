<?php
session_start();
include "koneksi.php";

// Hapus item dari keranjang
if (isset($_POST['remove'])) {
    $id_hapus = $_POST['id_produk'];
    if (isset($_SESSION['cart'][$id_hapus])) {
        unset($_SESSION['cart'][$id_hapus]);
    }
}

// Kalau tombol Konfirmasi Pesanan ditekan
if (isset($_POST['checkout'])) {
    $nama       = $_POST['nama'];
    $alamat     = $_POST['alamat'];
    $telepon    = $_POST['telepon'];
    $pengiriman = $_POST['pengiriman'];
    $pembayaran = $_POST['pembayaran'];

    // Simpan pesanan
    $sql = "INSERT INTO pesanan (nama, alamat, telepon, pengiriman, pembayaran, tanggal) 
        VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$nama, $alamat, $telepon, $pengiriman, $pembayaran]);
        $id_pesanan = $conn->lastInsertId();


    // Simpan detail pesanan
    foreach ($_SESSION['cart'] as $id_produk => $item) {
    $nama_produk = $item['nama'];
    $harga       = $item['harga'];
    $jumlah      = $item['jumlah'];
    $total       = $harga * $jumlah;

    $sql2 = "INSERT INTO detail_pesanan (id_pesanan, id_produk, nama_produk, harga, jumlah, total) 
             VALUES (?, ?, ?, ?, ?, ?)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute([$id_pesanan, $id_produk, $nama_produk, $harga, $jumlah, $total]);
}

    // Kosongkan keranjang
    unset($_SESSION['cart']);
    echo "<script>alert('✅ Pesanan berhasil dikonfirmasi!'); window.location='index.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pesanan | FoodOrder</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {margin:0;font-family:'Poppins',sans-serif;background:#f8f9fa;color:#333;}
    header {background:#000;padding:15px 40px;display:flex;justify-content:space-between;align-items:center;color:white;}
    header h1{margin:0;font-size:22px;}
    nav a{margin-left:20px;text-decoration:none;color:white;font-weight:500;}
    .container{max-width:1200px;margin:auto;padding:40px 20px;display:grid;grid-template-columns:2fr 1fr;gap:30px;}
    h2{margin-bottom:20px;color:#ff5722;}
    table{width:100%;border-collapse:collapse;background:white;border-radius:10px;overflow:hidden;box-shadow:0 4px 10px rgba(0,0,0,0.1);}
    table th,table td{padding:15px;text-align:center;border-bottom:1px solid #eee;}
    table th{background:#ff9800;color:white;}
    table tr:hover{background:#fff7e6;}
    input[type=number]{width:60px;padding:5px;text-align:center;border:1px solid #ccc;border-radius:6px;}
    .remove-btn{background:crimson;color:white;border:none;padding:6px 10px;border-radius:6px;cursor:pointer;font-size:12px;transition:.2s;}
    .remove-btn:hover{background:darkred;}
    .summary{background:white;padding:20px;border-radius:10px;box-shadow:0 4px 10px rgba(0,0,0,0.1);}
    .summary p{display:flex;justify-content:space-between;margin:8px 0;}
    .total{font-weight:600;color:#ff5722;font-size:18px;}
    .form-section{margin-top:40px;}
    .form-group{margin-bottom:15px;}
    .form-group label{display:block;margin-bottom:6px;font-weight:500;}
    .form-group input,.form-group select,.form-group textarea{width:100%;padding:10px;border-radius:8px;border:1px solid #ccc;font-family:inherit;}
    .btn{background:#ff9800;border:none;padding:12px 20px;border-radius:8px;color:white;cursor:pointer;font-size:16px;transition:0.3s;margin-top:15px;width:100%;}
    .btn:hover{background:#e68900;}
    .total-row td{font-weight:600;color:#ff5722;}
  </style>
</head>
<body>
<header>
  <h1>FoodOrder</h1>
  <nav>
    <a href="index.php">Beranda</a>
    <a href="menu.php">Menu</a>
    <a href="pesanan.php">Pesanan</a>
    <a href="logout.php">Logout</a>
  </nav>
</header>

<div class="container">
  <!-- Keranjang Belanja -->
  <div>
    <h2>Keranjang Belanja 🛒</h2>
    <form method="post">
    <table id="cart-table">
      <thead>
        <tr>
          <th>Gambar</th>
          <th>Nama Produk</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Total</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
      <?php
$grandTotal = 0;
$grandTotal = 0; 
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $key => $item) {
        $total = $item['harga'] * $item['jumlah'];
        $grandTotal += $total;
        echo "
        <tr>
          <td><img src='{$item['gambar']}' alt='{$item['nama']}' width='60'></td>
          <td>{$item['nama']}</td>
          <td data-price='{$item['harga']}'>Rp" . number_format($item['harga'], 0, ',', '.') . "</td>
          <td><input type='number' value='{$item['jumlah']}' min='1' onchange='updateTotal(this)'></td>
          <td class='item-total'>Rp" . number_format($total, 0, ',', '.') . "</td>
          <td>
            <!-- Form hapus berdiri sendiri -->
            <form method='post' action='pesanan.php' style='display:inline;'>
              <input type='hidden' name='id_produk' value='{$key}'>
              <button type='submit' name='remove' class='remove-btn'>Hapus</button>
            </form>
          </td>
        </tr>";
    }
    echo "<tr class='total-row'><td colspan='4'>Total Belanja</td><td colspan='2'>Rp" . number_format($grandTotal, 0, ',', '.') . "</td></tr>";
} else {
    echo "<tr><td colspan='6'>Keranjang masih kosong</td></tr>";
}
?>
  </form>
  <form action="" method="post">
      </tbody>
    </table>

    <!-- Form Informasi Pengiriman -->
    <div class="form-section">
      <h2>Informasi Pengiriman 📦</h2>
      <div class="form-group">
        <label>Nama Lengkap</label>
        <input type="text" name="nama" required>
      </div>
      <div class="form-group">
        <label>Alamat Lengkap</label>
        <textarea name="alamat" rows="3" required></textarea>
      </div>
      <div class="form-group">
        <label>Nomor Telepon</label>
        <input type="text" name="telepon" required>
      </div>
      <div class="form-group">
        <label>Metode Pengiriman</label>
        <select name="pengiriman" required>
          <option value="reguler">Reguler - Rp10.000</option>
          <option value="express">Express - Rp20.000</option>
        </select>
      </div>
    </div>

    <!-- Form Pembayaran -->
    <div class="form-section">
      <h2>Metode Pembayaran 💳</h2>
      <div class="form-group">
        <select name="pembayaran" required>
          <option value="transfer">Transfer Bank</option>
          <option value="gopay">GoPay</option>
          <option value="ovo">OVO</option>
          <option value="cod">Bayar di Tempat (COD)</option>
        </select>
      </div>
    </div>

    <!-- Tombol Konfirmasi -->
    <button type="submit" name="checkout" class="btn">Konfirmasi Pesanan ✅</button>
    </form>
  </div>

  <!-- Ringkasan Pesanan -->
  <div>
    <div class="summary" id="summary">
      <h3>Ringkasan Pesanan</h3>
      <p><span>Subtotal</span> <span id="subtotal">Rp0</span></p>
      <p><span>Ongkir</span> <span id="ongkir">Rp0</span></p>
      <p><span>Pajak (10%)</span> <span id="pajak">Rp0</span></p>
      <hr>
      <p class="total"><span>Total</span> <span id="total">Rp0</span></p>
    </div>
  </div>
</div>

<script>
  function updateTotal(input) {
    let row = input.closest("tr");
    let price = parseInt(row.querySelector("td[data-price]").dataset.price);
    let qty = parseInt(input.value);
    let totalCell = row.querySelector(".item-total");
    let itemTotal = price * qty;
    totalCell.textContent = "Rp" + itemTotal.toLocaleString("id-ID");
    updateSummary();
  }

  function updateSummary() {
    let rows = document.querySelectorAll("#cart-table tbody tr");
    let subtotal = 0;
    rows.forEach(row => {
      if (row.querySelector("td[data-price]")) {
        let price = parseInt(row.querySelector("td[data-price]").dataset.price);
        let qty = parseInt(row.querySelector("input")?.value || 0);
        subtotal += price * qty;
      }
    });
    let ongkir = 10000;
    let pajak = subtotal * 0.1;
    let total = subtotal + ongkir + pajak;

    document.getElementById("subtotal").textContent = "Rp" + subtotal.toLocaleString("id-ID");
    document.getElementById("ongkir").textContent = "Rp" + ongkir.toLocaleString("id-ID");
    document.getElementById("pajak").textContent = "Rp" + pajak.toLocaleString("id-ID");
    document.getElementById("total").textContent = "Rp" + total.toLocaleString("id-ID");
  }

  // Hitung saat halaman dibuka
  updateSummary();
</script>
</body>
</html>
