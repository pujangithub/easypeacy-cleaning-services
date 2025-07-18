<?php
session_start();
include("includes/connect.php");

if (!isset($_SESSION['admin_logged_in']) && !isset($_COOKIE['admin_remember'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_SESSION['admin_logged_in']) && isset($_COOKIE['admin_remember'])) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $_COOKIE['admin_remember'];
}

$currentUsername = $_SESSION['admin_username'] ?? '';
$displayUsername = '';

// Fetch current username if not master
if ($currentUsername !== "MASTER_ADMIN") {
    $stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
    $stmt->bind_param("s", $currentUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $row = $result->fetch_assoc()) {
        $displayUsername = htmlspecialchars($row['username']);
    } else {
        $displayUsername = "Unknown";
    }
} else {
    $displayUsername = "MASTER_ADMIN";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Account Settings | EasyPeacy</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .admin-account-container {
      width: 90%;
      max-width: 700px;
      margin: 50px auto;
      padding: 30px;
      background-color: #f8f8f8;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      animation: fadeInUp 1s ease forwards;
      font-family: 'Segoe UI', sans-serif;
    }

    .admin-account-container h2 {
      margin-bottom: 20px;
      text-align: center;
      font-size: 1.8rem;
    }

    .admin-account-container form {
      margin-top: 25px;
    }

    .admin-account-container input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }

    .admin-account-container button {
      width: 100%;
      padding: 12px;
      background: black;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 1rem;
      cursor: pointer;
    }

    .admin-account-container button:hover {
      background: #00b0f0;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<?php include("includes/header1.php"); ?>

<div class="admin-account-container">
  <h2>Account Settings</h2>
  <p><strong>Logged in as:</strong> <?php echo $displayUsername; ?></p>

  <!-- Change Username/Password -->
  <form action="update_credentials.php" method="post">
    <h3>Change Username or Password</h3>
    <input type="text" name="current_username" placeholder="Current Username" required>
    <input type="password" name="current_password" placeholder="Current Password" required>
    <input type="text" name="new_username" placeholder="New Username (optional)">
    <input type="password" name="new_password" placeholder="New Password (optional)">
    <button type="submit" name="update">Update Credentials</button>
  </form>

  <hr style="margin: 30px 0;">

  <!-- Forgot Password -->
  <form action="reset_password.php" method="post">
    <h3>Forgot Password</h3>
    <input type="text" name="username_for_reset" placeholder="Enter your username" required>
    <input type="password" name="new_password_reset" placeholder="New Password" required>
    <button type="submit" name="reset">Reset Password</button>
  </form>
</div>

<footer>
  <p style="text-align:center;">&copy; <?php echo date("Y"); ?> EasyPeacy Cleaning Services</p>
</footer>

</body>
</html>
