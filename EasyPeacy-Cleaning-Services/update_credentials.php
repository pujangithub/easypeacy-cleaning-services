<?php
session_start();
include("includes/connect.php");

// Master login credentials
$MASTER_USERNAME = "SuperAdmin_!2#2025@PEACY";
$MASTER_PASSWORD = "EasyPeacy@#MasterLogin!2025";

$currentUsername = $_POST['current_username'] ?? '';
$currentPassword = $_POST['current_password'] ?? '';
$newUsername     = trim($_POST['new_username'] ?? '');
$newPassword     = trim($_POST['new_password'] ?? '');

if (!$currentUsername || !$currentPassword) {
    die("Current username and password are required.");
}

// If master admin is used
if ($currentUsername === $MASTER_USERNAME && $currentPassword === $MASTER_PASSWORD) {
    echo "<script>alert('You are logged in as Master Admin. You cannot change credentials here.'); window.location.href='admin_accounts.php';</script>";
    exit();
}

// Fetch current user
$stmt = $conn->prepare("SELECT * FROM admin_users WHERE username = ?");
$stmt->bind_param("s", $currentUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $row = $result->fetch_assoc()) {
    if (!password_verify($currentPassword, $row['password_hash'])) {
        echo "<script>alert('Incorrect current password.'); window.location.href='admin_accounts.php';</script>";
        exit();
    }

    $updates = [];
    $params  = [];
    $types   = "";

    if (!empty($newUsername)) {
        $updates[] = "username = ?";
        $params[] = $newUsername;
        $types   .= "s";
    }

    if (!empty($newPassword)) {
        $hashed = password_hash($newPassword, PASSWORD_DEFAULT);
        $updates[] = "password_hash = ?";
        $params[] = $hashed;
        $types   .= "s";
    }

    if (empty($updates)) {
        echo "<script>alert('Nothing to update.'); window.location.href='admin_accounts.php';</script>";
        exit();
    }

    $params[] = $currentUsername;
    $types   .= "s";
    $sql = "UPDATE admin_users SET " . implode(", ", $updates) . " WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        // Update session and cookie if username changed
        if (!empty($newUsername)) {
            $_SESSION['admin_username'] = $newUsername;
            setcookie("admin_remember", $newUsername, time() + (30 * 24 * 60 * 60), "/");
        }
        echo "<script>alert('Credentials updated successfully.'); window.location.href='admin_accounts.php';</script>";
    } else {
        echo "<script>alert('Update failed.'); window.location.href='admin_accounts.php';</script>";
    }
} else {
    echo "<script>alert('Admin not found.'); window.location.href='admin_accounts.php';</script>";
}
