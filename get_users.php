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

// Obtém os filtros da requisição
$searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';
$filterDepartment = isset($_GET['filterDepartment']) ? $_GET['filterDepartment'] : '';

// Prepara a consulta SQL para obter todos os dados dos usuários
$sql = "SELECT id, username, role, function, department, registration_date FROM users WHERE 1=1";

if (!empty($searchName)) {
    $sql .= " AND username LIKE '%" . $conn->real_escape_string($searchName) . "%'";
}

if (!empty($filterDepartment)) {
    $sql .= " AND department = '" . $conn->real_escape_string($filterDepartment) . "'";
}

$result = $conn->query($sql);

// Verifica se há usuários
if ($result->num_rows > 0) {
    $users = [];
    // Converte os dados dos usuários em um array associativo
    while($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
    // Retorna os dados dos usuários como JSON
    echo json_encode(array("status" => "success", "users" => $users));
} else {
    // Retorna um array vazio se não houver usuários
    echo json_encode(array("status" => "success", "users" => []));
}

// Fecha a conexão com o banco de dados
$conn->close();
?>