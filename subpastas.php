<?php
session_start();
$folder_id = $_GET["folder_id"];
$path = $_GET["path"];
?>

<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Adicionar Subpasta</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
<div class="d-flex">
    <!-- Sidebar -->
    <div class="bg-blue-900 text-white w-64 flex flex-col">
        <div class="flex items-center justify-center h-16 border-b border-blue-800">
            <i class="fas fa-user-circle text-3xl"></i>
            <span class="ml-2 text-xl font-semibold">MAPTS<sup>1</sup></span>
        </div>
        <nav class="flex-1 px-4 py-6">
            <a class="flex items-center py-2 text-blue-300" href="dashboarde.php">
                <i class="fas fa-home mr-3"></i>
                Início
            </a>
            <div class="mt-6">
                <h3 class="text-sm font-semibold text-blue-400">INTERFACE</h3>
                <a class="flex items-center py-2 mt-2 text-white" href="#">
                    <i class="fas fa-file-alt mr-3"></i>
                    DOCUMENTOS
                </a>
                <a class="flex items-center py-2 text-blue-300" href="departament.php">
                    <i class="fas fa-sitemap mr-3"></i>
                    Departamento
                </a>
            </div>
            <div class="mt-6">
                <h3 class="text-sm font-semibold text-blue-400">ADDONS</h3>
                <a class="flex items-center py-2 mt-2 text-blue-300" href="#">
                    <i class="fas fa-folder mr-3"></i>
                    Pastas
                </a>
                <a class="flex items-center py-2 text-blue-300" href="subpastas.php">
                    <i class="fas fa-folder-open mr-3"></i>
                    Subpastas
                </a>
                <a class="flex items-center py-2 text-blue-300" href="#">
                    <i class="fas fa-users mr-3"></i>
                    Usuarios
                </a>
            </div>
            <div class="mt-6">
                <h3 class="text-sm font-semibold text-blue-400">CONTA</h3>
                <a class="flex items-center py-2 text-blue-300" href="#">
                    <i class="fas fa-user mr-3"></i>
                    Perfil
                </a>
                <a class="flex items-center py-2 text-blue-300" href="logout.php">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Logout
                </a>
            </div>
        </nav>
        <div class="p-4">
            <button class="w-full bg-green-500 text-white py-2 rounded" data-bs-toggle="modal" data-bs-target="#addFolderModal">Adicionar Pasta</button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 flex flex-col">
        <!-- Header -->
        <header class="flex items-center justify-between bg-white p-4 shadow">
            <div class="flex items-center">
                <input class="border border-gray-300 rounded-l px-4 py-2" placeholder="pesquisar" type="text"/>
                <button class="bg-blue-900 text-white px-4 py-2 rounded-r">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="flex items-center">
                <div class="relative">
                    <i class="fas fa-bell text-gray-600 text-xl"></i>
                    <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">3+</span>
                </div>
                <div class="relative ml-4">
                    <i class="fas fa-envelope text-gray-600 text-xl"></i>
                    <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">7</span>
                </div>
                <div class="ml-4 flex items-center">
                    <span class="text-gray-600" id="userName"><?php echo $_SESSION["username"]; ?></span>
                    <img alt="User avatar" class="ml-2 rounded-full" height="40" src="https://thumbs.dreamstime.com/b/default-avatar-profile-vector-user-profile-default-avatar-profile-vector-user-profile-profile-179376714.jpg" width="40"/>
                </div>
            </div>
        </header>
        <!-- Main content -->
        <main class="flex-1 p-6">
            <div class="container mx-auto p-6">
                <div class="bg-white p-6 rounded shadow">
                    <h1 class="text-2xl font-semibold mb-4">Adicionar Subpasta</h1>
                    <form id="addSubfolderForm">
                        <input type="hidden" id="folderId" name="folderId" value="<?php echo $folder_id; ?>"/>
                        <input type="hidden" id="folderPath" name="folderPath" value="<?php echo $path; ?>"/>
                        <div class="mb-4">
                            <label for="subfolderName" class="block text-gray-700">Nome da Subpasta</label>
                            <input type="text" id="subfolderName" name="subfolderName" class="w-full border border-gray-300 rounded px-4 py-2" placeholder="Nome da Subpasta" required/>
                        </div>
                        <div class="mb-4">
                            <label for="subfolderDescription" class="block text-gray-700">Descrição</label>
                            <textarea id="subfolderDescription" name="subfolderDescription" class="w-full border border-gray-300 rounded px-4 py-2" placeholder="Descrição" style="height: 100px"></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded">Adicionar Subpasta</button>
                        </div>
                    </form>
                    <div id="message" class="mt-4"></div>
                </div>
            </div>
        </main>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#addSubfolderForm').on('submit', function(e) {
        e.preventDefault();
        const formData = {
            folderId: $('#folderId').val(),
            folderPath: $('#folderPath').val(),
            subfolderName: $('#subfolderName').val(),
            subfolderDescription: $('#subfolderDescription').val()
        };
        $.ajax({
            url: 'add_subfolder.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                const data = JSON.parse(response);
                const messageDiv = $('#message');
                if (data.status === 'success') {
                    messageDiv.html(`<div class="alert alert-success">${data.message}</div>`);
                    $('#addSubfolderForm')[0].reset();
                } else {
                    messageDiv.html(`<div class="alert alert-danger">${data.message}</div>`);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error adding subfolder:', error);
            }
        });
    });
});
</script>
</body>
</html>