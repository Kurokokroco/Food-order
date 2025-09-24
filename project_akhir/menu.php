<?php
session_start();
include "koneksi.php";

if (isset($_POST['tambah_keranjang'])) {
    $id_produk   = $_POST['id'];
    $nama_produk = $_POST['nama'];
    $harga       = $_POST['harga'];
    $gambar      = $_POST['gambar'];

    // Jika produk sudah ada di cart, tambahkan jumlah
    $found = false;
    if (!empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $key => $item) {
            if ($item['id'] == $id_produk) {
                $_SESSION['cart'][$key]['jumlah'] += 1;
                $found = true;
            }
        }
    }

    // Jika belum ada, tambahkan baru
    if (!$found) {
        $_SESSION['cart'][] = [
            'id'     => $id_produk,
            'nama'   => $nama_produk,
            'harga'  => $harga,
            'jumlah' => 1,
            'gambar' => $gambar
        ];
    }

    header("Location: pesanan.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu | FoodOrder</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {margin:0;font-family:'Poppins',sans-serif;background:#f8f9fa;color:#333;}
    header {background:#000;padding:15px 40px;display:flex;justify-content:space-between;align-items:center;color:white;}
    header h1 {margin:0;font-size:22px;}
    nav a {margin-left:20px;text-decoration:none;color:white;font-weight:500;}
    .container {max-width:1200px;margin:auto;padding:40px 20px;}
    h2 {font-size:26px;margin-bottom:20px;color:#ff5722;}
    .menu-grid {display:grid;grid-template-columns:repeat(auto-fit,minmax(250px,1fr));gap:20px;}
    .menu-item {background:white;border-radius:12px;overflow:hidden;box-shadow:0 4px 10px rgba(0,0,0,0.1);transition:transform 0.3s;display:flex;flex-direction:column;}
    .menu-item:hover {transform:translateY(-5px);}
    .menu-item img {width:100%;aspect-ratio:4/3;object-fit:cover;display:block;}
    .menu-info {padding:15px;flex-grow:1;display:flex;flex-direction:column;justify-content:space-between;}
    .menu-info h3 {margin:0 0 10px;font-size:18px;}
    .menu-info p {font-size:14px;color:#555;margin-bottom:10px;}
    .menu-footer {display:flex;justify-content:space-between;align-items:center;margin-top:auto;}
    .price {font-weight:600;color:#ff5722;}
    .btn-keranjang {
      background: linear-gradient(135deg, #ff9800, #ff5722);
      border: none;
      padding: 8px 14px;
      border-radius: 8px;
      color: white;
      cursor: pointer;
      font-size: 14px;
      font-weight: 600;
      transition: all 0.3s;
    }
    .btn-keranjang:hover {background:linear-gradient(135deg,#e68900,#d84315);transform:scale(1.05);}
    .kategori {margin:50px 0 20px;font-size:20px;color:#333;font-weight:600;border-left:5px solid #ff5722;padding-left:10px;}
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
    <!-- Kategori Makanan Utama -->
    <div class="kategori">🍔 Makanan Utama</div>
    <div class="menu-grid">

      <div class="menu-item">
        <img src="img/burger.png" alt="Burger">
        <div class="menu-info">
          <h3>Cheese Burger</h3>
          <p>Burger daging sapi dengan keju leleh, selada, dan saus spesial.</p>
          <div class="menu-footer">
            <span class="price">Rp25.000</span>
            <form method="post" action="menu.php">
              <input type="hidden" name="id" value="1">
              <input type="hidden" name="nama" value="Cheese Burger">
              <input type="hidden" name="harga" value="25000">
              <input type="hidden" name="gambar" value="img/burger.png">
              <button type="submit" name="tambah_keranjang" class="btn-keranjang">+ Keranjang</button>
            </form>
          </div>
        </div>
      </div>

      <div class="menu-item">
        <img src="img/piszza.png" alt="Pizza">
        <div class="menu-info">
          <h3>Pizza Pepperoni</h3>
          <p>Pizza tipis dengan topping pepperoni, keju mozzarella, dan saus tomat.</p>
          <div class="menu-footer">
            <span class="price">Rp55.000</span>
            <form method="post" action="menu.php">
              <input type="hidden" name="id" value="2">
              <input type="hidden" name="nama" value="Pizza Pepperoni">
              <input type="hidden" name="harga" value="55000">
              <input type="hidden" name="gambar" value="img/piszza.png">
              <button type="submit" name="tambah_keranjang" class="btn-keranjang">+ Keranjang</button>
            </form>
          </div>
        </div>
      </div>

      <div class="menu-item">
        <img src="img/salad.png" alt="Salad">
        <div class="menu-info">
          <h3>Salad Sayur</h3>
          <p>Salad segar dengan campuran sayuran hijau, tomat ceri, dan dressing pilihan.</p>
          <div class="menu-footer">
            <span class="price">Rp15.000</span>
            <form method="post" action="menu.php">
              <input type="hidden" name="id" value="3">
              <input type="hidden" name="nama" value="Salad Sayur">
              <input type="hidden" name="harga" value="15000">
              <input type="hidden" name="gambar" value="img/salad.png">
              <button type="submit" name="tambah_keranjang" class="btn-keranjang">+ Keranjang</button>
            </form>
          </div>
        </div>
      </div>

      <div class="menu-item">
        <img src="img/kebab.png" alt="Kebab">
        <div class="menu-info">
          <h3>Kebab</h3>
          <p>Irisan daging panggang dengan roti pita hangat dan sayuran segar.</p>
          <div class="menu-footer">
            <span class="price">Rp20.000</span>
            <form method="post" action="menu.php">
              <input type="hidden" name="id" value="4">
              <input type="hidden" name="nama" value="Kebab">
              <input type="hidden" name="harga" value="20000">
              <input type="hidden" name="gambar" value="img/kebab.png">
              <button type="submit" name="tambah_keranjang" class="btn-keranjang">+ Keranjang</button>
            </form>
          </div>
        </div>
      </div>

    </div>

    <!-- Kategori Minuman -->
    <div class="kategori">🥤 Minuman</div>
    <div class="menu-grid">

      <div class="menu-item">
        <img src="img/kopi.png" alt="Kopi">
        <div class="menu-info">
          <h3>Cappuccino</h3>
          <p>Kopi susu dengan foam lembut, pas untuk menemani santai.</p>
          <div class="menu-footer">
            <span class="price">Rp20.000</span>
            <form method="post" action="menu.php">
              <input type="hidden" name="id" value="5">
              <input type="hidden" name="nama" value="Cappuccino">
              <input type="hidden" name="harga" value="20000">
              <input type="hidden" name="gambar" value="img/kopi.png">
              <button type="submit" name="tambah_keranjang" class="btn-keranjang">+ Keranjang</button>
            </form>
          </div>
        </div>
      </div>

      <div class="menu-item">
        <img src="img/jeruk.png" alt="Jus Jeruk">
        <div class="menu-info">
          <h3>Jus Jeruk</h3>
          <p>Perasan jeruk asli tanpa gula tambahan, segar dan sehat.</p>
          <div class="menu-footer">
            <span class="price">Rp12.000</span>
            <form method="post" action="menu.php">
              <input type="hidden" name="id" value="6">
              <input type="hidden" name="nama" value="Jus Jeruk">
              <input type="hidden" name="harga" value="12000">
              <input type="hidden" name="gambar" value="img/jeruk.png">
              <button type="submit" name="tambah_keranjang" class="btn-keranjang">+ Keranjang</button>
            </form>
          </div>
        </div>
      </div>

      <div class="menu-item">
        <img src="img/alpukat.png" alt="Jus Alpukat">
        <div class="menu-info">
          <h3>Jus Alpukat</h3>
          <p>Jus alpukat creamy, kaya nutrisi dan mengenyangkan.</p>
          <div class="menu-footer">
            <span class="price">Rp18.000</span>
            <form method="post" action="menu.php">
              <input type="hidden" name="id" value="7">
              <input type="hidden" name="nama" value="Jus Alpukat">
              <input type="hidden" name="harga" value="18000">
              <input type="hidden" name="gambar" value="img/alpukat.png">
              <button type="submit" name="tambah_keranjang" class="btn-keranjang">+ Keranjang</button>
            </form>
          </div>
        </div>
      </div>

      <div class="menu-item">
        <img src="img/teh.png" alt="Es Teh">
        <div class="menu-info">
          <h3>Es Teh Manis</h3>
          <p>Minuman teh dingin segar pelepas dahaga.</p>
          <div class="menu-footer">
            <span class="price">Rp5.000</span>
            <form method="post" action="menu.php">
              <input type="hidden" name="id" value="8">
              <input type="hidden" name="nama" value="Es Teh Manis">
              <input type="hidden" name="harga" value="5000">
              <input type="hidden" name="gambar" value="img/teh.png">
              <button type="submit" name="tambah_keranjang" class="btn-keranjang">+ Keranjang</button>
            </form>
          </div>
        </div>
      </div>

    </div>

    <!-- Kategori Camilan -->
    <div class="kategori">🍟 Camilan</div>
    <div class="menu-grid">

      <div class="menu-item">
        <img src="img/kentang.png" alt="Kentang Goreng">
        <div class="menu-info">
          <h3>Kentang Goreng</h3>
          <p>Kentang goreng renyah dengan saus pilihan.</p>
          <div class="menu-footer">
            <span class="price">Rp12.000</span>
            <form method="post" action="menu.php">
              <input type="hidden" name="id" value="9">
              <input type="hidden" name="nama" value="Kentang Goreng">
              <input type="hidden" name="harga" value="12000">
              <input type="hidden" name="gambar" value="img/kentang.png">
              <button type="submit" name="tambah_keranjang" class="btn-keranjang">+ Keranjang</button>
            </form>
          </div>
        </div>
      </div>

      <div class="menu-item">
        <img src="img/sosis.png" alt="Sosis Bakar">
        <div class="menu-info">
          <h3>Sosis Bakar</h3>
          <p>Sosis bakar dengan saus sambal atau mayones.</p>
          <div class="menu-footer">
            <span class="price">Rp10.000</span>
            <form method="post" action="menu.php">
              <input type="hidden" name="id" value="10">
              <input type="hidden" name="nama" value="Sosis Bakar">
              <input type="hidden" name="harga" value="10000">
              <input type="hidden" name="gambar" value="img/sosis.png">
              <button type="submit" name="tambah_keranjang" class="btn-keranjang">+ Keranjang</button>
            </form>
          </div>
        </div>
      </div>

      <div class="menu-item">
        <img src="img/nugget.png" alt="Nugget Ayam">
        <div class="menu-info">
          <h3>Nugget Ayam</h3>
          <p>Cemilan daging ayam renyah di luar, lembut di dalam.</p>
          <div class="menu-footer">
            <span class="price">Rp15.000</span>
            <form method="post" action="menu.php">
              <input type="hidden" name="id" value="11">
              <input type="hidden" name="nama" value="Nugget Ayam">
              <input type="hidden" name="harga" value="15000">
              <input type="hidden" name="gambar" value="img/nugget.png">
              <button type="submit" name="tambah_keranjang" class="btn-keranjang">+ Keranjang</button>
            </form>
          </div>
        </div>
      </div>

      <div class="menu-item">
        <img src="img/roti.png" alt="Roti Bakar">
        <div class="menu-info">
          <h3>Roti Bakar</h3>
          <p>Roti bakar isi coklat/keju, enak untuk cemilan.</p>
          <div class="menu-footer">
            <span class="price">Rp15.000</span>
            <form method="post" action="menu.php">
              <input type="hidden" name="id" value="12">
              <input type="hidden" name="nama" value="Roti Bakar">
              <input type="hidden" name="harga" value="15000">
              <input type="hidden" name="gambar" value="img/roti.png">
              <button type="submit" name="tambah_keranjang" class="btn-keranjang">+ Keranjang</button>
            </form>
          </div>
        </div>
      </div>

    </div>
  </div>

</body>
</html>
