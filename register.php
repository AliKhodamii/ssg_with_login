<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Check if username already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $existing = $stmt->fetch();

    if ($existing) {
        echo "❌ Username already taken!";
    } else {
        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert into database
        $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        if ($stmt->execute([$username, $hashedPassword])) {
            echo "✅ Registered successfully! <a href='index.php'>Login now</a>";
        } else {
            echo "❌ Something went wrong.";
        }
    }
}
?>

<!-- Registration Form -->
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
</head>
<body>
<h2>Register</h2>
<form method="post" action="register.php">
  <input type="text" name="username" placeholder="Username" required><br>
  <input type="password" name="password" placeholder="Password" required><br>
  <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="index.php">Log in</a></p>
</body>
</html>
