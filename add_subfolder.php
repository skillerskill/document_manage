<?php
session_start(); // Certifique-se de iniciar a sessão

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "document_manage";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifique se os dados foram enviados via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $folderId = $_POST['folderId'];
    $folderPath = $_POST['folderPath'];
    $subfolderName = $_POST['subfolderName'];
    $subfolderDescription = $_POST['subfolderDescription'];

    // Validação básica
    if (empty($folderId) || empty($subfolderName)) {
        $response = array(
            "status" => "error",
            "message" => "ID da pasta e nome da subpasta são obrigatórios."
        );
        echo json_encode($response);
        exit();
    }

    // Construa o caminho completo da subpasta
    $subfolderPath = $folderPath . '/' . $subfolderName;

    // Prepare a consulta SQL para inserir a nova subpasta
    $stmt = $conn->prepare("INSERT INTO subfolders (folder_id, name, description, path, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("isss", $folderId, $subfolderName, $subfolderDescription, $subfolderPath);

    if ($stmt->execute()) {
        $response = array(
            "status" => "success",
            "message" => "Subpasta adicionada com sucesso."
        );
    } else {
        $response = array(
            "status" => "error",
            "message" => "Erro ao adicionar subpasta: " . $stmt->error
        );
    }

    $stmt->close();
    echo json_encode($response);
} else {
    $response = array(
        "status" => "error",
        "message" => "Método de solicitação inválido."
    );
    echo json_encode($response);
}

$conn->close();
?>