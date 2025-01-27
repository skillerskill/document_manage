
<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>View Documents</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">
<div class="flex flex-col md:flex-row">
    <!-- Sidebar -->
    <div class="bg-blue-900 text-white w-full md:w-64 flex flex-col">
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
                <a class="flex items-center py-2 mt-2 text-blue-300" href="pasta.pphp">
                    <i class="fas fa-folder mr-3"></i>
                    Pastas
                </a>
               
                <a class="flex items-center py-2 text-blue-300" href="usuarios.php">
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
    </div>

    <!-- Main Content -->
    <div class="flex-grow flex flex-col p-4">
        <!-- Header -->
        <header class="flex flex-col md:flex-row items-center justify-between bg-white p-4 shadow mb-4">
            <div class="flex items-center mb-4 md:mb-0">
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
                    <span class="text-gray-600 text-sm" id="userName"><?php echo $_SESSION["username"]; ?></span>
                    <img alt="User avatar" class="ml-2 rounded-full" height="40" src="https://thumbs.dreamstime.com/b/default-avatar-profile-vector-user-profile-default-avatar-profile-vector-user-profile-profile-179376714.jpg" width="40"/>
                </div>
            </div>
        </header>
        <!-- Main content -->
        <main class="flex-1">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Documentos</h1>
                <button class="bg-blue-900 text-white px-4 py-2 rounded" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
                    <i class="fas fa-file-upload mr-2"></i>
                    Adicionar Documento
                </button>
            </div>
            <nav class="flex mb-6" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="dashboarde.php" class="text-gray-700 hover:text-gray-900 inline-flex items-center">
                            <i class="fas fa-home mr-2"></i>
                            Início
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="pasta.php" class="text-gray-700 hover:text-gray-900">
                                Pastas
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <a href="subpastas.php?folder_id=<?php echo $_GET['folder_id']; ?>" class="text-gray-700 hover:text-gray-900">
                                <span id="breadcrumbFolderName">Pasta</span>
                            </a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                            <span id="breadcrumbSubfolderName">Subpasta</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <select class="border border-gray-300 rounded px-4 py-2" id="filterDepartment">
                    <option value="">Buscar por Departamento</option>
                    <option value="Recursos Humanos">Recursos Humanos</option>
                    <option value="Finanças">Finanças</option>
                    <option value="Marketing">Marketing</option>
                </select>
                <div class="flex">
                    <input class="border border-gray-300 rounded-l px-4 py-2 flex-1" placeholder="pesquisar por nome" type="text" id="searchName"/>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Tipo</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Nome do Arquivo</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Descrição</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Data de Envio</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Usuário que Enviou</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Departamento do Usuário</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Status</th>
                            <th class="py-2 px-4 border-b border-gray-200 bg-gray-100 text-left text-sm font-semibold text-gray-700">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="documentTableBody">
                        <!-- Document rows will be appended here by JavaScript -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="addDocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDocumentModalLabel">Adicionar Novo Documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar Novo Documento</h5>
                        <form id="addDocumentForm" enctype="multipart/form-data">
                            <input type="hidden" id="subfolderId" name="subfolderId" value="<?php echo $_GET['subfolder_id']; ?>" />
                            <div class="mb-3">
                                <label for="floatingName" class="form-label">Nome do Documento</label>
                                <input type="text" class="form-control" id="floatingName" name="floatingName" placeholder="Nome do Documento" required>
                            </div>
                            <div class="mb-3">
                                <label for="floatingDescription" class="form-label">Descrição</label>
                                <textarea class="form-control" id="floatingDescription" name="floatingDescription" placeholder="Descrição" style="height: 100px"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="floatingFile" class="form-label">Arquivo</label>
                                <input type="file" class="form-control" id="floatingFile" name="floatingFile" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Adicionar Documento</button>
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
    // Get subfolder ID from URL
    const urlParams = new URLSearchParams(window.location.search);
    const subfolderId = urlParams.get('subfolder_id');
    const folderId = urlParams.get('folder_id');

    // Load documents for the specific subfolder on page load
    loadDocuments(subfolderId);

    // Load subfolder name for the breadcrumb
    loadSubfolderName(subfolderId);

    // Add document form submission
    $('#addDocumentForm').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            url: 'add_document.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                const data = JSON.parse(response);
                const messageDiv = $('#message');
                if (data.status === 'success') {
                    $('#addDocumentModal').modal('hide');
                    alert('Documento adicionado com sucesso!');
                    loadDocuments(subfolderId);
                } else {
                    messageDiv.html(`<div class="alert alert-danger">${data.message}</div>`);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error adding document:', error);
            }
        });
    });

    // Filter documents on input change
    $('#searchName, #filterDepartment').on('input change', function() {
        loadDocuments(subfolderId);
    });
});

