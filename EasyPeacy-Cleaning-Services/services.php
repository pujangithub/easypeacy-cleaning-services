<?php include("includes/header.php"); ?>
<br><br>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Services - EasyPeacy Cleaning Services</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="hero-text">
    <h1 style="text-align: justify; text-align-last: center; margin: 0 auto; max-width: 800px; font-size: 2.3rem;">
      What type of cleaning are you looking for?
    </h1>

    <div class="hero-text1">

      <a href="booking.php?service=Bond Cleaning" class="service">
        <img src="bond.png" alt="">
        <h3>Bond Cleaning</h3>
        <p>Leave your old place spotless. Our bond cleaning service ensures your home meets the highest standards, helping you get your full bond back—stress-free and with confidence.</p>
        <span class="book-link">Book Now</span>
      </a>

      <a href="booking.php?service=Window Cleaning" class="service">
        <img src="window_cheaning.png" alt="">
        <h3>Window Cleaning</h3>
        <p>Let the light in. Our window cleaning service leaves every pane crystal clear—streak-free, spotless, and sparkling inside and out.</p>
        <span class="book-link">Book Now</span>
      </a>

      <a href="booking.php?service=Spring Cleaning" class="service">
        <img src="spring_cleaning.png" alt="">
        <h3>Spring Cleaning</h3>
        <p>Refresh your home and reset your space. Our spring cleaning service gives every corner the attention it deserves—perfect for a seasonal deep clean that leaves your home feeling brand new.</p>
        <span class="book-link">Book Now</span>
      </a>

      <a href="booking.php?service=Builder Cleaning" class="service">
        <img src="builder_cleaning.png" alt="">
        <h3>Builder Cleaning</h3>
        <p>Just finished building or renovating? Let us take care of the mess. Our builder cleaning service removes dust, debris, and construction residue—leaving your new space spotless, safe, and ready to enjoy.</p>
        <span class="book-link">Book Now</span>
      </a>

      <a href="booking.php?service=Exterior House Washing" class="service">
        <img src="white_washing.png" alt="">
        <h3>Exterior House Washing</h3>
        <p>Give your home a fresh face. Our exterior house washing service removes dirt, mold, and grime from walls, driveways, and outdoor surfaces—restoring curb appeal and protecting your property.</p>
        <span class="book-link">Book Now</span>
      </a>

      <a href="booking.php?service=Oven and BBQ Cleaning" class="service">
        <img src="bbq.png" alt="">
        <h3>Oven and BBQ Cleaning</h3>
        <p>Say goodbye to grease and grime. Our oven and BBQ cleaning service removes built-up food residue and tough stains, leaving your appliances spotless, hygienic, and ready for your next cookout or meal.</p>
        <span class="book-link">Book Now</span>
      </a>

    </div>
  </div>

  <br><br>
  <div class="hero">
    <a href="booking.php" class="btn hero-cta" style="display: block; margin: 0 auto; text-align: center; max-width: 200px;">
      Book A Cleaning
    </a>
  </div>
  <br><br>

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

<style>
  @media (max-width: 768px) {
  .hero-text h1 {
    font-size: 1.5rem !important; /* smaller font size on mobile */
    max-width: 100% !important;   /* ensure full width */
    text-align: center !important; /* center text on mobile */
  }
}

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


a.service {
  display: flex;
  flex-direction: column;
  text-decoration: none;
  color: inherit;
  padding: 20px;
  border-radius: 10px;
  background: white;
   box-shadow: 0 4px 10px rgba(0, 0, 0, 0.8);
  transition: box-shadow 0.3s ease, transform 0.3s ease;
  min-height: 350px;
}

a.service:hover {
  transform: translateY(-7px);
 box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
}


a.service h3,
a.service p {
  text-align: left;
}

a.service img {
  width: 140px;
  height: auto;
  border-radius: 8px;
  align-self: center;
  margin-bottom: 15px;
}

.book-link {
  margin-top: auto;
  align-self: center;
  display: inline-block;
  padding: 8px 18px;
  background-color: black;
  color: white;
  border-radius: 6px;
  font-size: 0.9rem;
  font-weight: bold;
  cursor: pointer;
  transition: background-color 0.3s ease;
  user-select: none;
  text-align: center;
}

.book-link:hover {
  background-color: #00b0f0;
}

/* Keep underline effect active */
#services::after {
  width: 100%;
}
</style>
</body>
</html>
