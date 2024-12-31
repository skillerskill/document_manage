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

    $query = "SELECT * FROM departments WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $departmentId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $dados = $result->fetch_assoc();
} else {
    // Trate o caso em que nenhum departamento foi encontrado
    $dados = null;
    echo "Nenhum departamento encontrado com o ID fornecido.";
}



    if ($checkStmt->num_rows > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Folder already exists. Please choose a different name.']);
    } else {
        // Crie o diretório de upload
        $uploadDir = "uploads/".$dados['name']."/$folderName";
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Insira os dados no banco de dados
        $stmt = $conn->prepare("INSERT INTO folders (name, description, department_id, path) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $folderName, $folderDescription, $departmentId, $uploadDir);

        if ($stmt->execute()) {
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