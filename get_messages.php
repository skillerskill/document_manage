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
    die("Connection failed: " . $conn->connect_error);
}

// Obtenha o ID do departamento do usuário
$sq = "SELECT id FROM departments WHERE name = '$user_department'";
$sq2 = mysqli_query($conn, $sq);
$pegar = mysqli_fetch_assoc($sq2);
$idd = $pegar["id"];

if ($user_role == 'admin') {
    // Admin pode ver todas as mensagens
    $sql = "SELECT messages.*, users.username AS sender_name 
            FROM messages 
            JOIN users ON messages.sender_id = users.id 
            ORDER BY messages.timestamp DESC";
} else {
    // Usuários comuns podem ver mensagens enviadas para o departamento deles ou por eles mesmos
    $sql = "SELECT messages.*, users.username AS sender_name 
            FROM messages 
            JOIN users ON messages.sender_id = users.id 
            WHERE messages.department_id = '$idd' OR messages.sender_id = '$user_id'
            ORDER BY messages.timestamp DESC";
}

$result = $conn->query($sql);

$messages = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $messages[] = $row;
    }
}

echo json_encode(['messages' => $messages]);

$conn->close();
?>