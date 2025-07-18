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
  <title>Admin Dashboard | EasyPeacy Cleaning Services</title>
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

    a.view-completed {
      display: inline-block;
      margin-bottom: 20px;
      font-weight: bold;
      text-decoration: none;
      color: #00b0f0;
      font-size: 1rem;
    }
    a.view-completed:hover {
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

    .action-btn {
      padding: 6px 10px;
      font-size: 0.9rem;
      border-radius: 5px;
      text-decoration: none;
      color: white;
      cursor: pointer;
      border: none;
    }

    .completed-btn {
      background-color: green;
    }
    .completed-btn:hover {
      background-color: #007a00;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
      table th:nth-child(3),
      table td:nth-child(3) {
        display: none;
      }

      table th, table td {
        padding: 8px;
      }

      table td:last-child, table th:last-child {
        white-space: nowrap;
      }
    }
  </style>
</head>
<body>

<?php include("includes/header1.php"); ?>

<main class="dashboard-main">
  <h2>Welcome, <?php echo htmlspecialchars($adminName); ?> 👋</h2>
  <a class="view-completed" href="completed_jobs.php">&rarr; View Completed Jobs</a>
  <p>Below are the recent cleaning service requests.</p>

  <table>
    <thead>
      <tr>
        <th>SN</th>
        <th>Full Name</th>
        <th>Address</th>
        <th>Submitted On</th>
        <th>More Details</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM bookings WHERE status != 'completed' OR status IS NULL ORDER BY created_at DESC";
      $result = $conn->query($sql);
      $sn = 1;

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row['id'];
          $fullName = htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
          $addressParts = [$row['street1'], $row['street2'], $row['city']];
          $address = htmlspecialchars(implode(', ', array_filter($addressParts)));
          $submittedOn = htmlspecialchars(date("F j, Y, g:i a", strtotime($row['created_at'])));
          echo "<tr id='row-$id'>";
          echo "<td>$sn</td>";
          echo "<td>$fullName</td>";
          echo "<td>$address</td>";
          echo "<td>$submittedOn</td>";
          echo "<td><a href='booking_details.php?id=$id' class='details-link' title='View Full Details'>More Details</a></td>";
          echo "<td><button class='action-btn completed-btn' data-id='$id'>Mark Completed</button></td>";
          echo "</tr>";
          $sn++;
        }
      } else {
        echo "<tr><td colspan='6' style='text-align:center;'>No bookings found.</td></tr>";
      }
      ?>
    </tbody>
  </table>
</main>

<footer>
  <p>&copy; <?php echo date("Y"); ?> EasyPeacy Cleaning Services</p>
</footer>

<script>
document.querySelectorAll('.completed-btn').forEach(button => {
  button.addEventListener('click', () => {
    const bookingId = button.getAttribute('data-id');
    fetch('update_status.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'booking_id=' + encodeURIComponent(bookingId) + '&status=completed'
    })
    .then(response => response.text())
    .then(data => {
      if (data.trim() === 'success') {
        const row = document.getElementById('row-' + bookingId);
        if (row) row.style.display = 'none';
      } else {
        alert('Failed to mark booking as completed.');
      }
    })
    .catch(() => {
      alert('Error connecting to server.');
    });
  });
});
</script>

</body>
</html>
