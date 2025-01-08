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
$department_id = $_SESSION['user_department'];

// Consulta para contar o número de novas mensagens não lidas para o departamento do usuário
$sql = "SELECT COUNT(*) as new_messages FROM messages WHERE department_id = ? AND is_read = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $department_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$new_messages = $row['new_messages'];

$stmt->close();
$conn->close();

echo json_encode(['status' => 'success', 'new_messages' => $new_messages]);
?>