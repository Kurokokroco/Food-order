<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pemesanan Makanan</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>

  <!-- Navbar -->
  <div class="navbar">
    <h1>FoodOrder</h1>
    <div>
      <a href="index.php">Beranda</a>
      <a href="menu.php">Menu</a>
      <a href="pesanan.php">Pesanan</a>
      <a href="logout.php">Logout</a>
    </div>
  </div>

  <!-- Hero -->
  <div class="hero">
    <div class="hero-content">
      <h2>Selamat Datang, <?= $_SESSION['user']; ?> 🍴</h2>
      <p>Pesan makanan favoritmu dengan mudah, cepat, dan praktis.</p>
      <button><a href="menu.php" style="text-decoration: none; color: white;">Pesan Sekarang</a></button>
    </div>
  </div>

  <!-- Menu Makanan -->
  <div class="menu">
    <div class="card">
      <img src="img/burger.png" alt="Burger">
      <h3>Burger Spesial</h3>
      <p>Burger juicy dengan daging premium dan keju leleh.</p>
      <button>Pesan</button>
    </div>
    <div class="card">
      <img src="img/piszza.png" alt="Pizza">
      <h3>Pizza Keju</h3>
      <p>Pizza tipis dengan saus tomat segar dan ekstra keju.</p>
      <button>Pesan</button>
    </div>
    <div class="card">
      <img src="img/salad.png" alt="Salad">
      <h3>Salad Sehat</h3>
      <p>Sayuran segar dengan dressing rendah kalori.</p>
      <button>Pesan</button>
    </div>
    <div class="card">
      <img src="img/kopi.png" alt="Coffee">
      <h3>Kopi Latte</h3>
      <p>Kopi hangat dengan susu creamy, cocok untuk santai.</p>
      <button>Pesan</button>
    </div>
  </div>

  <!-- Footer -->
  <footer>
   
  </footer>

</body>
</html>
