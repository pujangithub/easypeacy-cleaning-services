<?php
session_start();
include("includes/connect.php");

// Admin authentication check
if (!isset($_SESSION['admin_logged_in']) && !isset($_COOKIE['admin_remember'])) {
    header("Location: admin_login.php");
    exit();
}
if (!isset($_SESSION['admin_logged_in']) && isset($_COOKIE['admin_remember'])) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $_COOKIE['admin_remember'];
}

// Get booking ID safely
$bookingId = isset($_GET['id']) ? intval($_GET['id']) : 0;
if (!$bookingId) {
    echo "Invalid booking ID.";
    exit;
}

// Fetch booking details securely using prepared statement
$stmt = $conn->prepare("SELECT * FROM bookings WHERE id = ?");
$stmt->bind_param("i", $bookingId);
$stmt->execute();
$result = $stmt->get_result();
$booking = $result->fetch_assoc();
if (!$booking) {
    echo "Booking not found.";
    exit;
}
$stmt->close();

// Fetch related images securely
$imageStmt = $conn->prepare("SELECT image_path FROM booking_images WHERE booking_id = ?");
$imageStmt->bind_param("i", $bookingId);
$imageStmt->execute();
$imageResult = $imageStmt->get_result();
$images = [];
while ($row = $imageResult->fetch_assoc()) {
    $images[] = $row['image_path'];
}
$imageStmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>Booking Details | EasyPeacy Cleaning Services</title>
<style>
  /* Reset & Base */
  body {
    margin: 0; padding: 0;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f9f9f9;
    color: #111;
  }
  main.dashboard-main {
  width: 95vw; /* almost full viewport width */
  max-width: 1500px; /* max width */
  margin: 50px auto;
  background: #fff;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.15);
  animation: fadeInUp 0.8s ease forwards;
  box-sizing: border-box;
}

  main.dashboard-main {
    max-width: 1300px; /* increased width */
    margin: 50px auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
    animation: fadeInUp 0.8s ease forwards;
  }
  h2 {
    font-size: 2rem;
    border-bottom: 2px solid #000;
    padding-bottom: 10px;
    margin-bottom: 20px;
  }
  a.back-link {
    display: inline-block;
    margin-bottom: 20px;
    font-weight: bold;
    text-decoration: none;
    color: #007bff;
    transition: color 0.3s ease;
  }
  a.back-link:hover {
    text-decoration: underline;
    color: #0056b3;
  }
  .details-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
  }
  @media (max-width: 768px) {
    .details-grid {
      grid-template-columns: 1fr;
    }
  }
  .detail-box {
    background: #fff;
    border: 1px solid #ccc;
    border-radius: 8px;
    padding: 15px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }
.detail-box strong {
  color: #333;
  margin-right: 6px;
  display: inline-block; /* or inline */
  
}
.detail-box p {
  margin: 5px 0;
}

  .image-gallery {
    margin-top: 30px;
  }
  .image-gallery h3 {
    font-size: 1.2rem;
    margin-bottom: 10px;
  }
  .image-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(140px, 1fr));
    gap: 10px;
  }
  .image-grid img {
    width: 100%;
    height: auto;
    border-radius: 6px;
    object-fit: cover;
    box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    cursor: pointer;
    transition: transform 0.3s ease;
  }
  .image-grid img:hover {
    transform: scale(1.05);
  }
  /* Lightbox Overlay */
  #lightbox-overlay {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0,0,0,0.8);
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 1500;
    cursor: pointer;
  }
  #lightbox-overlay img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 8px;
    box-shadow: 0 0 20px #000;
    transition: transform 0.3s ease;
  }
  #lightbox-overlay img:hover {
    transform: scale(1.05);
  }
  footer {
    text-align: center;
    margin-top: 40px;
    padding: 20px;
    background-color: #fff;
    border-top: 1px solid #ddd;
  }
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px);}
    to { opacity: 1; transform: translateY(0);}
  }
</style>
</head>
<body>

<?php include("includes/header1.php"); ?>

<main class="dashboard-main">
  <h2>Booking Details</h2>
  <a href="admin_dashboard.php" class="back-link">&larr; Back to Dashboard</a>

  <div class="details-grid">
    <div class="detail-box">
  <p><strong>Name:</strong> <?= htmlspecialchars($booking['first_name'] . ' ' . $booking['last_name']) ?></p><br>
  <p><strong>Company:</strong> <?= htmlspecialchars($booking['company_name'] ?: '-') ?></p><br>
  <p><strong>Email:</strong> <?= htmlspecialchars($booking['email']) ?></p><br>
  <p><strong>Phone:</strong> <?= htmlspecialchars($booking['phone']) ?></p><br>
</div>


    <div class="detail-box">
      <strong>Address:</strong><br><br>
      <?= htmlspecialchars($booking['street1']) ?><br><br>
      <?= htmlspecialchars($booking['street2']) ?><br><br>
      <?= htmlspecialchars($booking['city']) ?><br>
      <br><strong>Status:</strong>
      <?= ucfirst(htmlspecialchars($booking['status'] ?: 'Pending')) ?>
    </div>

    <div class="detail-box">
      <strong>Bathrooms:</strong> <?= intval($booking['bathrooms']) ?><br><br>
      <strong>Bedrooms:</strong> <?= intval($booking['bedrooms']) ?><br><br>
      <strong>Last Cleaned:</strong> <?= htmlspecialchars($booking['last_cleaned']) ?>
    </div>

    <div class="detail-box">
      <strong>Available Days:</strong> 
      <?php
        // Assuming available_days stored as JSON string
        $days = json_decode($booking['available_days'], true);
        if (is_array($days)) {
            echo htmlspecialchars(implode(', ', $days));
        } else {
            echo htmlspecialchars($booking['available_days']);
        }
      ?><br>
      <br>
      <strong>Notes:</strong>
      <?= nl2br(htmlspecialchars($booking['notes_combined'] ?? '-')) ?>
    </div>
  </div>

  <?php if (!empty($images)): ?>
  <div class="image-gallery">
    <h3>Uploaded Photos</h3>
    <div class="image-grid">
      <?php foreach ($images as $img): ?>
        <img src="<?= htmlspecialchars($img) ?>" alt="Booking Image" class="gallery-img" data-src="<?= htmlspecialchars($img) ?>" />
      <?php endforeach; ?>
    </div>
  </div>
  <?php endif; ?>
</main>

<!-- Lightbox -->
<div id="lightbox-overlay">
  <img src="" alt="Expanded Booking Image" />
</div>

<footer>
  <p>&copy; <?= date("Y") ?> EasyPeacy Cleaning Services</p>
</footer>

<script>
  // Lightbox functionality
  const lightbox = document.getElementById('lightbox-overlay');
  const lightboxImg = lightbox.querySelector('img');
  const galleryImages = document.querySelectorAll('.gallery-img');

  galleryImages.forEach(img => {
    img.addEventListener('click', () => {
      lightboxImg.src = img.dataset.src;
      lightbox.style.display = 'flex';
      document.body.style.overflow = 'hidden'; // prevent background scroll
    });
  });

  lightbox.addEventListener('click', () => {
    lightbox.style.display = 'none';
    lightboxImg.src = '';
    document.body.style.overflow = ''; // restore scroll
  });

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape' && lightbox.style.display === 'flex') {
      lightbox.style.display = 'none';
      lightboxImg.src = '';
      document.body.style.overflow = '';
    }
  });
</script>

</body>
</html>
