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
    $name = isset($_POST['floatingName']) ? $_POST['floatingName'] : '';
    $description = isset($_POST['floatingDescription']) ? $_POST['floatingDescription'] : '';
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 1; // Substitua pelo ID do usuário logado
    $department_id = isset($_POST['floatingDepartment']) ? $_POST['floatingDepartment'] : 1; // Substitua pelo ID do departamento selecionado
    $folder = isset($_POST['floatingSelectFolder']) ? $_POST['floatingSelectFolder'] : '';
    $subfolder = isset($_POST['floatingSelectSubfolder']) ? $_POST['floatingSelectSubfolder'] : '';

    // Verifique se um arquivo foi enviado
    if (isset($_FILES['floatingFile']) && $_FILES['floatingFile']['error'] == 0) {
        $file = $_FILES['floatingFile'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_path = $folder.'/'.$subfolder. '/' . $file_name;

        // Verifique se os diretórios existem, caso contrário, crie-os
        

        // Mova o arquivo para o diretório de uploads
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Insira os dados no banco de dados
            $stmt = $conn->prepare("INSERT INTO documents (name, description, user_id, department_id, folder, subfolder, file_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssissss", $name, $description, $user_id, $department_id, $folder, $subfolder, $file_path);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success', 'message' => 'Document added successfully']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to add document: ' . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to upload file']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No file uploaded or file upload error']);
    }
}

$conn->close();
?>