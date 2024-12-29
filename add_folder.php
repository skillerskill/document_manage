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
    $departmentId = isset($_POST['departmentId']) ? intval($_POST['departmentId']) : 0;
    $folderName = isset($_POST['folderName']) ? $_POST['folderName'] : '';
    $folderDescription = isset($_POST['folderDescription']) ? $_POST['folderDescription'] : '';

    // Verifique se a pasta já existe
    $checkStmt = $conn->prepare("SELECT id FROM folders WHERE name = ? AND department_id = ?");
    $checkStmt->bind_param("si", $folderName, $departmentId);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Folder already exists. Please choose a different name.']);
    } else {
        // Insira os dados no banco de dados
        $stmt = $conn->prepare("INSERT INTO folders (name, description, department_id) VALUES (?, ?, ?)");
        $stmt->bind_param("ssi", $folderName, $folderDescription, $departmentId);

        if ($stmt->execute()) {
            // Crie o diretório de upload
            $folderId = $stmt->insert_id;
            $uploadDir = "uploads/department_$departmentId/$folderName";
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            echo json_encode(['status' => 'success', 'message' => 'Folder added successfully']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to add folder']);
        }

        $stmt->close();
    }

    $checkStmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
$conn->close();
?>