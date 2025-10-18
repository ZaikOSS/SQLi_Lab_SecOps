<?php
session_start();
// Require login
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

// Use htmlspecialchars when printing DB values
$user = htmlspecialchars($_SESSION['user'], ENT_QUOTES);
$flag = htmlspecialchars($_SESSION['flag'] ?? 'No flag available', ENT_QUOTES);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Dashboard - SQLi Lab</title>
<style>
body { font-family: Arial; background:#f5f5f5; }
.wrap { width: 700px; margin: 60px auto; padding: 20px; background:#fff; border-radius:10px; box-shadow:0 0 8px rgba(0,0,0,0.12); }
.header { display:flex; justify-content:space-between; align-items:center; }
.btn { background:#007bff; color:#fff; padding:8px 12px; border-radius:6px; text-decoration:none; }
.flag { margin-top:20px; padding:15px; background:#f0f8ff; border-left:4px solid #007bff; font-weight:bold; }
</style>
</head>
<body>
<div class="wrap">
  <div class="header">
    <div><strong>Zaikos - SecOps Club</strong><div style="font-size:0.9em;color:#666">SQLi Lab Dashboard</div></div>
    <div><a class="btn" href="logout.php">Logout</a></div>
  </div>

  <h2>Welcome, <?= $user ?></h2>

  <p>This is your protected dashboard. Only logged-in users can see this page.</p>

  <div class="flag">Your flag: <?= $flag ?></div>

  <hr>
  <p style="color:#666;font-size:0.9em">Note: This lab intentionally uses an insecure login to demonstrate SQL Injection. Do not use this code in production.</p>
</div>
</body>
</html>
