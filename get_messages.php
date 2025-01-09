<?php
session_start();
include 'db_connection.php'; // Inclua seu arquivo de conexão com o banco de dados

// Verifique se as variáveis de sessão estão definidas
if (!isset($_SESSION['user_id']) || !isset($_SESSION['role']) || !isset($_SESSION['user_department'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in or session variables not set']);
    exit;
}

$user_id = $_SESSION['user_id'];
$user_role = $_SESSION['role'];
$user_department = $_SESSION['user_department'];

// Verifique se a conexão com o banco de dados foi estabelecida
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Obtenha o ID do departamento do usuário
$sq = "SELECT id FROM departments WHERE name = ?";
$stmt = $conn->prepare($sq);
$stmt->bind_param("s", $user_department);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $pegar = $result->fetch_assoc();
    $idd = $pegar["id"];
} else {
    echo json_encode(['status' => 'error', 'message' => 'Department not found']);
    exit;
}

$stmt->close();

if ($user_role == 'admin') {
    // Admin pode ver todas as mensagens
    $sql = "SELECT messages.*, users.username AS sender_name 
            FROM messages 
            JOIN users ON messages.sender_id = users.id 
            ORDER BY messages.created_at DESC";
} else {
    // Usuários comuns podem ver mensagens enviadas para o departamento deles ou por eles mesmos
    $sql = "SELECT messages.*, users.username AS sender_name 
            FROM messages 
            JOIN users ON messages.sender_id = users.id 
            WHERE messages.department_id = ? OR messages.sender_id = ?
            ORDER BY messages.created_at DESC";
}

$stmt = $conn->prepare($sql);

if ($user_role == 'admin') {
    $stmt->execute();
} else {
    $stmt->bind_param("ii", $idd, $user_id);
    $stmt->execute();
}

$result = $stmt->get_result();

$messages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

echo json_encode(['status' => 'success', 'messages' => $messages]);

$stmt->close();
$conn->close();
?>