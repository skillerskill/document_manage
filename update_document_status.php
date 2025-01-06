<?php
session_start();

// Verifique se o usuário está logado e tem permissão para atualizar o status do documento
if (!isset($_SESSION['username']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo json_encode(['status' => 'error', 'message' => 'Acesso negado']);
    exit;
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "document_manage";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Falha na conexão com o banco de dados: ' . $conn->connect_error]));
}

// Obtenha os dados da requisição
$documentId = isset($_POST['documentId']) ? intval($_POST['documentId']) : 0;
$status = isset($_POST['status']) ? $_POST['status'] : '';

if ($documentId === 0 || $status === '') {
    echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
    exit;
}

// Atualize o status do documento
$sql = "UPDATE documents SET status = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $status, $documentId);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Status do documento atualizado com sucesso']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar status do documento: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>