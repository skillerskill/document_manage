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
    $departmentId = isset($_POST['departmentId']) ? intval($_POST['departmentId']) : 0;
    $departmentName = isset($_POST['departmentName']) ? $_POST['departmentName'] : '';

    // Verifique se o novo nome do departamento já existe
    $checkStmt = $conn->prepare("SELECT id FROM departments WHERE name = ? AND id != ?");
    $checkStmt->bind_param("si", $departmentName, $departmentId);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Department name already exists. Please choose a different name.']);
    } else {
        // Atualize os dados no banco de dados
        $stmt = $conn->prepare("UPDATE departments SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $departmentName, $departmentId);

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Department updated successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to update department']);
        }

        $stmt->close();
    }

    $checkStmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>