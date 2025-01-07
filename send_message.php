<?php
session_start();
include 'db_connection.php'; // Inclua seu arquivo de conexão com o banco de dados

// Verifique se as variáveis de sessão estão definidas
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

// Verifique se as variáveis POST estão definidas
if (!isset($_POST['department']) || !isset($_POST['message'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid input']);
    exit;
}

$sender_id = $_SESSION['user_id'];
$department_id = $_POST['department'];
$content = $_POST['message'];

// Valide a entrada
if (empty($department_id) || empty($content)) {
    echo json_encode(['status' => 'error', 'message' => 'Department and message content cannot be empty']);
    exit;
}

// Prepare e execute a declaração SQL para inserir a mensagem
$sql = "INSERT INTO messages (sender_id, department_id, content) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo json_encode(['status' => 'error', 'message' => 'SQL statement preparation failed: ' . $conn->error]);
    exit;
}

$stmt->bind_param("iis", $sender_id, $department_id, $content);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Error sending message: ' . $stmt->error]);
}

$stmt->close();
$conn->close();
?>