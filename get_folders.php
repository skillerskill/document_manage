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

// Construa a consulta SQL para obter as pastas e os departamentos correspondentes
$sql = "SELECT folders.id, folders.name, folders.description, folders.created_at, departments.name AS department_name 
        FROM folders 
        JOIN departments ON folders.department_id = departments.id";

$result = $conn->query($sql);

$folders = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $folders[] = $row;
    }
}

$response = array(
    "folders" => $folders
);

echo json_encode($response);

$conn->close();
?>