<?php
session_start();
//header('Content-Type: application/json');

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "document_manage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
}

// ID do departamento do usuário logado
$department_id = $_SESSION['user_department_id'];

// Atualizar todas as mensagens não lidas para o departamento do usuário para lidas
$sql = "UPDATE messages SET is_read = 1 WHERE department_id = ? AND is_read = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $department_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No messages updated']);
}

$stmt->close();
$conn->close();
?>