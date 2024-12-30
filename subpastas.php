<?php
session_start();
?>
<html lang="pt_br">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Manage Subfolders</title>
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
                <a class="flex items-center py-2 mt-2 text-blue-300" href="pasta.php">
                    <i class="fas fa-folder mr-3"></i>
                    Pastas
                </a>
                <a class="flex items-center py-2 text-blue-300" href="subpasta.php">
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
            <button class="w-full bg-green-500 text-white py-2 rounded" data-bs-toggle="modal" data-bs-target="#addSubfolderModal">Adicionar Subpasta</button>
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
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Gerenciar Subpastas</h1>
                <button class="bg-blue-900 text-white px-4 py-2 rounded" data-bs-toggle="modal" data-bs-target="#addSubfolderModal">
                    <i class="fas fa-folder-plus mr-2"></i>
                    Adicionar Subpasta
                </button>
            </div>
            <div class="bg-white p-4 rounded shadow mb-6">
                <h2 class="text-gray-600 mb-4">Subpastas Existentes</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Pasta</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Nome da Subpasta</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Descrição</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Data de Criação</th>
                        </tr>
                        </thead>
                        <tbody id="subfolderTableBody">
                        <!-- Subfolder rows will be appended here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add Subfolder Modal -->
<div class="modal fade" id="addSubfolderModal" tabindex="-1" aria-labelledby="addSubfolderModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubfolderModalLabel">Adicionar Nova Subpasta</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar Nova Subpasta</h5>
                        <form class="row g-3" id="addSubfolderForm">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="folderSelect" name="folderSelect" aria-label="Pasta" required>
                                        <!-- Folder options will be loaded here by JavaScript -->
                                    </select>
                                    <label for="folderSelect">Pasta</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="subfolderName" name="subfolderName" placeholder="Nome da Subpasta" required/>
                                    <label for="subfolderName">Nome da Subpasta</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Descrição" id="subfolderDescription" name="subfolderDescription" style="height: 100px"></textarea>
                                    <label for="subfolderDescription">Descrição</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Adicionar Subpasta</button>
                            </div>
                        </form>
                        <div id="message" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   $(document).ready(function() {
    // Load folders and subfolders on page load
    loadFolders();
    loadSubfolders();

    // Add subfolder form submission
    $('#addSubfolderForm').on('submit', function(e) {
        e.preventDefault();
        const formData = {
            folderId: $('#folderSelect').val(),
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
                    $('#addSubfolderModal').modal('hide');
                    alert('Subpasta adicionada com sucesso!');
                    loadSubfolders();
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

function loadFolders() {
    $.ajax({
        url: 'get_folders.php',
        type: 'GET',
        success: function(response) {
            const data = JSON.parse(response);
            let folderOptions = '<option value="" disabled selected>Selecionar Pasta</option>';
            data.folders.forEach(folder => {
                folderOptions += `<option value="${folder.id}">${folder.name}</option>`;
            });
            $('#folderSelect').html(folderOptions);
        },
        error: function(xhr, status, error) {
            console.error('Error loading folders:', error);
        }
    });
}

function loadSubfolders() {
    $.ajax({
        url: 'get_subfolders.php',
        type: 'GET',
        dataType: 'json', // Especifica que a resposta deve ser tratada como JSON
        success: function(data) {
            let subfolderRows = '';
            data.subfolders.forEach(subfolder => {
                subfolderRows += `
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">${subfolder.folder_name}</td>
                        <td class="py-2 px-4 border-b border-gray-200">${subfolder.name}</td>
                        <td class="py-2 px-4 border-b border-gray-200">${subfolder.description}</td>
                        <td class="py-2 px-4 border-b border-gray-200">${subfolder.created_at}</td>
                    </tr>
                `;
            });
            $('#subfolderTableBody').html(subfolderRows);
        },
        error: function(xhr, status, error) {
            console.error('Error loading subfolders:', error);
        }
    });
}
</script>
</body>
</html>