<?php include_once 'connect.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>EasyPeacy Cleaning Services</title>
  <link rel="stylesheet" href="style.css" />

  <!-- Internal CSS for contact-top-right -->
  <style>
    .header-container {
      position: relative;
    }

    .contact-top-right {
      position: absolute;
      top: 10px;
      right: 20px;
      z-index: 1;
      font-size: 14px;
      display: flex;
      gap: 15px;
      color: #333;
    }

    .contact-top-right span {
      cursor: pointer;
      white-space: nowrap;
    }

    .contact-top-right a {
      color: #333;
      text-decoration: none;
      margin-left: 5px;
    }

    .contact-top-right i {
      margin-right: 4px;
    }

    @media (max-width: 768px) {
      .contact-top-right {
        position: fixed;
        top: 5px;
        left: 60%;
        transform: translateX(-50%);
        opacity: 0.8;
        z-index: 1000;
        justify-content: center;
        text-align: center;
        font-size: 13px;
        background: rgba(255, 255, 255, 0.85);
        padding: 4px 10px;
        border-radius: 6px;
        color: #333;
      }
    }
  </style>
</head>
<body>
<?php
  $currentPage = basename($_SERVER['PHP_SELF']);
?>
  <header>
    <div class="header-container">

      <!-- Contact Info in Top Right -->
      <div class="contact-top-right">
        <span onclick="copyToClipboard('info@easypeacycleaningservicess.com')">📩 info@easypeacycleaningservicess.com</span>
        <span onclick="copyToClipboard('+61 0415 847 220')">📞 +61 0415 847 220</span>
      </div>

      <!-- Logo Video wrapped in a link -->
      <div class="logo">
        <a href="index.php" aria-label="Go to Home">
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

      <!-- Navigation Menu -->
      <nav id="nav-links" class="slide-up">
        <a href="index.php" id="home" class="<?php echo ($currentPage == 'index.php') ? 'active' : ''; ?>">Home</a>
        <a href="services.php" id="services" class="<?php echo ($currentPage == 'services.php') ? 'active' : ''; ?>">Services</a>
        <a href="about.php" id="aboutus" class="<?php echo ($currentPage == 'about.php') ? 'active' : ''; ?>">About Us</a>
        <a href="contact.php" id="contact" class="<?php echo ($currentPage == 'contact.php') ? 'active' : ''; ?>">Contact</a>
        <a href="faq.php" id="faqs" class="<?php echo ($currentPage == 'faq.php') ? 'active' : ''; ?>">FAQs</a>
        <a href="admin_login.php" id="login" class="<?php echo ($currentPage == 'admin_login.php') ? 'active' : ''; ?>">Login</a>
      </nav>
    </div>
  </header>

  <!-- JavaScript -->
  <script>
    // Logo video control
    const logoVideo = document.getElementById('logo-video');
    logoVideo.loop = false;
    logoVideo.playbackRate = 0.7;

    function playVideoOnce() {
      logoVideo.currentTime = 0;
      logoVideo.play();
    }

    logoVideo.addEventListener('mouseenter', playVideoOnce);
    logoVideo.addEventListener('click', playVideoOnce);

    // Slide-up nav animation
    window.addEventListener('DOMContentLoaded', () => {
      const nav = document.getElementById('nav-links');
      setTimeout(() => {
        nav.classList.add('slide-up-active');
      }, 50);
    });

    // Hamburger toggle for mobile
    const hamburger = document.getElementById('hamburger');
    const nav = document.getElementById('nav-links');

    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('active');
      nav.classList.toggle('active');
    });

    // Copy to clipboard function
    function copyToClipboard(text) {
      navigator.clipboard.writeText(text).then(() => {
        alert('Copied: ' + text);
      }).catch(err => {
        alert('Failed to copy!');
      });
    }
    // Hide contact-top-right on scroll past nav height
    window.addEventListener('scroll', () => {
      const contactDiv = document.querySelector('.contact-top-right');
      const nav = document.getElementById('nav-links');
      if (!contactDiv || !nav) return;
      const navHeight = nav.offsetHeight;
      if (window.scrollY > navHeight) {
        contactDiv.style.display = 'none';
      } else {
        contactDiv.style.display = 'flex';
      }
    });
  </script>
</body>
</html>
