<?php include("includes/header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>EasyPeacy Cleaning Services</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    menu_index {
      display: block;
      flex: 1;
      padding: 40px 20px;
      background-color: #f9f9f9;
    }

    /* Full width hero wrapper */
    .hero-full-bg {
      width: 100%;
      position: relative;
      margin-bottom: 40px;
    }

    /* Hero-content with background image */
    .hero-content {
      width: 100%;
      background-image: url('home1.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      padding: 80px 20px;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
      position: relative;
      border-radius: 20px;
      box-sizing: border-box;
      min-height: 320px;
    }

    /* Dim overlay — less dark */
    .hero-content .overlay {
      position: absolute;
      inset: 0;
      background-color: rgba(0, 0, 0, 0.08); /* reduced opacity from 0.2 */
      border-radius: 20px;
      z-index: 0;
    }

    /* Hero text with stronger shadows, excluding button */
    .hero-content .hero-text {
      position: relative;
      z-index: 1;
      max-width: 700px;
      background-color: transparent;
      color: #000;
      text-align: left;
      padding: 20px 30px;
      border-radius: 20px;
      /* stronger text shadow for better contrast */
      text-shadow:
        4px 4px 10px rgba(0, 0, 0, 0.3),
        2px 2px 6px rgba(255, 255, 255, 0.7);
      font-weight: 600;
      line-height: 1.4;
    }

    /* Remove text-shadow from button (keep it clean) */
    .hero-content .hero-text .btn.hero-cta {
      text-shadow: none !important;
    }

    .hero-text h2 {
      font-size: 2.8rem;
      margin-bottom: 20px;
      font-weight: 700;
    }

    .hero-text p {
      font-size: 1.3rem;
      line-height: 1.5;
      margin-bottom: 30px;
    }

    /* Hero button */
    .btn.hero-cta {
      background-color: black;
      color: white;
      padding: 12px 30px;
      border-radius: 8px;
      text-decoration: none;
      font-weight: 600;
      font-size: 1.1rem;
      transition: background-color 0.3s ease, transform 0.3s ease;
      display: inline-block;
    }

    .btn.hero-cta:hover {
      background-color: #00b0f0;
      transform: translateY(5px);
    }

    /* Section below hero */
    .hero-text1 {
      max-width: 1200px;
      margin: 0 auto 60px auto;
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: flex-start;
    }

    a.service {
      background: white;
      flex: 1 1 calc(30% - 20px);
      box-sizing: border-box;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
      text-align: left;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
      text-decoration: none;
      color: inherit;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    a.service:hover {
      transform: translateY(-5px);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.25);
    }

    a.service img {
      width: 140px;
      height: auto;
      object-fit: contain;
      border-radius: 8px;
      pointer-events: none;
    }

    a.service h3 {
      font-size: 1.25rem;
      margin: 0;
      color: #000;
      width: 100%;
      pointer-events: none;
    }

    a.service p {
      font-size: 1rem;
      color: #333;
      margin: 0;
      line-height: 1.5;
      width: 100%;
      pointer-events: none;
    }

    /* Book a cleaning button below services */
    .book-cleaning-wrapper {
      text-align: center;
      margin-bottom: 40px;
    }

    .book-cleaning-wrapper .btn.hero-cta {
      max-width: 200px;
      margin: 0 auto;
      display: inline-block;
    }

    /* Animation */
    @keyframes slideInRight {
      from {
        opacity: 0;
        transform: translateX(100px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .btn.animate-slide-in {
      animation: slideInRight 0.8s ease-out;
    }

    /* Responsive */
    @media (max-width: 900px) {
      a.service {
        flex: 1 1 100%;
      }
      .hero-text h2 {
        font-size: 2rem;
      }
      .hero-text p {
        font-size: 1.1rem;
      }
    }
  </style>
</head>
<body>

<menu_index>

  <!-- Full width hero background -->
  <div class="hero-full-bg">
    <section class="hero-content">
      <div class="overlay"></div>
      <div class="hero-text">
        <h2>Welcome to EasyPeacy Cleaning Services</h2>
        <p>Clean space. Clear mind. Let us handle the mess, so you can focus on what matters most.</p>
        
        <a href="booking.php" class="btn hero-cta">Get a quote</a>
      </div>
    </section>
  </div>

  <h1 style="max-width: 800px; margin: 0 auto 40px auto; font-size: 2.3rem; text-align: center;">
    What type of cleaning are you looking for?
  </h1>

  <div class="hero-text1">

    <a href="booking.php?service=Bond Cleaning" class="service">
      <img src="bond.png" alt="Bond Cleaning">
      <h3>Bond Cleaning</h3>
      <p>Leave your old place spotless. Our bond cleaning service ensures your home meets the highest standards, helping you get your full bond back—stress-free and with confidence.</p>
    </a>

    <a href="booking.php?service=Window Cleaning" class="service">
      <img src="window_cheaning.png" alt="Window Cleaning">
      <h3>Window Cleaning</h3>
      <p>Let the light in. Our window cleaning service leaves every pane crystal clear—streak-free, spotless, and sparkling inside and out.</p>
    </a>

    <a href="booking.php?service=Spring Cleaning" class="service">
      <img src="spring_cleaning.png" alt="Spring Cleaning">
      <h3>Spring Cleaning</h3>
      <p>Refresh your home and reset your space. Our spring cleaning service gives every corner the attention it deserves—perfect for a seasonal deep clean that leaves your home feeling brand new.</p>
    </a>

    <a href="booking.php?service=Builder Cleaning" class="service">
      <img src="builder_cleaning.png" alt="Builder Cleaning">
      <h3>Builder Cleaning</h3>
      <p>Just finished building or renovating? Let us take care of the mess. Our builder cleaning service removes dust, debris, and construction residue—leaving your new space spotless, safe, and ready to enjoy.</p>
    </a>

    <a href="booking.php?service=Exterior House Washing" class="service">
      <img src="white_washing.png" alt="Exterior House Washing">
      <h3>Exterior House Washing</h3>
      <p>Give your home a fresh face. Our exterior house washing service removes dirt, mold, and grime from walls, driveways, and outdoor surfaces—restoring curb appeal and protecting your property.</p>
    </a>

    <a href="booking.php?service=Oven and BBQ Cleaning" class="service">
      <img src="bbq.png" alt="Oven and BBQ Cleaning">
      <h3>Oven and BBQ Cleaning</h3>
      <p>Say goodbye to grease and grime. Our oven and BBQ cleaning service removes built-up food residue and tough stains, leaving your appliances spotless, hygienic, and ready for your next cookout or meal.</p>
    </a>

  </div>

  <div class="book-cleaning-wrapper">
    <a href="booking.php" class="btn hero-cta">Book A Cleaning</a>
  </div>

</menu_index>

<script>
  const heroBtns = document.querySelectorAll('.hero-cta');

  const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('animate-slide-in');
        setTimeout(() => entry.target.classList.remove('animate-slide-in'), 1000);
      }
    });
  }, {
    threshold: 0.5
  });

  heroBtns.forEach(btn => observer.observe(btn));
</script>

<?php include("includes/footer.php"); ?>
</body>
</html>
