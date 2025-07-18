<?php
session_start();
include("includes/connect.php");

if (!isset($_SESSION['admin_logged_in']) && !isset($_COOKIE['admin_remember'])) {
    header("Location: admin_login.php");
    exit();
}

if (!isset($_SESSION['admin_logged_in']) && isset($_COOKIE['admin_remember'])) {
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['admin_username'] = $_COOKIE['admin_remember'];
}

$adminName = $_SESSION['admin_username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Completed Jobs | EasyPeacy Cleaning Services</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    .dashboard-main {
      flex: 1;
      width: 95%;
      margin: 50px auto;
      padding: 30px;
      background-color: transparent;
      color: #111;
      font-family: 'Segoe UI', sans-serif;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.8);
      animation: fadeInUp 1s ease forwards;
    }

    .dashboard-main h2 {
      font-size: 2.2rem;
      margin-bottom: 10px;
      border-bottom: 2px solid #000;
      padding-bottom: 10px;
    }

    a.back-dashboard {
      display: inline-block;
      margin-bottom: 20px;
      font-weight: bold;
      text-decoration: none;
      color: #00b0f0;
      font-size: 1rem;
    }

    a.back-dashboard:hover {
      text-decoration: underline;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
      table-layout: auto;
    }

    table th, table td {
      padding: 12px;
      border: 1px solid #ccc;
      text-align: left;
    }

    table th {
      background-color: #f0f0f0;
    }

    .details-link {
      text-decoration: none;
      font-weight: bold;
      color: #007bff;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive: Hide Address column on small screens */
    @media (max-width: 768px) {
      table th:nth-child(3),
      table td:nth-child(3) {
        display: none;
      }

      table th, table td {
        padding: 8px;
      }
    }
  </style>
</head>
<body>

<?php include("includes/header1.php"); ?>

<main class="dashboard-main">
  <h2>Completed Bookings</h2>
  <a class="back-dashboard" href="admin_dashboard.php">&larr; Back to Dashboard</a>

  <table>
    <thead>
      <tr>
        <th>SN</th>
        <th>Full Name</th>
        <th>Address</th>
        <th>Booked On</th>
        <th>More Details</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM bookings WHERE status = 'completed' ORDER BY created_at DESC";
      $result = $conn->query($sql);
      $sn = 1;

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row['id'];
          $fullName = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
          $addressParts = [$row['street1'], $row['street2'], $row['city']];
          $address = htmlspecialchars(implode(', ', array_filter($addressParts)));
          $createdAt = htmlspecialchars($row['created_at']);

          echo "<tr>";
          echo "<td>$sn</td>";
          echo "<td>$fullName</td>";
          echo "<td>$address</td>";
          echo "<td>$createdAt</td>";
          echo "<td><a href='booking_details.php?id=$id' class='details-link'>View</a></td>";
          echo "</tr>";
          $sn++;
        }
      } else {
        echo "<tr><td colspan='5' style='text-align:center;'>No completed bookings found.</td></tr>";
      }
      ?>
    </tbody>
  </table>
</main>

<footer>
  <p>&copy; <?php echo date("Y"); ?> EasyPeacy Cleaning Services</p>
</footer>

</body>
</html>
