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

// Construa a consulta SQL para obter os departamentos
$sql = "SELECT id, name FROM departments";

$result = $conn->query($sql);

$departments = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }
}

$response = array(
    "departments" => $departments
);

echo json_encode($response);

$conn->close();
?>