<?php include("includes/header.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>FAQs - EasyPeacy Cleaning Services</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    /* Animations */
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

    /* FAQ Container */
    .faq-container {
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

    .faq-container h2 {
      font-size: 2.5rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 30px;
      position: relative;
      border-bottom: none;
      animation: slideInLeft 1s ease forwards;
    }

    .faq-container h2::after {
      content: '';
      display: block;
      margin: 10px auto 0 auto;
      height: 4px;
      background-color: #000;
      animation: underlineGrow 1s ease forwards;
      width: 120px;
    }

    .faq-container p {
      font-size: 1.1rem;
      margin-bottom: 20px;
      line-height: 1.7;
    }

    .faq-container ul {
      padding-left: 20px;
      margin-top: 10px;
    }

    .faq-container ul li {
      margin-bottom: 10px;
    }

    @media (max-width: 600px) {
      .faq-container h2 {
        font-size: 2rem;
      }

      .faq-container p {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>
<main class="faq-container">
  <h2>Frequently Asked Questions</h2>

  <p><strong>1. What services do you provide?</strong><br>
  We offer Bond Cleaning, Window Cleaning, Spring Cleaning, Builder Cleaning, Exterior House Washing, Domestic Cleaning, Oven and BBQ Cleaning.</p>

  <p><strong>2. Do I need to be home during the cleaning?</strong><br>
  No, you don’t need to be home, as long as our team has access to the property. We recommend you’re available for the first clean to walk through specific instructions if needed.</p>

  <p><strong>3. Do I need to provide cleaning supplies or equipment?</strong><br>
  No, we bring all necessary cleaning equipment and eco-friendly products. If you have special products you'd like us to use, let us know in advance.</p>

  <p><strong>4. What if I need to reschedule or cancel my booking?</strong><br>
  We kindly ask that you notify us at least 72 hours in advance if you need to reschedule or cancel your appointment.</p>

  <p><strong>5. Do you have any cancellation fees?</strong><br>
  Yes, we do.</p>
  <ul>
    <li>If you cancel more than 72 hours (3 days) before your booking — <strong>no fee</strong>.</li>
    <li>If you cancel between 24 to 72 hours before — <strong>12% fee</strong>.</li>
    <li>If you cancel less than 24 hours before — <strong>22% fee</strong>.</li>
  </ul>

  <p><strong>6. What if my utilities (electricity or hot water) are off during the appointment?</strong><br>
  We require hot water and electricity to complete our services. If utilities are off, we may need to cancel or reschedule the appointment, and a $80 inconvenience fee will be charged.</p>

  <p><strong>7. Are there any tasks your cleaners will not perform?</strong><br>
  Yes. For health and safety reasons, our cleaners will not handle human or pet feces, vomit, urine, blood, or any hazardous material.</p>

  <p><strong>8. Do you offer same day cleaning services?</strong><br>
  Same day bookings may be available depending on location and availability. Contact us directly to check.</p>

  <p><strong>9. Do you offer bond or end of lease cleaning?</strong><br>
  Yes, we specialise in bond cleaning and provide a detailed checklist to ensure you meet real estate standards.</p>

  <p><strong>10. What if I’m not satisfied with the cleaning?</strong><br>
  Customer satisfaction is our priority. If there’s anything we missed, let us know within 24 hours, and we’ll come back to fix it free of charge.</p>

  <p><strong>11. How long does a cleaning session take?</strong><br>
  This depends on the size and condition of your property. On average, a standard clean for a 3-bedroom home takes 2–3 hours.</p>

  <p><strong>12. Are your cleaners trained and insured?</strong><br>
  Yes, all our cleaners are fully trained, background checked, and covered by insurance.</p>

  <p><strong>13. Can I request the same cleaner every time?</strong><br>
  Absolutely. If you’re happy with your cleaner, we’ll do our best to assign them to all your future appointments.</p>

  <p><strong>14. Do you clean during weekends or public holidays?</strong><br>
  Yes, weekend bookings are available. Public holidays may incur an extra surcharge, please enquire when booking.</p>

  <p><strong>15. What payment methods do you accept?</strong><br>
  We accept EFTPOS, credit/debit cards, cash, and bank transfers. Full payment is required before the service begins to confirm your booking and secure your appointment.</p>

  <p><strong>16. Is there a minimum time requirement for bookings?</strong><br>
  Yes, we require a minimum of 2 hours for any cleaning service to ensure quality work.</p>
</main>
</body>
</html>
<?php include("includes/footer.php"); ?>
