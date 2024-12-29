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

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $departmentName = isset($_POST['departmentName']) ? $_POST['departmentName'] : '';

    // Verifique se o departamento já existe
    $checkStmt = $conn->prepare("SELECT id FROM departments WHERE name = ?");
    $checkStmt->bind_param("s", $departmentName);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Department already exists. Please choose a different name.']);
    } else {
        // Insira os dados no banco de dados
        $stmt = $conn->prepare("INSERT INTO departments (name) VALUES (?)");
        $stmt->bind_param("s", $departmentName);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Department added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add department']);
        }

        $stmt->close();
    }

    $checkStmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>