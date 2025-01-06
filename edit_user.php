<?php
session_start();
//header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "document_manage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "message" => "Connection failed: " . $conn->connect_error)));
}

// Get the user data from the request
$userId = isset($_POST['editUserId']) ? $_POST['editUserId'] : '';
$username = isset($_POST['editUsername']) ? $_POST['editUsername'] : '';
$password = isset($_POST['editPassword']) ? $_POST['editPassword'] : '';
$role = isset($_POST['editRole']) ? $_POST['editRole'] : '';
$function = isset($_POST['editFunction']) ? $_POST['editFunction'] : '';
$department = isset($_POST['editDepartment']) ? $_POST['editDepartment'] : '';

// Validate the input
if (empty($userId) || empty($username) || empty($role) || empty($function) || empty($department)) {
    echo json_encode(array("status" => "error", "message" => "All fields are required."));
    exit();
}

// Update the user data in the database
if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE users SET username=?, password=?, role=?, function=?, department=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssi", $username, $hashedPassword, $role, $function, $department, $userId);
} else {
    $sql = "UPDATE users SET username=?, role=?, function=?, department=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $username, $role, $function, $department, $userId);
}

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "User updated successfully."));
} else {
    echo json_encode(array("status" => "error", "message" => "Error updating user: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>