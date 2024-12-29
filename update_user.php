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

// Obtém os dados do formulário
$userId = $_POST['userId'];
$username = $_POST['username'];
$role = $_POST['role'];
$department = $_POST['userDepartment'];

// Prepara a consulta SQL para atualizar os dados do usuário
$sql = "UPDATE users SET username = ?, role = ?, department = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $username, $role, $department, $userId);

// Executa a consulta e verifica se foi bem-sucedida
if ($stmt->execute()) {
    echo json_encode(["success" => "User updated successfully"]);
} else {
    echo json_encode(["error" => "Error updating user: " . $stmt->error]);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>