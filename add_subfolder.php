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

// Verifique se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $folderId = isset($_POST['folderId']) ? intval($_POST['folderId']) : 0;
    $subfolderName = isset($_POST['subfolderName']) ? $_POST['subfolderName'] : '';
    $subfolderDescription = isset($_POST['subfolderDescription']) ? $_POST['subfolderDescription'] : '';

    // Verifique se a subpasta já existe na mesma pasta
    $checkStmt = $conn->prepare("SELECT id FROM subfolders WHERE name = ? AND folder_id = ?");
    $checkStmt->bind_param("si", $subfolderName, $folderId);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Subfolder already exists in this folder. Please choose a different name.']);
    } else {
        // Insira os dados no banco de dados
        $stmt = $conn->prepare("INSERT INTO subfolders (name, description, folder_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $subfolderName, $subfolderDescription, $folderId);

        if ($stmt->execute()) {
            // Crie o diretório de upload
            $subfolderId = $stmt->insert_id;
            $uploadDir = "uploads/folder_$folderId/$subfolderName";
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            echo json_encode(['status' => 'success', 'message' => 'Subfolder added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add subfolder']);
        }

        $stmt->close();
    }

    $checkStmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>