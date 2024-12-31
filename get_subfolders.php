<?php
session_start(); // Certifique-se de iniciar a sessão

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "document_manage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Defina o cabeçalho de resposta como JSON
//header('Content-Type: application/json');

// Query para obter todas as subpastas
$sql = "SELECT subfolders.id, subfolders.name, subfolders.description, subfolders.folder_id, subfolders.created_at, folders.name as folder_name 
        FROM subfolders 
        JOIN folders ON subfolders.folder_id = folders.id";
$result = $conn->query($sql);

$subfolders = [];

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $subfolders[] = $row;
    }
}

echo json_encode(['subfolders' => $subfolders]);

$conn->close();
?>