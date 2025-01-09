<?php
session_start();

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("SELECT id, password, role,department  FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();



    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role, $department);
        $stmt->fetch();

        //pegar o id do departamento
        $sq = "SELECT * FROM departments WHERE name = '$department'";
        $ee = mysqli_query($conn,$sq);
        $i = mysqli_fetch_assoc($ee);


        // Verify password
        if (password_verify($password, $hashed_password)) {
            // Store user information in session
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['user_department'] = $department;
            $_SESSION['id_department'] = $i["id"];
            echo 'success';
        } else {
            echo 'Invalid password';
        }
    } else {
        echo 'No user found with that username';
    }

    $stmt->close();
}
//echo  $_SESSION['user_department'];
$conn->close();
?>