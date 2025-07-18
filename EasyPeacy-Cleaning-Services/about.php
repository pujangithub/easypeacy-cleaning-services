<?php include("includes/header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>About - EasyPeacy Cleaning Services</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    /* ===== ANIMATION KEYFRAMES ===== */
    @keyframes slideInLeft {
      from { opacity: 0; transform: translateX(-50px); }
      to { opacity: 1; transform: translateX(0); }
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(50px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes underlineGrow {
      from { width: 0; }
      to { width: 120px; }
    }

    /* ===== MAIN SECTION STYLING ===== */
    .main_about {
      max-width: 85%;
      margin: 50px auto;
      padding: 30px;
      background-color: transparent;
      color: #111;
      font-family: 'Segoe UI', sans-serif;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.8);
      animation: slideUp 1s ease forwards;
    }

    /* ===== ABOUT US HEADING ===== */
    .main_about h2 {
      font-size: 2.5rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 30px;
      position: relative;
      border-bottom: none;
      animation: slideInLeft 1s ease forwards;
    }

    .main_about h2::after {
      content: '';
      display: block;
      margin: 10px auto 0 auto;
      height: 4px;
      background-color: #000;
      animation: underlineGrow 1s ease forwards;
      width: 120px;
    }

    .main_about p {
      font-size: 1.1rem;
      margin-bottom: 20px;
      line-height: 1.7;
    }

    .main_about ul {
      padding-left: 20px;
      margin-bottom: 20px;
    }

    .main_about ul li {
      margin-bottom: 10px;
    }

    @media (max-width: 600px) {
      .main_about h2 {
        font-size: 2rem;
      }

      .main_about p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
<main class="main_about">
  <h2>About Us</h2>

  <p>
    Welcome to EasyPeacy Cleaning Services, your trusted local cleaning specialists based in Townsville. 
    We provide high-quality, affordable cleaning services for homes and rental properties, with a strong focus on reliability, 
    attention to detail, and customer satisfaction. Founded by Tika and supported by a dedicated family team, 
    our business was built on one simple promise: to deliver spotless results with honesty and care.
  </p>

  <p>
    We understand that letting someone into your home or business takes trust, and we take that seriously. 
    That’s why all our cleaners are fully trained, police-checked, and committed to delivering a professional service every time.
  </p>

  <p><strong>Our services include:</strong></p>
  <ul>
    <li>End of Lease / Bond Cleaning</li>
    <li>General Home Cleaning</li>
  </ul>

  <p>
    We bring our own high-quality equipment and products, and we follow a detailed checklist to ensure no spot is missed. 
    Whether you need a one-off clean or regular support, we tailor our services to meet your needs, with no rushed jobs, 
    and clear communication from start to finish.
  </p>

  <p>
    As a family-run business, we take pride in the work we do and the relationships we build.
  </p>

  <p><em>Clean space. Clear mind.</em> Let us handle the mess, so you can focus on what matters most.</p>
</main>
</body>
</html>
<?php include("includes/footer.php"); ?>
