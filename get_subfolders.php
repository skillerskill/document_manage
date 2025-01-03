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

// Get folder_id from the request
$folder_id = isset($_GET['folderId']) ? intval($_GET['folderId']) : 0;

if ($folder_id === 0) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid folder ID']);
    exit;
}

// Fetch subfolders for the given folder_id
$sql = "SELECT id, name, description, folder_id, created_at, path FROM subfolders WHERE folder_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $folder_id);
$stmt->execute();
$result = $stmt->get_result();

$subfolders = [];
while ($row = $result->fetch_assoc()) {
    // Count the number of documents in each subfolder
    $subfolder_id = $row['id'];
    $count_sql = "SELECT COUNT(*) as document_count FROM documents WHERE subfolder = ?";
    $count_stmt = $conn->prepare($count_sql);
    $count_stmt->bind_param("i", $subfolder_id);
    $count_stmt->execute();
    $count_result = $count_stmt->get_result();
    $count_row = $count_result->fetch_assoc();
    $document_count = $count_row['document_count'];

    // Add document count to the subfolder data
    $row['document_count'] = $document_count;
    $subfolders[] = $row;

    $count_stmt->close();
}

$stmt->close();
$conn->close();

echo json_encode(['status' => 'success', 'subfolders' => $subfolders]);
?>