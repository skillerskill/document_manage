<?php
session_start();
//header('Content-Type: application/json');

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "document_manage";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die(json_encode(array("status" => "error", "message" => "Connection failed: " . $conn->connect_error)));
}

// Obtém o ID do usuário da requisição
$userId = isset($_GET['userId']) ? intval($_GET['userId']) : 0;

// Verifica se o ID do usuário é válido
if ($userId <= 0) {
    echo json_encode(array("status" => "error", "message" => "Invalid user ID."));
    exit();
}

// Prepara a consulta SQL para obter os dados do usuário
$sql = "SELECT id, username, role, function, department, registration_date FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o usuário foi encontrado
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    // Retorna os dados do usuário como JSON
    echo json_encode(array("status" => "success", "user" => $user));
} else {
    // Retorna um erro se o usuário não for encontrado
    echo json_encode(array("status" => "error", "message" => "User not found."));
}

// Fecha a conexão com o banco de dados
$stmt->close();
$conn->close();
?>