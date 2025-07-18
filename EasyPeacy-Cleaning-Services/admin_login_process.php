<?php
session_start();
include("includes/connect.php");
// Master login credentials
$MASTER_USERNAME = "SuperAdmin_!2#2025@PEACY";
$MASTER_PASSWORD = "EasyPeacy@#MasterLogin!2025";

// Default fallback login (used only if DB is empty)
$DEFAULT_USERNAME = "easypeacyusername";
$DEFAULT_PASSWORD = "easypeacypassword";

// Get submitted values
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (!$username || !$password) {
    die("Both fields are required.");
}

// 1️⃣ Master Login Check
if ($username === $MASTER_USERNAME && $password === $MASTER_PASSWORD) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = "MASTER_ADMIN";
    setcookie("admin_remember", "MASTER_ADMIN", time() + (30 * 24 * 60 * 60), "/");
    header("Location: admin_dashboard.php");
    exit();
}

// 2️⃣ Check if table is empty
$result = $conn->query("SELECT COUNT(*) as total FROM admin_users");
$data = $result->fetch_assoc();

if ($data['total'] == 0 && $username === $DEFAULT_USERNAME && $password === $DEFAULT_PASSWORD) {
    // DB is empty and correct default creds used — insert and login
    $hashed_password = password_hash($DEFAULT_PASSWORD, PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO admin_users (username, password_hash) VALUES (?, ?)");
    $stmt->bind_param("ss", $DEFAULT_USERNAME, $hashed_password);
    $stmt->execute();

    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $DEFAULT_USERNAME;
    setcookie("admin_remember", $DEFAULT_USERNAME, time() + (30 * 24 * 60 * 60), "/");
    header("Location: admin_dashboard.php");
    exit();
}

// 3️⃣ Normal Login (from table)
$stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $row = $result->fetch_assoc()) {
    if (password_verify($password, $row['password_hash'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        setcookie("admin_remember", $username, time() + (30 * 24 * 60 * 60), "/");
        header("Location: admin_dashboard.php");
        exit();
    } else {
        echo "<script>alert('Incorrect password.'); window.location.href='admin_login.php';</script>";
        exit();
    }
} else {
    echo "<script>alert('Admin user not found.'); window.location.href='admin_login.php';</script>";
    exit();
}
?>
