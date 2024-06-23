<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $aadhar_number = $_POST['aadhar_number'];
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $profile_image = $_FILES['profile_image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($profile_image);
    move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_file);

    $stmt = $conn->prepare("INSERT INTO users (aadhar_number, full_name, email, password_hash, profile_image) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $aadhar_number, $full_name, $email, $password, $target_file);

    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Online Voting System</title>
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <script src="assets/js/capture.js"></script>
</head>
<body>
    <header>
        <h1>Register</h1>
    </header>
    <main>
        <form action="register.php" method="post" enctype="multipart/form-data">
            <label for="aadhar_number">Aadhar Number:</label>
            <input type="text" id="aadhar_number" name="aadhar_number" required><br>
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>
            <label for="profile_image">Profile Image:</label>
            <input type="file" id="profile_image" name="profile_image" required><br>
            <div id="camera"></div>
            <button type="button" onclick="captureImage()">Capture Image</button><br>
            <input type="hidden" id="captured_image_data" name="captured_image_data">
            <button type="submit">Register</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Election Commission of India</p>
    </footer>
</body>
</html>
