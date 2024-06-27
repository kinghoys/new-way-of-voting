<?php
require 'config.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch voting results
$candidates = [];
$votes = [];
$stmt = $conn->prepare("SELECT candidates.name, COUNT(votes.id) AS vote_count FROM candidates LEFT JOIN votes ON candidates.id = votes.candidate_id GROUP BY candidates.id");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $candidates[] = $row['name'];
    $votes[] = $row['vote_count'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Results - Online Voting System</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <header class="header text-center bg-primary text-white py-3">
        <h1>Voting Results</h1>
    </header>
    <main class="main-container my-4">
        <div class="container">
            <canvas id="resultsChart" width="400" height="400"></canvas>
            <script>
                const ctx = document.getElementById('resultsChart').getContext('2d');
                const resultsChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: <?php echo json_encode($candidates); ?>,
                        datasets: [{
                            label: 'Votes',
                            data: <?php echo json_encode($votes); ?>,
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Election Results'
                            }
                        }
                    },
                });
            </script>
        </div>
    </main>
    <footer class="footer bg-dark text-white text-center py-3">
        <p>&copy; 2024 Election Commission of India</p>
    </footer>
</body>
</html>
