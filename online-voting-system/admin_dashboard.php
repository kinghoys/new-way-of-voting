<?php
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch users and candidates
require 'config.php';
$users = [];
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

$candidates = [];
$stmt = $conn->prepare("SELECT * FROM candidates");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $candidates[] = $row;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Online Voting System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="d-flex">
        <div class="sidebar bg-dark text-white p-3">
            <h2>Admin Dashboard</h2>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#manage-users">Manage Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="#manage-candidates">Manage Candidates</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="add_candidate.php">Add Candidate</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="results.php">View Results</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="admin_logout.php">Logout</a>
                </li>
            </ul>
        </div>
        <div class="content p-4">
            <h2 id="manage-users">Manage Users</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Aadhar Number</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Verified</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['aadhar_number']; ?></td>
                        <td><?php echo $user['full_name']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['role']; ?></td>
                        <td><?php echo $user['is_verified'] ? 'Yes' : 'No'; ?></td>
                        <td>
                            <a href="verify_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-success">Verify</a>
                            <a href="delete_user.php?id=<?php echo $user['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2 id="manage-candidates">Manage Candidates</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Party</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($candidates as $candidate): ?>
                    <tr>
                        <td><?php echo $candidate['id']; ?></td>
                        <td><?php echo $candidate['name']; ?></td>
                        <td><?php echo $candidate['party']; ?></td>
                        <td>
                            <a href="edit_candidate.php?id=<?php echo $candidate['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                            <a href="delete_candidate.php?id=<?php echo $candidate['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