function loadDocuments(subfolderId) {
    const searchName = $('#searchName').val();
    const filterDepartment = $('#filterDepartment').val();

    $.ajax({
        url: 'get_documents.php',
        type: 'GET',
        data: { 
            subfolderId: subfolderId,
            searchName: searchName,
            filterDepartment: filterDepartment
        },
        success: function(response) {
            const data = JSON.parse(response);
            let documentRows = '';
            if (data.documents.length > 0) {
                data.documents.forEach(document => {
                    const fileTypeIcon = getFileTypeIcon(document.file_path);
                    documentRows += `
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">${fileTypeIcon}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${document.name}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${document.description}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${document.upload_time}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${document.uploaded_by}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${document.department}</td>
                            <td class="py-2 px-4 border-b border-gray-200">${document.status}</td>
                            <td class="py-2 px-4 border-b border-gray-200">
                                <a href="${document.file_path}" class="text-blue-500 hover:underline" target="_blank">Visualizar</a>
                                <button class="text-red-500 hover:underline ml-2" onclick="deleteDocument(${document.id})">Excluir</button>
                                <select class="ml-2" onchange="updateStatus(${document.id}, this.value)">
                                    <option value="Aberto" ${document.status === 'Aberto' ? 'selected' : ''}>Aberto</option>
                                    <option value="Em andamento" ${document.status === 'Em andamento' ? 'selected' : ''}>Em andamento</option>
                                    <option value="Finalizado" ${document.status === 'Finalizado' ? 'selected' : ''}>Finalizado</option>
                                </select>
                            </td>
                        </tr>
                    `;
                });
            } else {
                documentRows = `
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200 text-center" colspan="8">Nenhum documento encontrado nesta subpasta.</td>
                    </tr>
                `;
            }
            $('#documentTableBody').html(documentRows);
        },
        error: function(xhr, status, error) {
            console.error('Error loading documents:', error);
        }
    });
}

function getFileTypeIcon(filePath) {
    const extension = filePath.split('.').pop().toLowerCase();
    switch (extension) {
        case 'pdf':
            return '<i class="fas fa-file-pdf text-red-500"></i>';
        case 'doc':
        case 'docx':
            return '<i class="fas fa-file-word text-blue-500"></i>';
        case 'xls':
        case 'xlsx':
            return '<i class="fas fa-file-excel text-green-500"></i>';
        case 'ppt':
        case 'pptx':
            return '<i class="fas fa-file-powerpoint text-orange-500"></i>';
        default:
            return '<i class="fas fa-file text-gray-500"></i>';
    }
}

function loadSubfolderName(subfolderId) {
    $.ajax({
        url: 'get_subfolder_name.php',
        type: 'GET',
        data: { subfolderId: subfolderId },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.status === 'success') {
                $('#breadcrumbSubfolderName').text(data.subfolder_name);
            } else {
                console.error('Error loading subfolder name:', data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading subfolder name:', error);
        }
    });
}

function deleteDocument(documentId) {
    if (confirm('Tem certeza de que deseja excluir este documento?')) {
        $.ajax({
            url: 'delete_document.php',
            type: 'POST',
            data: { documentId: documentId },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    alert('Documento excluído com sucesso!');
                    loadDocuments(subfolderId);
                } else {
                    alert('Erro ao excluir documento: ' + data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error deleting document:', error);
            }
        });
    }
}

function updateStatus(documentId, status) {
    $.ajax({
        url: 'update_document_status.php',
        type: 'POST',
        data: { documentId: documentId, status: status },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.status === 'success') {
                alert('Status do documento atualizado com sucesso!');
                loadDocuments(subfolderId);
            } else {
                alert('Erro ao atualizar status do documento: ' + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error updating document status:', error);
        }
    });
}
</script>

</body>
</html>