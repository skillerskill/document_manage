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
    $subfolder_id = isset($_POST['subfolderId']) ? intval($_POST['subfolderId']) : 0;

    // Validação básica
    if (empty($name) || empty($subfolder_id)) {
        echo json_encode(['status' => 'error', 'message' => 'Nome do documento e ID da subpasta são obrigatórios.']);
        exit();
    }

    // Obtenha o caminho da subpasta, da pasta principal e o department_id
    $stmt = $conn->prepare("SELECT subfolders.path AS subfolder_path, folders.path AS folder_path, folders.department_id AS department_id FROM subfolders JOIN folders ON subfolders.folder_id = folders.id WHERE subfolders.id = ?");
    $stmt->bind_param("i", $subfolder_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $paths = $result->fetch_assoc();
    $stmt->close();

    if (!$paths) {
        echo json_encode(['status' => 'error', 'message' => 'Subpasta não encontrada.']);
        exit();
    }

    $folder_path = $paths['folder_path'];
    $subfolder_path = $paths['subfolder_path'];
    $department_id = $paths['department_id'];

    // Verifique se um arquivo foi enviado
    if (isset($_FILES['floatingFile']) && $_FILES['floatingFile']['error'] == 0) {
        $file = $_FILES['floatingFile'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];
        $file_path = $subfolder_path . '/' . $file_name;

        // Verifique se os diretórios existem, caso contrário, crie-os
        if (!file_exists($subfolder_path)) {
            mkdir($subfolder_path, 0777, true);
        }

        // Mova o arquivo para o diretório de uploads
        if (move_uploaded_file($file_tmp, $file_path)) {
            // Insira os dados no banco de dados
            $stmt = $conn->prepare("INSERT INTO documents (name, description, user_id, department_id, folder, subfolder, file_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssissss", $name, $description, $user_id, $department_id, $folder_path, $subfolder_path, $file_path);

            if ($stmt->execute()) {
                // Adicionar notificação
                $notification_message = "Novo documento adicionado: " . $name;
                $stmt = $conn->prepare("INSERT INTO notifications (user_id, message) VALUES (?, ?)");
                $stmt->bind_param("is", $user_id, $notification_message);
                $stmt->execute();

                echo json_encode(['status' => 'success', 'message' => 'Documento e notificação adicionados com sucesso']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Falha ao adicionar documento: ' . $stmt->error]);
            }

            $stmt->close();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Falha ao fazer upload do arquivo']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Nenhum arquivo enviado ou erro no upload do arquivo']);
    }
}

$conn->close();
?>