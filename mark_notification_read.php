<?php
session_start();
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "document_manage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "message" => "Connection failed: " . $conn->connect_error)));
}

$notification_id = isset($_POST['notification_id']) ? intval($_POST['notification_id']) : 0;

if ($notification_id <= 0) {
    echo json_encode(array("status" => "error", "message" => "Invalid notification ID."));
    exit();
}

$sql = "UPDATE notifications SET is_read = TRUE WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $notification_id);

if ($stmt->execute()) {
    echo json_encode(array("status" => "success", "message" => "Notification marked as read."));
} else {
    echo json_encode(array("status" => "error", "message" => "Error marking notification as read: " . $stmt->error));
}

$stmt->close();
$conn->close();
?>