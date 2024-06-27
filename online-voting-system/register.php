<!DOCTYPE html>
<html>
<head>
    <title>Register - Online Voting System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/capture.js"></script>
</head>
<body>
    <header class="header text-center bg-primary text-white py-3">
        <h1>Register</h1>
    </header>
    <main class="main-container my-4">
        <div class="container">
            <?php if (count($errors) > 0): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <form action="register.php" method="post" class="form-horizontal">
                <div class="form-group row">
                    <label for="aadhar_number" class="col-sm-2 col-form-label">Aadhar Number:</label>
                    <div class="col-sm-10">
                        <input type="text" id="aadhar_number" name="aadhar_number" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="full_name" class="col-sm-2 col-form-label">Full Name:</label>
                    <div class="col-sm-10">
                        <input type="text" id="full_name" name="full_name" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-10">
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2">Profile Image:</div>
                    <div class="col-sm-10">
                        <div id="camera" class="mb-3"></div>
                        <button type="button" class="btn btn-primary" onclick="captureImage()">Capture Image</button>
                        <input type="hidden" id="captured_image_data" name="captured_image_data">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-10 offset-sm-2">
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </main>
    <footer class="footer bg-dark text-white text-center py-3">
        <p>&copy; 2024 Election Commission of India</p>
    </footer>
</body>
</html>
