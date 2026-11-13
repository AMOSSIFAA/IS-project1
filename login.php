<?php
include "config.php";
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $stmt = mysqli_prepare($conn, "SELECT password FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hash);
    if (mysqli_stmt_fetch($stmt) && password_verify($_POST["password"], $hash)) {
        $message = "Login successful. Welcome, " . htmlspecialchars($username) . "!";
    } else {
        $message = "Wrong username or password.";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
<h2>Login</h2>
<p><?php echo $message; ?></p>
<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Log In</button>
</form>
<p>No account yet? <a href="signup.php">Sign up</a></p>
</body>
</html>
