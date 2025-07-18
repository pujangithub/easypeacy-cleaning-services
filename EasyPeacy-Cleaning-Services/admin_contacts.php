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
  <title>Admin Contacts | EasyPeacy Cleaning Services</title>
  <link rel="stylesheet" href="style.css" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
      color: #111;
    }

    .dashboard-main {
      width: 100%;
      max-width: 1600px;
      margin: 40px auto;
      padding: 30px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      animation: fadeInUp 0.8s ease;
    }

    .dashboard-main h2 {
      font-size: 2rem;
      margin-bottom: 10px;
    }

    .dashboard-main a {
      font-weight: bold;
      text-decoration: none;
      color: #007bff;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      font-size: 0.95rem;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ccc;
      text-align: left;
      vertical-align: top;
      word-wrap: break-word;
    }

    th {
      background-color: #f0f0f0;
    }

    .mark-read-btn {
      background-color: green;
      color: white;
      padding: 6px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 0.85rem;
      white-space: normal;
      width: 100%;
      box-sizing: border-box;
    }

    .see-more-inline {
      color: #007bff;
      cursor: pointer;
      font-size: 0.85rem;
      margin-left: 5px;
      display: inline;
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 768px) {
      .dashboard-main {
        margin: 20px 10px;
        padding: 20px 10px;
      }

      table {
        font-size: 0.85rem;
      }

      th:nth-child(3), td:nth-child(3),
      th:nth-child(5), td:nth-child(5) {
        display: none;
      }

      td:nth-child(4) {
        max-width: 150px;
        max-height: 3.6em;
        overflow: hidden;
        white-space: normal;
        word-wrap: break-word;
      }

      td:nth-child(6) {
        white-space: normal;
        width: auto;
      }
    }

    .modal-overlay {
      display: none;
      position: fixed;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0,0,0,0.6);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .modal-box {
      background: white;
      padding: 20px;
      max-width: 500px;
      width: 90%;
      border-radius: 8px;
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
    }

    .modal-box h3 {
      margin-top: 0;
      margin-bottom: 10px;
      font-size: 1.2rem;
    }

    .modal-box p {
      margin-bottom: 10px;
      word-wrap: break-word;
    }

    .close-modal {
      background: red;
      color: white;
      border: none;
      padding: 5px 10px;
      border-radius: 5px;
      float: right;
      cursor: pointer;
    }

    .click-copy:hover {
      text-decoration: underline;
      cursor: pointer;
    }
  </style>
</head>
<body>

<?php include("includes/header1.php"); ?>

<main class="dashboard-main">
  <h2>Contact Messages</h2>
  <p><a href="admin_contacts_read.php">&rarr; View Read Messages</a></p>

  <table>
    <thead>
      <tr>
        <th>SN</th>
        <th>Name</th>
        <th>Email</th>
        <th>Message</th>
        <th>Submitted</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM contact_messages WHERE is_read = 0 ORDER BY submitted_at DESC";
      $result = $conn->query($sql);
      $sn = 1;

      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row['id'];
          $name = htmlspecialchars($row['name']);
          $email = htmlspecialchars($row['email']);
          $message = nl2br(htmlspecialchars($row['message']));
          $plainMessage = strip_tags($message);
          $submitted = htmlspecialchars($row['submitted_at']);
          $shortMsg = substr($plainMessage, 0, 40);
          $isTruncated = strlen($plainMessage) > 40;

          $displayMsg = $isTruncated ? "$shortMsg..." : $shortMsg;
          $seeMoreSpan = "<span class='see-more-inline' onclick=\"showModal('$name', '$email', '$submitted', `" . addslashes($message) . "`)\" title='View full message'>See More</span>";

          echo "<tr id='row-$id'>";
          echo "<td>$sn</td>";
          echo "<td>$name</td>";
          echo "<td>$email</td>";
          echo "<td>$displayMsg $seeMoreSpan</td>";
          echo "<td>$submitted</td>";
          echo "<td><button class='mark-read-btn' data-id='$id'>Mark as Read</button></td>";
          echo "</tr>";
          $sn++;
        }
      } else {
        echo "<tr><td colspan='6' style='text-align:center;'>No unread messages found.</td></tr>";
      }
      ?>
    </tbody>
  </table>
</main>

<footer style="text-align:center; padding: 20px;">
  <p>&copy; <?php echo date("Y"); ?> EasyPeacy Cleaning Services</p>
</footer>

<!-- Modal -->
<div class="modal-overlay" id="modalOverlay">
  <div class="modal-box">
    <button class="close-modal" onclick="closeModal()">X</button>
    <h3 id="modalName"></h3>
    <p><strong>Email:</strong> <span id="modalEmail" class="click-copy" title="Click to copy"></span></p>
    <p><strong>Submitted:</strong> <span id="modalSubmitted"></span></p>
    <p><strong>Message:</strong></p>
    <p id="modalMessage"></p>
  </div>
</div>

<script>
function showModal(name, email, submitted, message) {
  document.getElementById('modalName').textContent = name;
  const emailElem = document.getElementById('modalEmail');
  emailElem.textContent = email;
  emailElem.onclick = () => {
    navigator.clipboard.writeText(email).then(() => alert('Email copied to clipboard'));
  };
  document.getElementById('modalSubmitted').textContent = submitted;
  document.getElementById('modalMessage').innerHTML = message;
  document.getElementById('modalOverlay').style.display = 'flex';
}

function closeModal() {
  document.getElementById('modalOverlay').style.display = 'none';
}

document.querySelectorAll('.mark-read-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    const id = btn.dataset.id;
    fetch('mark_contact_read.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: 'id=' + encodeURIComponent(id)
    })
    .then(res => res.text())
    .then(response => {
      if (response.trim() === 'success') {
        document.getElementById('row-' + id).style.display = 'none';
      } else {
        alert("Failed to mark as read.");
      }
    });
  });
});
</script>

</body>
</html>
