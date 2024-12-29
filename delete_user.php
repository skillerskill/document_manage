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

// Obtém o ID do usuário a partir da solicitação POST
$userId = $_POST['id'];

// Prepara a consulta SQL para excluir o usuário
$sql = "DELETE FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);

// Executa a consulta e verifica se foi bem-sucedida
if ($stmt->execute()) {
    echo json_encode(["success" => "User deleted successfully"]);
} else {
    echo json_encode(["error" => "Error deleting user: " . $stmt->error]);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>