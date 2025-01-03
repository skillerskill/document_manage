<?php
session_start();
//header('Content-Type: application/json');

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "document_manage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Get subfolderId from the request
$subfolderId = isset($_GET['subfolderId']) ? intval($_GET['subfolderId']) : 0;

if ($subfolderId === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid subfolder ID']);
    exit;
}

// Fetch subfolder name for the given subfolderId
$sql = "SELECT name FROM subfolders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $subfolderId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $subfolder = $result->fetch_assoc();
    echo json_encode(['status' => 'success', 'subfolder_name' => $subfolder['name']]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Subfolder not found']);
}

$stmt->close();
$conn->close();
?>