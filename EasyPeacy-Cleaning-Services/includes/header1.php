<?php include_once 'connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin Panel | EasyPeacy Cleaning Services</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <header>
    <div class="header-container">
      
      <!-- Logo Video linking to admin dashboard -->
      <div class="logo">
        <a href="admin_dashboard.php" aria-label="Go to Admin Dashboard">
          <video id="logo-video" autoplay muted playsinline style="display: block; cursor: pointer;" width="150">
            <source src="lea-2.mp4" type="video/mp4" />
            Your browser does not support the video tag.
          </video>
        </a>
      </div>

      <!-- Hamburger Icon (for mobile) -->
      <div class="hamburger" id="hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>

      <!-- Admin Navigation Menu -->
      <nav id="nav-links" class="slide-up">
        <a href="admin_dashboard.php" id="admin-home">Home</a>
        <a href="admin_contacts.php" id="admin-contact">Contact</a>
        <a href="admin_accounts.php" id="admin-accounts">Account</a>
        <a href="logout.php" id="logout" style="color: red;">Logout</a>
      </nav>
    </div>
  </header>

  <!-- JavaScript -->
  <script>
    const logoVideo = document.getElementById('logo-video');
    logoVideo.loop = false;
    logoVideo.playbackRate = 0.7;

    function playVideoOnce() {
      logoVideo.currentTime = 0;
      logoVideo.play();
    }

    logoVideo.addEventListener('mouseenter', playVideoOnce);
    logoVideo.addEventListener('click', playVideoOnce);

    window.addEventListener('DOMContentLoaded', () => {
      const nav = document.getElementById('nav-links');
      setTimeout(() => {
        nav.classList.add('slide-up-active');
      }, 50);
    });

    const hamburger = document.getElementById('hamburger');
    const nav = document.getElementById('nav-links');

    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('active');
      nav.classList.toggle('active');
    });
  </script>
