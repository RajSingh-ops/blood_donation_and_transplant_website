<?php
// --- DATABASE CONNECTION ---
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blddonation";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- FETCH DONOR DATA ---
$donors = [];
$donor_sql = "SELECT id, name, state, city, phone, Gender, reg_date FROM blooddonor ORDER BY reg_date DESC";
$donor_result = $conn->query($donor_sql);
if ($donor_result->num_rows > 0) {
    while($row = $donor_result->fetch_assoc()) {
        $donors[] = $row;
    }
}

// --- FETCH RECIPIENT (REQUEST) DATA ---
$requests = [];
$request_sql = "SELECT id, full_name, blood_group, hospital_name, location_city, contact_number, quantity, request_date FROM blood_requests ORDER BY request_date DESC";
$request_result = $conn->query($request_sql);
if ($request_result->num_rows > 0) {
    while($row = $request_result->fetch_assoc()) {
        $requests[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css"> </head>
<body>

    <header>
        <h1>Admin Dashboard</h1>
        <p>Blood Donation & Requests Overview</p>
    </header>

    <main>
        <section class="data-section">
            <h2>🩸 Registered Donors</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Registered On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($donors)): ?>
                            <?php foreach ($donors as $donor): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($donor['id']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['name']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['Gender']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['phone']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['city']); ?></td>
                                    <td><?php echo htmlspecialchars($donor['state']); ?></td>
                                    <td><?php echo date("d-M-Y", strtotime($donor['reg_date'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">No donors registered yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>

        <section class="data-section">
            <h2>🏥 Blood Requests (Recipients)</h2>
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Blood Group</th>
                            <th>Quantity (units)</th>
                            <th>Hospital</th>
                            <th>City</th>
                            <th>Contact</th>
                            <th>Requested On</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($requests)): ?>
                            <?php foreach ($requests as $request): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($request['id']); ?></td>
                                    <td><?php echo htmlspecialchars($request['full_name']); ?></td>
                                    <td><?php echo htmlspecialchars($request['blood_group']); ?></td>
                                    <td><?php echo htmlspecialchars($request['quantity']); ?></td>
                                    <td><?php echo htmlspecialchars($request['hospital_name']); ?></td>
                                    <td><?php echo htmlspecialchars($request['location_city']); ?></td>
                                    <td><?php echo htmlspecialchars($request['contact_number']); ?></td>
                                    <td><?php echo date("d-M-Y", strtotime($request['request_date'])); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="8">No blood requests made yet.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

</body>
</html>