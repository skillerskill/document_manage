
<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "document_manage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed: ' . $conn->connect_error]));
}

// Fetch all subfolders
$sql = "SELECT id, name, description, folder_id, created_at, path FROM subfolders";
$result = $conn->query($sql);

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

$conn->close();

echo json_encode(['status' => 'success', 'subfolders' => $subfolders]);
?>
