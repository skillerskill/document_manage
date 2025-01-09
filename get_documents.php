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

// Obtenha os filtros da requisição
$searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';
$filterDepartment = isset($_GET['filterDepartment']) ? $_GET['filterDepartment'] : '';
$filterFolder = isset($_GET['filterFolder']) ? $_GET['filterFolder'] : '';
$filterSubfolder = isset($_GET['filterSubfolder']) ? $_GET['filterSubfolder'] : '';
$resultsPerPage = isset($_GET['resultsPerPage']) ? intval($_GET['resultsPerPage']) : 10;

// Dados do usuário logado
$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : 'user';
$userDepartment = isset($_SESSION['user_department']) ? $_SESSION['user_department'] : '';
$userName = isset($_SESSION['username']) ? $_SESSION['username'] : 'Usuário';

// Construa a consulta SQL com os filtros
$sql = "SELECT documents.id, documents.name, documents.description, documents.upload_time, documents.status, 
               users.username AS uploaded_by, departments.name AS department, documents.file_path 
        FROM documents 
        JOIN users ON documents.user_id = users.id 
        JOIN departments ON documents.department_id = departments.id 
        WHERE 1=1";

// Adicione os filtros opcionais
if ($searchName != '') {
    $sql .= " AND documents.name LIKE '%" . $conn->real_escape_string($searchName) . "%'";
}
if ($filterDepartment != '') {
    $sql .= " AND departments.name = '" . $conn->real_escape_string($filterDepartment) . "'";
}
if ($filterFolder != '') {
    $sql .= " AND documents.folder = '" . $conn->real_escape_string($filterFolder) . "'";
}
if ($filterSubfolder != '') {
    $sql .= " AND documents.subfolder = '" . $conn->real_escape_string($filterSubfolder) . "'";
}

// Adicione a restrição para usuários normais
if ($userRole === 'user' && !empty($userDepartment)) {
    $sql .= " AND departments.name = '" . $conn->real_escape_string($userDepartment) . "'";
}

$sql .= " LIMIT " . $resultsPerPage;

$result = $conn->query($sql);

$documents = array();
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $documents[] = $row;
    }
} else {
    error_log("No documents found: " . $conn->error);
}

// Contagem de documentos
$sql = "SELECT COUNT(*) AS documentCount FROM documents";
$documentResult = $conn->query($sql);
$documentCount = $documentResult->fetch_assoc()['documentCount'];

// Contagem de departamentos
$sql = "SELECT COUNT(*) AS departmentCount FROM departments";
$departmentResult = $conn->query($sql);
$departmentCount = $departmentResult->fetch_assoc()['departmentCount'];

// Contagem de pastas usando a tabela folders
$sql = "SELECT COUNT(*) AS folderCount FROM folders";
$folderResult = $conn->query($sql);
$folderCount = $folderResult->fetch_assoc()['folderCount'];

// Contagem de subpastas
$sql = "SELECT COUNT(DISTINCT subfolder) AS subfolderCount FROM documents";
$subfolderResult = $conn->query($sql);
$subfolderCount = $subfolderResult->fetch_assoc()['subfolderCount'];

// Contagem de usuários
$sql = "SELECT COUNT(*) AS userCount FROM users";
$userResult = $conn->query($sql);
$userCount = $userResult->fetch_assoc()['userCount'];

// Monte a resposta
$response = array(
    "documents" => $documents,
    "documentCount" => $documentCount,
    "departmentCount" => $departmentCount,
    "folderCount" => $folderCount,
    "subfolderCount" => $subfolderCount,
    "userCount" => $userCount,
    "userRole" => $userRole,
    "userName" => $userName
);

// Envie a resposta como JSON
echo json_encode($response);

$conn->close();
?>
