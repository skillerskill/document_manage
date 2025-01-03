
<?php
session_start(); // Certifique-se de iniciar a sessão

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "document_manage";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verifica se há um filtro de departamento
$departmentId = isset($_GET['departmentId']) ? $_GET['departmentId'] : '';

// Consulta SQL para buscar as pastas
$sql = "SELECT folders.id, folders.name, folders.description, departments.name as department_name, COUNT(subfolders.id) as subfolders_count
        FROM folders
        LEFT JOIN departments ON folders.department_id = departments.id
        LEFT JOIN subfolders ON subfolders.folder_id = folders.id";

if ($departmentId) {
    $sql .= " WHERE folders.department_id = ?";
}

$sql .= " GROUP BY folders.id";

$stmt = $conn->prepare($sql);

if ($departmentId) {
    $stmt->bind_param("i", $departmentId);
}

$stmt->execute();
$result = $stmt->get_result();

$folders = [];

while ($row = $result->fetch_assoc()) {
    $folders[] = $row;
}

$stmt->close();
$conn->close();

// Retorna os dados em formato JSON
//header('Content-Type: application/json');
echo json_encode(['folders' => $folders]);
?>