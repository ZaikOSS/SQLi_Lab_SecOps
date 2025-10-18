<?php
session_start();
$mysqli = new mysqli('db', 'sqli_user', 'sqli_pass', 'sqli_db');
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$message = '';

if (isset($_POST['login'])) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // INTENTIONALLY VULNERABLE (for lab): DO NOT USE IN PRODUCTION
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // store user info in session and redirect to dashboard
        $_SESSION['user'] = $row['username'];
        $_SESSION['flag'] = $row['flag']; // store for dashboard display
        header('Location: dashboard.php');
        exit;
    } else {
        $message = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login - SQLi Lab</title>
<style>
body { font-family: Arial; background-color: #f5f5f5; }
.container { width: 350px; margin: 100px auto; padding: 30px; background: #fff; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.2);}
input[type=text], input[type=password] { width: 100%; padding: 10px; margin: 8px 0; border-radius: 4px; border: 1px solid #ccc; }
input[type=submit] { width: 100%; padding: 10px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
input[type=submit]:hover { background-color: #0056b3; }
.message { margin-top: 15px; color: red; }
.footer { text-align: center; margin-top: 20px; font-size: 0.9em; color: #555; }
.header { text-align: center; margin-bottom: 12px; font-weight: bold; }
</style>
</head>
<body>
<div class="container">
    <div class="header">SecOps Club</div>
    <h2>Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" name="login" value="Login">
    </form>
    <?php if($message != ''): ?>
        <div class="message"><?= htmlspecialchars($message, ENT_QUOTES) ?></div>
    <?php endif; ?>
</div>
<div class="footer">Made by Zaikos – SecOps Club</div>
</body>
</html>
