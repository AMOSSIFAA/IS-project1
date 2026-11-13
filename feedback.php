<?php
include "config.php";
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $text = $_POST["message"];
    $stmt = mysqli_prepare($conn, "INSERT INTO feedback (name, message) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $name, $text);
    if (mysqli_stmt_execute($stmt)) {
        $message = "Thank you! Your feedback was saved.";
    } else {
        $message = "Could not save feedback: " . mysqli_error($conn);
    }
}
$result = mysqli_query($conn, "SELECT name, message, created_at FROM feedback ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head><title>Feedback</title></head>
<body>
<h2>Send us your feedback</h2>
<p><?php echo $message; ?></p>
<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Message:<br>
    <textarea name="message" rows="4" cols="40" required></textarea><br><br>
    <button type="submit">Submit</button>
</form>
<h3>Feedback received</h3>
<table border="1" cellpadding="6">
    <tr><th>Name</th><th>Message</th><th>Date</th></tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
        <td><?php echo htmlspecialchars($row["name"]); ?></td>
        <td><?php echo htmlspecialchars($row["message"]); ?></td>
        <td><?php echo $row["created_at"]; ?></td>
    </tr>
    <?php } ?>
</table>
<p><a href="login.php">Back to login</a></p>
</body>
</html>
