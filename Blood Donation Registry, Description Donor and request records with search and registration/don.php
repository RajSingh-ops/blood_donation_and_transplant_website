<?php
$conn = new mysqli("localhost", "root", "", "blddonation");

$name    = isset($_POST["name"]) ? $_POST["name"] : '';
$state   = isset($_POST["state"]) ? $_POST["state"] : '';
$city    = isset($_POST["city"]) ? $_POST["city"] : '';
$pin     = isset($_POST["pin"]) ? $_POST["pin"] : '';
$address = isset($_POST["address"]) ? $_POST["address"] : '';
$phone   = isset($_POST["phone"]) ? $_POST["phone"] : '';
$Gender  = isset($_POST["Gender"]) ? $_POST["Gender"] : '';


$sql = "INSERT INTO blooddonor (name, state, city, pin, address, phone, Gender) 
        VALUES ('$name', '$state', '$city', '$pin', '$address', '$phone', '$Gender')";

if ($conn->query($sql) === TRUE) {
    echo "<div style='
        font-family: Arial, sans-serif;
        background: #e6ffed;
        padding: 20px;
        margin: 50px auto;
        width: 400px;
        border: 2px solid #28a745;
        border-radius: 10px;
        text-align: center;
    '>
        <h2 style='color: #28a745;'>✅ Registration Successful!</h2>
        <p>Thank you, <b>$name</b>, for registering as a blood donor.</p>
        <p>We’ll keep your information safe and use it when needed.</p>
        <a href='index.html' style='
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        '>Go Back</a>
    </div>";
} else {
    echo "<div style='
        font-family: Arial, sans-serif;
        background: #ffdddd;
        padding: 20px;
        margin: 50px auto;
        width: 400px;
        border: 2px solid red;
        border-radius: 10px;
        text-align: center;
    '>
        <h2 style='color: red;'>❌ Error</h2>
        <p>" . $conn->error . "</p>
        <a href='index.html' style='
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background: red;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        '>Try Again</a>
    </div>";
}

$conn->close();
?>

