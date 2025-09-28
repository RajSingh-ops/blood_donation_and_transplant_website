<?php
// --- DATABASE CONNECTION ---
$servername = "localhost"; $username = "root"; $password = ""; $dbname = "blddonation";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) { die("Connection failed: " . $conn->connect_error); }

// --- SEARCH LOGIC (photo_path removed) ---
$results = [];
if (isset($_GET['btype']) && isset($_GET['city'])) {
    $btype = $_GET['btype'];
    $city = $_GET['city'];
    $stmt = $conn->prepare("SELECT name, btype, phone, city FROM blooddonor WHERE btype = ? AND city = ?");
    $stmt->bind_param("ss", $btype, $city);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) { $results[] = $row; }
    }
    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="data-section">
        <h2>Search Results</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Blood Type</th>
                    <th>City</th>
                    <th>Contact</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($results)): ?>
                    <?php foreach ($results as $donor): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($donor['name']); ?></td>
                            <td><?php echo htmlspecialchars($donor['btype']); ?></td>
                            <td><?php echo htmlspecialchars($donor['city']); ?></td>
                            <td><?php echo htmlspecialchars($donor['phone']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">No donors found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>