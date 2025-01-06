<?php
// Database configuration
$servername = "192.168.0.217"; // or your NAS IP
$username = "member"; // MariaDB username
$password = "WPoZlht5CfBKH_*3"; // MariaDB password
$dbname = "silverpulse_db_test"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
$mobile = $_POST['mobile'];
$year_of_birth = $_POST['year-of-birth'];
$district = $_POST['district'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO members (username, password, mobile, year_of_birth, district) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssis", $username, $password, $mobile, $year_of_birth, $district);

// Execute the statement
if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Registration successful!"]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>
