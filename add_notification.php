<?php
session_start();
//header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "document_manage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "message" => "Connection failed: " . $conn->connect_error)));
}

$user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
$message = isset($_POST['message']) ? $_POST['message'] : '';

if ($user_id <= 0 || empty($message)) {
    echo json_encode(array("status" => "error", "message" => "Invalid input."));
    exit();
}

$sql = "INSERT INTO notifications (user_id, message) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("is", $user_id, $message);

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Notification added successfully."));
} else {
    echo json_encode(array("status" => "error", "message" => "Error adding notification: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>