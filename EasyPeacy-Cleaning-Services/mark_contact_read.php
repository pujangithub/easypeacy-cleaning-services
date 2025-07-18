<?php
session_start();
include("includes/connect.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $stmt = $conn->prepare("UPDATE contact_messages SET is_read = 1 WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
    exit();
}
echo "invalid";
?>
