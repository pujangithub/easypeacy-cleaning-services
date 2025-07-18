<?php include("includes/header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Contact - EasyPeacy Cleaning Services</title>
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

    /* ===== CONTAINER ANIMATION ===== */
    .contact_container {
      animation: slideUp 1s ease forwards;
    }

    /* ===== HEADER ===== */
    .contact_container h2 {
      font-size: 2.5rem;
      color: black;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
      position: relative;
      border-bottom: none; /* remove any old underline */
      animation: slideInLeft 1s ease forwards;
    }

    .contact_container h2::after {
      content: '';
      display: block;
      margin: 10px auto 0 auto;
      height: 4px;
      background-color: #000;
      animation: underlineGrow 1s ease forwards;
      width: 120px; /* wider animated underline */
    }

    /* ===== PHONE NUMBER ===== */
    .contact-number {
      font-weight: bold;
      color: black !important;
      font-size: 1.2rem;
      margin-top: 25px;
      text-align: center;
      cursor: pointer; /* indicate clickable */
      user-select: none;
    }

    /* (Optional) Responsive tweak */
    @media (max-width: 600px) {
      .contact_container h2 {
        font-size: 2rem;
      }

      .contact-number {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
<main class="contact-main">
  <div class="contact_container">
    <h2>Contact Us</h2>

    <?php
    // Initialize message variable
    $feedback = '';

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
      // Sanitize input
      $name = htmlspecialchars(trim($_POST['name']));
      $email = htmlspecialchars(trim($_POST['email']));
      $message = htmlspecialchars(trim($_POST['message']));

      // Simple validation (you can expand if needed)
      if (empty($name) || empty($email) || empty($message)) {
        $feedback = "<p style='text-align:center; color: red; margin-top: 20px;'>Please fill in all required fields.</p>";
      } else {
        // Insert into DB - make sure $conn is your mysqli connection from includes/header.php
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        if ($stmt) {
          $stmt->bind_param("sss", $name, $email, $message);
          if ($stmt->execute()) {
            $feedback = "<p style='text-align:center; color: green; margin-top: 20px;'>Thank you, <strong>$name</strong>. Your message has been received.</p>";
          } else {
            $feedback = "<p style='text-align:center; color: red; margin-top: 20px;'>Sorry, something went wrong. Please try again later.</p>";
          }
          $stmt->close();
        } else {
          $feedback = "<p style='text-align:center; color: red; margin-top: 20px;'>Database error. Please try again later.</p>";
        }
      }
    }
    echo $feedback;
    ?>

    <form action="" method="post">
      <input type="text" name="name" placeholder="Your Name" required /><br>
      <input type="email" name="email" placeholder="Your Email" required /><br>
      <textarea name="message" placeholder="Your Message" required></textarea><br>
      <button type="submit" name="submit">Send</button>
    </form>

    <p class="contact-number" title="Click to copy">
  You can also reach us directly at: <strong id="phone">0415 847 220</strong><br><br>
  Or email us at: <strong id="email">info@easypeasycleaningservicess.com</strong>
</p>

  </div>
</main>

<script>
  function copyToClipboard(id, label) {
    const text = document.getElementById(id).textContent.trim();
    navigator.clipboard.writeText(text).then(() => {
      alert(`${label} ${text} copied to clipboard!`);
    }).catch(() => {
      alert(`Failed to copy ${label.toLowerCase()}. Please copy manually.`);
    });
  }

  document.getElementById("phone").addEventListener("click", () => copyToClipboard("phone", "Phone number"));
  document.getElementById("email").addEventListener("click", () => copyToClipboard("email", "Email"));
</script>


</body>
</html>
<?php include("includes/footer.php"); ?>
