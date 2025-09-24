<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Logout</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #ff9800, #ff5722);
      color: white;
      text-align: center;
    }
    .container {
      background: rgba(0,0,0,0.6);
      padding: 40px;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      animation: fadeIn 0.8s ease-in-out;
    }
    h2 {
      margin-bottom: 10px;
      font-size: 28px;
    }
    p {
      margin-bottom: 20px;
      font-size: 16px;
      opacity: 0.9;
    }
    .loader {
      border: 4px solid rgba(255,255,255,0.3);
      border-top: 4px solid #fff;
      border-radius: 50%;
      width: 40px;
      height: 40px;
      margin: 0 auto 15px;
      animation: spin 1s linear infinite;
    }
    @keyframes spin {
      100% { transform: rotate(360deg); }
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="loader"></div>
    <h2>Berhasil Logout</h2>
    <p>Anda akan diarahkan ke halaman login...</p>
  </div>

  <script>
    setTimeout(() => {
      window.location.href = "login.php";
    }, 3000); // redirect setelah 3 detik
  </script>
</body>
</html>
