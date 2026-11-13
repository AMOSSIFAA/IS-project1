<?php
include "config.php";
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password);
    if (mysqli_stmt_execute($stmt)) {
        $message = "Signup successful. You can now log in.";
    } else {
        $message = "Signup failed: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Sign Up</title></head>
<body>
<h2>Sign Up</h2>
<p><?php echo $message; ?></p>
<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Sign Up</button>
</form>
<p>Already have an account? <a href="login.php">Log in</a></p>
</body>
</html>
