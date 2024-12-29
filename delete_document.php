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

// Verifique se o ID do documento foi fornecido
if (isset($_POST['document_id'])) {
    $document_id = intval($_POST['document_id']);

    // Prepare a declaração SQL para deletar o documento
    $stmt = $conn->prepare("DELETE FROM documents WHERE id = ?");
    $stmt->bind_param("i", $document_id);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Document deleted successfully']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to delete document']);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'No document ID provided']);
}

$conn->close();
?>