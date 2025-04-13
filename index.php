<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Home</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<?php if (isset($_SESSION['user'])): ?>
  <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user']); ?>!</h2>
  <a href="logout.php">Logout</a>
<?php else: ?>
  <form method="post" action="login.php">
    <input type="text" name="username" placeholder="Username" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
  </form>
  <button><a href="register.php">Sign in</a></button>
<?php endif; ?>

</body>
</html>
