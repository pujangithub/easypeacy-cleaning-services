<?php include("includes/header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Login | EasyPeacy Cleaning Services</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .admin-main {
      flex: 1;
      width: 85%;
      margin: 50px auto;
      padding: 30px;
      background-color: transparent;
      color: #111;
      font-family: 'Segoe UI', sans-serif;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.8);
      animation: fadeInUp 1s ease forwards;
    }

    .admin_container {
      width: 100%;
      margin: 0 auto;
      padding: 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 20px;
    }

    .admin_container form {
      width: 100%;
      max-width: 600px;
    }

    /* UPDATED HEADING STYLE WITH SLIDE-IN AND ANIMATED UNDERLINE */
    .admin_container h2 {
      font-size: 2.5rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 30px;
      position: relative;
      border-bottom: none; /* remove old underline */
      animation: slideInLeft 1s ease forwards;
    }

    .admin_container h2::after {
      content: '';
      display: block;
      margin: 10px auto 0 auto;
      height: 4px;
      background-color: #000;
      animation: underlineGrow 1s ease forwards;
      width: 120px;
    }

    /* Keyframes for heading animations */
    @keyframes slideInLeft {
      from { opacity: 0; transform: translateX(-50px); }
      to { opacity: 1; transform: translateX(0); }
    }

    @keyframes underlineGrow {
      from { width: 0; }
      to { width: 120px; }
    }

    .admin_container .notice {
      color: red;
      font-size: 1rem;
      margin-top: -10px;
      text-align: center;
      font-weight: bold;
    }

    .admin_container input {
      width: 100%;
      padding: 12px 15px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 8px;
      box-sizing: border-box;
      font-family: inherit;
    }

    .admin_container button {
      background-color: black;
      color: white;
      border: none;
      padding: 12px 20px;
      font-size: 1rem;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
    }

    .admin_container button:hover {
      background-color: #00b0f0;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

  <!-- Admin Login Form -->
  <main class="admin-main">
    <div class="admin_container">
      <h2>Admin Login</h2>
      <p class="notice">Note: This login is only for EasyPeacy Cleaning Services admin.</p>
      <form action="admin_login_process.php" method="post">
        <input type="text" name="username" placeholder="Enter Admin Username" required />
        <br />
        <input type="password" name="password" placeholder="Enter Password" required />
        <br />
        <button type="submit">Login</button>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <footer>
    <p>&copy; <?php echo date("Y"); ?> EasyPeacy Cleaning Services</p>
  </footer>

</body>
</html>
