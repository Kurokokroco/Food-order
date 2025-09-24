<?php
session_start();
include 'koneksi.php'; // pastikan koneksi.php sudah benar

$message = "";

if (isset($_POST['daftar'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // lebih aman pakai password_hash()

    // insert data ke tabel
    $query = mysqli_query($koneksi, "INSERT INTO login (username, password) VALUES ('$username', '$password')");
    if ($query) {
        $message = "Pendaftaran berhasil! Silakan login.";
    } else {
        $message = "Pendaftaran gagal. Coba lagi.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f0f0;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
            width: 350px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            width: 100%;
            background: black;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background: #444;
        }
        .message {
            text-align: center;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
        }
        .success {
            background: #e0ffe0;
            color: green;
        }
        .error {
            background: #ffe0e0;
            color: red;
        }
        .sudahpunyakun {
            margin-top: 15px;
            text-align: center;
        }
        .sudahpunyakun a {
            color: blue;
            text-decoration: none;
            font-weight: bold;
        }
        .sudahpunyakun a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <div class="container">
            <h2>Daftar</h2>

            <?php if (!empty($message)): ?>
                <div class="message <?= strpos($message, 'berhasil') !== false ? 'success' : 'error' ?>">
                    <?= $message ?>
                </div>
            <?php endif; ?>

            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" name="daftar" value="Daftar">

            <div class="sudahpunyakun">
                Sudah punya akun? <a href="login.php">Login</a>
            </div>
        </div>
    </form>
</body>
</html>
