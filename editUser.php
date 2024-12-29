<?php
// Ativar a exibição de erros no PHP
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "document_manage";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Obtém o ID do usuário a partir da solicitação GET
$userId = $_GET['id'];

// Prepara a consulta SQL para obter os dados do usuário
$sql = "SELECT id, username, role, department FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o usuário foi encontrado
if ($result->num_rows > 0) {
    // Converte os dados do usuário em um array associativo
    $user = $result->fetch_assoc();
    // Retorna os dados do usuário como JSON
    echo json_encode($user);
} else {
    // Retorna um erro se o usuário não for encontrado
    echo json_encode(["error" => "User not found"]);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>