<?php
session_start();
include("includes/connect.php");

// Master login credentials
$MASTER_USERNAME = "SuperAdmin_!2#2025@PEACY";

$username   = trim($_POST['username_for_reset'] ?? '');
$newPassword = trim($_POST['new_password_reset'] ?? '');

if (!$username || !$newPassword) {
    die("All fields are required.");
}

// If it's master admin — just alert
if ($username === $MASTER_USERNAME) {
    echo "<script>alert('Master Admin credentials cannot be changed.'); window.location.href='admin_accounts.php';</script>";
    exit();
}

// Check if user exists
$stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $row = $result->fetch_assoc()) {
    $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
    $updateStmt = $conn->prepare("UPDATE admin_users SET password_hash = ? WHERE username = ?");
    $updateStmt->bind_param("ss", $hashed, $username);
    $updateStmt->execute();

    echo "<script>alert('Password has been reset successfully.'); window.location.href='admin_accounts.php';</script>";
} else {
    echo "<script>alert('Username not found.'); window.location.href='admin_accounts.php';</script>";
}
