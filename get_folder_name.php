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

// Get folderId from the request
$folderId = isset($_GET['folderId']) ? intval($_GET['folderId']) : 0;

if ($folderId === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid folder ID']);
    exit;
}

// Fetch folder name for the given folderId
$sql = "SELECT name FROM folders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $folderId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $folder = $result->fetch_assoc();
    echo json_encode(['status' => 'success', 'folder_name' => $folder['name']]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Folder not found']);
}

$stmt->close();
$conn->close();
?>