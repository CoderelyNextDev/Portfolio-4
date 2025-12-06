<?php
if (session_status() === PHP_SESSION_NONE) { session_start(); }
require_once('functions.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | Dynamic Portfolio</title>
  <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>
  <div class="container">
    <header class="dashboard-header">
      <div class="dashboard-title">Frances Bascon | Admin Dashboard</div>
      <nav class="dashboard-nav">
        <a href="index.php">Dashboard Home</a>
        <a href="manage_skills.php">Manage Skills</a>
        <a href="manage_experience.php">Manage Experience</a>
        <a href="../index.php" target="_blank">View Live Site</a>
        <a href="logout.php" onclick="return confirm('Are you sure you want to log out?');" class="btn-delete">Logout</a>
      </nav>
    </header>

    <!-- Display any session messages -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="message <?php echo $_SESSION['message_type']; ?>">
            <?php echo $_SESSION['message']; ?>
        </div>
        <?php
        // Clear the session message after displaying
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        ?>
    <?php endif; ?>