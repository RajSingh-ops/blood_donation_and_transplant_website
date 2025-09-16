<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "blddonation";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$name = $_POST['name'];
$blood_group = $_POST['blood_group'];
$hospital = $_POST['hospital'];
$location = $_POST['location'];
$contact = $_POST['contact'];
$message = $_POST['message'];
$quantity = $_POST['qt'];

// Prepare and bind the SQL statement to prevent SQL injection
$stmt = $conn->prepare("INSERT INTO blood_requests (full_name, blood_group, hospital_name, location_city, contact_number, message, quantity) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssi", $name, $blood_group, $hospital, $location, $contact, $message, $quantity);

// Execute the statement and provide feedback
if ($stmt->execute()) {
    echo "<div style='font-family: Arial, sans-serif; background: #e6ffed; padding: 20px; margin: 50px auto; width: 400px; border: 2px solid #28a745; border-radius: 10px; text-align: center;'>
            <h2 style='color: #28a745;'>✅ Request Submitted Successfully!</h2>
            <p>Thank you, <b>$name</b>. Your request for blood has been recorded.</p>
            <p>We will do our best to find a match for you.</p>
            <a href='index.html' style='display: inline-block; margin-top: 15px; padding: 10px 20px; background: #28a745; color: white; text-decoration: none; border-radius: 5px;'>Go Back</a>
          </div>";
} else {
    echo "<div style='font-family: Arial, sans-serif; background: #ffdddd; padding: 20px; margin: 50px auto; width: 400px; border: 2px solid red; border-radius: 10px; text-align: center;'>
            <h2 style='color: red;'>❌ Error</h2>
            <p>There was an error submitting your request: " . $stmt->error . "</p>
            <a href='transplant.html' style='display: inline-block; margin-top: 15px; padding: 10px 20px; background: red; color: white; text-decoration: none; border-radius: 5px;'>Try Again</a>
          </div>";
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>