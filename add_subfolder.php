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

    // Crie a subpasta no sistema de arquivos
    if (!file_exists($subfolderPath)) {
        if (!mkdir($subfolderPath, 0777, true)) {
            $response = array(
                "status" => "error",
                "message" => "Erro ao criar subpasta no sistema de arquivos."
            );
            echo json_encode($response);
            exit();
        }
    } else {
        $response = array(
            "status" => "error",
            "message" => "A subpasta já existe no sistema de arquivos."
        );
        echo json_encode($response);
        exit();
    }

    // Prepare a consulta SQL para inserir a nova subpasta
    $stmt = $conn->prepare("INSERT INTO subfolders (name, description, folder_id, created_at, path) VALUES (?, ?, ?, NOW(), ?)");
    $stmt->bind_param("ssis", $subfolderName, $subfolderDescription, $folderId, $subfolderPath);

    if ($stmt->execute()) {
        $response = array(
            "status" => "success",
            "message" => "Subpasta adicionada com sucesso."
        );
    } else {
        // Remova a subpasta do sistema de arquivos se a inserção no banco de dados falhar
        rmdir($subfolderPath);
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