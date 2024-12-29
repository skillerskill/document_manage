<?php
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
    die("Connection failed: " . $conn->connect_error);
}

// Prepara a consulta SQL para obter todos os dados dos usuários
$sql = "SELECT id, username, role, department FROM users";
$result = $conn->query($sql);

// Verifica se há usuários
if ($result->num_rows > 0) {
    $users = [];
    // Converte os dados dos usuários em um array associativo
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    // Retorna os dados dos usuários como JSON
    echo json_encode($users);
} else {
    // Retorna um array vazio se não houver usuários
    echo json_encode([]);
}

// Fecha a conexão com o banco de dados
$conn->close();
?>