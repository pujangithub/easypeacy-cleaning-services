<?php
include("includes/header.php"); // Make sure $conn (mysqli) is set here

function sanitize($conn, $str) {
    return htmlspecialchars(trim($conn->real_escape_string($str)));
}

// ===== Handle Full Form Submission =====
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize fields
    $first_name = sanitize($conn, $_POST['first_name'] ?? '');
    $last_name = sanitize($conn, $_POST['last_name'] ?? '');
    $company_name = sanitize($conn, $_POST['company_name'] ?? '');
    $email = sanitize($conn, $_POST['email'] ?? '');
    $phone = sanitize($conn, $_POST['phone'] ?? '');
    $street1 = sanitize($conn, $_POST['street1'] ?? '');
    $street2 = sanitize($conn, $_POST['street2'] ?? '');
    $city = sanitize($conn, $_POST['city'] ?? '');
    $bathrooms = intval($_POST['bathrooms'] ?? 0);
    $bedrooms = isset($_POST['bedrooms']) ? intval($_POST['bedrooms']) : null;
    $last_cleaned = sanitize($conn, $_POST['last_cleaned'] ?? '');
    $notes_combined = sanitize($conn, $_POST['notes_combined'] ?? '');

    $services = $_POST['services'] ?? [];
    $available_days = $_POST['available_days'] ?? [];

    // Validate required fields
    $errors = [];

    if (!$first_name) $errors[] = "First name is required.";
    if (!$last_name) $errors[] = "Last name is required.";
    if (!$email) $errors[] = "Email is required.";
    if (!$phone) $errors[] = "Phone is required.";
    if (!$street1) $errors[] = "Street 1 is required.";
    if (!$city) $errors[] = "City is required.";
    if ($bathrooms < 0) $errors[] = "Bathrooms must be 0 or more.";
    if (empty($services)) $errors[] = "Select at least one cleaning service.";

    // Output errors if any
    if (!empty($errors)) {
        echo '
        <style>
          .message-box {
            max-width: 600px;
            margin: 50px auto;
            padding: 25px 30px;
            border-radius: 10px;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            text-align: center;
            background-color: #f8d7da;
            color: #721c24;
            border: 1.5px solid #f5c6cb;
          }
          .message-box a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #dc3545;
            border-radius: 6px;
            transition: background-color 0.3s ease;
          }
          .message-box a:hover {
            background-color: #a71d2a;
          }
        </style>
        <div class="message-box">
          <h2>Errors:</h2>
          <ul style="text-align: left; max-width: 400px; margin: 0 auto 15px auto;">';
          foreach ($errors as $e) {
            echo '<li>' . htmlspecialchars($e) . '</li>';
          }
        echo '</ul>
          <a href="javascript:history.back()">Go back</a>
        </div>';
        exit;
    }

    // Insert into bookings table
    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("INSERT INTO bookings (first_name, last_name, company_name, email, phone, street1, street2, city, bathrooms, bedrooms, last_cleaned, available_days, notes_combined) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $available_days_json = json_encode($available_days);

        $stmt->bind_param(
            "sssssssssisss",
            $first_name, $last_name, $company_name, $email, $phone, $street1, $street2, $city,
            $bathrooms, $bedrooms, $last_cleaned, $available_days_json, $notes_combined
        );

        if (!$stmt->execute()) throw new Exception("Booking insert failed: " . $stmt->error);
        $booking_id = $stmt->insert_id;
        $stmt->close();

        // Insert services
        $stmt = $conn->prepare("INSERT INTO booking_services (booking_id, service_name) VALUES (?, ?)");
        foreach ($services as $service) {
            $clean_service = sanitize($conn, $service);
            $stmt->bind_param("is", $booking_id, $clean_service);
            $stmt->execute();
        }
        $stmt->close();

        // Insert images if any
        if (!empty($_FILES['images']) && $_FILES['images']['error'][0] != UPLOAD_ERR_NO_FILE) {
            $upload_dir = __DIR__ . '/uploads/';
            if (!is_dir($upload_dir)) mkdir($upload_dir, 0755, true);

            $stmt = $conn->prepare("INSERT INTO booking_images (booking_id, image_path) VALUES (?, ?)");
            $files = $_FILES['images'];
            $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

            for ($i = 0; $i < count($files['name']); $i++) {
                if ($files['error'][$i] !== UPLOAD_ERR_OK) continue;
                if (!in_array($files['type'][$i], $allowed)) continue;

                $ext = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
                $new_name = uniqid('img_', true) . '.' . $ext;
                $target_path = $upload_dir . $new_name;

                if (move_uploaded_file($files['tmp_name'][$i], $target_path)) {
                    $relative_path = 'uploads/' . $new_name;
                    $stmt->bind_param("is", $booking_id, $relative_path);
                    $stmt->execute();
                }
            }
            $stmt->close();
        }

        $conn->commit();

        // Success message
        echo '
        <style>
          .message-box {
            max-width: 600px;
            margin: 50px auto;
            padding: 25px 30px;
            border-radius: 10px;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            text-align: center;
            background-color: #d4edda;
            color: #155724;
            border: 1.5px solid #c3e6cb;
          }
          .message-box a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #28a745;
            border-radius: 6px;
            transition: background-color 0.3s ease;
          }
          .message-box a:hover {
            background-color: #1e7e34;
          }
        </style>
        <div class="message-box">
          <h2>Thank you for your request!</h2>
          <p>We’ve received your cleaning request. We’ll review it and contact you soon via email or phone.</p>
          <a href="index.php">Return to Home</a>
        </div>';
    } catch (Exception $e) {
        $conn->rollback();
        echo '
        <style>
          .message-box {
            max-width: 600px;
            margin: 50px auto;
            padding: 25px 30px;
            border-radius: 10px;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            text-align: center;
            background-color: #f8d7da;
            color: #721c24;
            border: 1.5px solid #f5c6cb;
          }
          .message-box a {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background-color: #dc3545;
            border-radius: 6px;
            transition: background-color 0.3s ease;
          }
          .message-box a:hover {
            background-color: #a71d2a;
          }
        </style>
        <div class="message-box">
          <h2>Error occurred</h2>
          <p>' . htmlspecialchars($e->getMessage()) . '</p>
          <a href="javascript:history.back()">Try Again</a>
        </div>';
    }
} else {
    header("Location: booking.php");
    exit;
}
?>
