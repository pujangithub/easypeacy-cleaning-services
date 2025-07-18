<?php
session_start();
include("includes/connect.php");

// Simple admin check - you can enhance security as needed
if (!isset($_SESSION['admin_logged_in']) && !isset($_COOKIE['admin_remember'])) {
    http_response_code(403);
    echo 'error';
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = isset($_POST['booking_id']) ? intval($_POST['booking_id']) : 0;
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    if ($booking_id > 0 && in_array($status, ['pending', 'completed'])) {
        $stmt = $conn->prepare("UPDATE bookings SET status = ? WHERE id = ?");
        $stmt->bind_param('si', $status, $booking_id);

        if ($stmt->execute()) {
            echo 'success';
        } else {
            // Could log $stmt->error here for debugging
            echo 'error';
        }
        $stmt->close();
    } else {
        echo 'error';
    }
} else {
    echo 'error';
}
?>
