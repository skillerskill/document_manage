<?php
session_start();
include 'db_connection.php'; // Inclua seu arquivo de conexão com o banco de dados

// Verifique se as variáveis de sessão estão definidas
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || !isset($_SESSION['user_department'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in or session variables not set']);
    exit;
}

// Verifique se a conexão com o banco de dados foi estabelecida
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Admin pode ver todos os departamentos
$sql = "SELECT id, name FROM departments";
$result = $conn->query($sql);

$departments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $departments[] = $row;
    }
}

echo json_encode(['status' => 'success', 'departments' => $departments]);

$conn->close();
?>