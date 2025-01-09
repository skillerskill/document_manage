<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Document Manager</title>
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
            <a class="flex items-center py-2 text-blue-300" href="#">
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
                
                <a class="flex items-center py-2 text-blue-300" href="usuarios.php">
                    <i class="fas fa-users mr-3"></i>
                    Usuarios
                </a>
                <a class="flex items-center py-2 text-blue-300" href="logout.php">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Logout
                </a>
            </div>
        </nav>
        <div class="p-4">
            <button class="w-full bg-green-500 text-white py-2 rounded" data-bs-toggle="modal" data-bs-target="#addFileModal">Adiciona Arquivos</button>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 flex flex-col">
        <!-- Header -->
      <?php
        include_once("header.php");
      ?>
        <!-- Main content -->
        <main class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Painel</h1>
                <button class="bg-blue-900 text-white px-4 py-2 rounded">
                    <i class="fas fa-download mr-2"></i>
                    Gerar Relatório
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-white p-4 rounded shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-blue-600">DOCUMENTOS</h2>
                        <p class="text-2xl font-semibold" id="documentCount">8</p>
                    </div>
                    <i class="fas fa-file-alt text-4xl text-gray-400"></i>
                </div>
                <div id="depart" class="bg-white p-4 rounded shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-green-600">DEPARTAMENTO</h2>
                        <p class="text-2xl font-semibold" id="departmentCount">12</p>
                    </div>
                    <i class="fas fa-sitemap text-4xl text-gray-400"></i>
                </div>
                <div id="pasta" class="bg-white p-4 rounded shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-teal-600">PASTA</h2>
                        <p class="text-2xl font-semibold" id="folderCount">10</p>
                    </div>
                    <i class="fas fa-folder text-4xl text-gray-400"></i>
                </div>
                <div id="usuario" class="bg-white p-4 rounded shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-yellow-600">USUARIOS</h2>
                        <p class="text-2xl font-semibold" id="userCount">18</p>
                    </div>
                    <i class="fas fa-users text-4xl text-gray-400"></i>
                </div>
            </div>
            <div class="bg-white p-4 rounded shadow mb-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-gray-600">DOCUMENTOS</h2>
                    <button class="bg-green-500 text-white px-4 py-2 rounded" data-bs-toggle="modal" data-bs-target="#addFileModal">Adiciona Arquivos</button>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-2">
                    <select class="border border-gray-300 rounded px-2 py-1" id="filterDepartment">
                        <option value="">Buscar por Departamento</option>
                        <option value="Recursos Humanos">Recursos Humanos</option>
                        <option value="Finanças">Finanças</option>
                        <option value="Marketing">Marketing</option>
                    </select>
                    <select class="border border-gray-300 rounded px-2 py-1" id="filterFolder">
                        <option value="">Buscar por Pastas</option>
                        <option value="Recursos Humanos">Recursos Humanos</option>
                        <option value="Finanças">Finanças</option>
                        <option value="Marketing">Marketing</option>
                    </select>
                    <select class="border border-gray-300 rounded px-2 py-1">
                        <option>Buscar por Subpastas</option>
                    </select>
                    <div class="flex">
                        <input class="border border-gray-300 rounded-l px-2 py-1 flex-1" placeholder="pesquisar por nome" type="text" id="searchName"/>
                        <button class="bg-blue-900 text-white px-2 py-1 rounded-r" id="searchButton">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-blue-600 mb-4">Tabela de Documentos</h2>
                <div class="mb-3">
                    <label for="resultsPerPage">Resultados por página</label>
                    <select class="form-control" id="resultsPerPage">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                        <tr>
                        <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Tipo de Arquivo</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Nome do arquivo</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Descrição</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Data de envio</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Usuário que enviou</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Departamento do usuário</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Status</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Ações</th>
                        </tr>
                        </thead>
                        <tbody id="documentTableBody">
                        <!-- Document rows will be appended here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addFileModal" tabindex="-1" aria-labelledby="addFileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addFileModalLabel">Inserir Arquivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Inserir Arquivo</h5>
                        <form class="row g-3" id="addDocumentForm" enctype="multipart/form-data">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="floatingName" name="floatingName" placeholder="Nome do Arquivo"/>
                                    <label for="floatingName">Nome do Arquivo</label>
                                </div>
                            </div>
                           
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select id="departmentSelect" class="form-select" id="floatingSelectDept" name="floatingSelectDept" aria-label="State">
                                    
                                    </select>
                                    <label for="floatingSelectDept">Departamento</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelectCode" name="floatingSelectCode"  aria-label="State">
                                        <option selected="1">01</option>
                                        <option value="2">02</option>
                                        <option value="3">03</option>
                                    </select>
                                    <label for="floatingSelectCode">Codigo Departamento</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelectFolder" name="floatingSelectFolder" aria-label="State">
                                        <option selected="">Seleciona a pasta</option>
                                        <option value="Recursos Humanos">Recursos Humanos</option>
                                        <option value="Finanças">Finanças</option>
                                        <option value="Marketing">Marketing</option>
                                    </select>
                                    <label for="floatingSelectFolder">Pasta</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select" id="floatingSelectSubfolder" name="floatingSelectSubfolder" aria-label="State">
                                        <option selected="">Seleciona Subpasta</option>
                                        <option value="1">Oregon</option>
                                        <option value="2">DC</option>
                                    </select>
                                    <label for="floatingSelectSubfolder">Subpastas</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="file" class="form-control" id="floatingFile" name="floatingFile" placeholder="Arquivo"/>
                                    <label for="floatingFile">Arquivo</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Descrição" id="floatingDescription" name="floatingDescription" style="height: 100px"></textarea>
                                    <label for="floatingDescription">Descrição</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Enviar Arquivo</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function loadDocuments() {
    const searchName = $('#searchName').val();
    const filterDepartment = $('#filterDepartment').val();
    const filterFolder = $('#filterFolder').val();
    const filterSubfolder = $('#filterSubfolder').val();
    const resultsPerPage = $('#resultsPerPage').val();

    $("#pasta").on("click",function(){
        window.location.href = "pasta.php";
    });
    $("#usuario").on("click",function(){
        window.location.href = "usuarios.php";
    })
    $("#depart").on("click",function(){
        window.location.href = "departament.php";
    })
    $.ajax({
        url: 'get_documents.php',
        type: 'GET',
        data: {
            searchName: searchName,
            filterDepartment: filterDepartment,
            filterFolder: filterFolder,
            filterSubfolder: filterSubfolder,
            resultsPerPage: resultsPerPage
        },
        success: function(response) {
            console.log(response); // Log the response for debugging
            try {
                const data = JSON.parse(response);
                console.log(data); // Log the parsed data for debugging
                const documents = data.documents;
                const documentCount = data.documentCount;
                const departmentCount = data.departmentCount;
                const folderCount = data.folderCount;
                const subfolderCount = data.subfolderCount;
                const userCount = data.userCount;
                const userRole = data.userRole;
                const userName = data.userName;
                const userDepartment = data.userDepartment;
               
                if (userRole === 'admin') {
                    $('#addUserButton').show();
                }
                let documentRows = '';
                documents.forEach(document => {
                     const fileTypeIcon = getFileTypeIcon(document.file_path);
                    documentRows += `
                        <tr>
                            <td class="py-2 px-4 border-b border-gray-200">${fileTypeIcon}</td>
                            <td>${document.name}</td>
                            <td>${document.description}</td>
                            <td>${document.upload_time}</td>
                            <td>${document.uploaded_by}</td>
                            <td>${document.department}</td>
                            <td>
                                ${userRole === 'admin' ? `
                                <select onchange="updateStatus(${document.id}, this.value)">
                                    <option value="Aberto" ${document.status === 'Aberto' ? 'selected' : ''}>Aberto</option>
                                    <option value="Em andamento" ${document.status === 'Em andamento' ? 'selected' : ''}>Em andamento</option>
                                    <option value="Finalizado" ${document.status === 'Finalizado' ? 'selected' : ''}>Finalizado</option>
                                </select>
                                ` : document.status}
                            </td>
                            <td>
                                <a href="${document.file_path}" download>
                                    <i class="fas fa-download text-primary cursor-pointer"></i>
                                </a>
                                ${ userRole === 'admin' ? `
                                <i class="fas fa-edit text-success cursor-pointer" onclick="editDocument(${document.id})"></i>
                                <i class="fas fa-trash text-danger cursor-pointer" onclick="deleteDocument(${document.id})"></i>
                                ` : ''}
                            </td>
                        </tr>
                    `;
                   
                });
                $('#documentTableBody').html(documentRows);
                $('#documentCount').text(documentCount); // Atualiza a contagem de documentos no card
                $('#departmentCount').text(departmentCount); // Atualiza a contagem de departamentos no card
                $('#folderCount').text(folderCount); // Atualiza a contagem de pastas no card
                $('#subfolderCount').text(subfolderCount); // Atualiza a contagem de subpastas no card
                $('#userCount').text(userCount); // Atualiza a contagem de usuários no card
            } catch (e) {
                console.error('Error parsing JSON:', e);
            }
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
function loadNotifications() {
    $.ajax({
        url: 'get_notifications.php',
        type: 'GET',
        success: function(response) {
            const data = JSON.parse(response);
            if (data.status === 'success') {
                const notifications = data.notifications;
                let notificationList = '';
                let unreadCount = 0;
                let newNotifications = false;

                notifications.forEach(notification => {
                    if (!notification.is_read) {
                        unreadCount++;
                        newNotifications = true;
                    }
                    notificationList += `
                        <li class="py-2 border-b border-gray-200">
                            <p class="text-sm text-gray-600">${notification.message}</p>
                            <small class="text-xs text-gray-400">${notification.created_at}</small>
                            ${!notification.is_read ? `<button class="text-blue-500 text-xs" onclick="markAsRead(${notification.id})">Marcar como lida</button>` : ''}
                        </li>
                    `;
                });

                $('#notificationList').html(notificationList);
                $('#notificationCount').text(unreadCount);

               
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading notifications:', error);
        }
    });
}

function markAsRead(notificationId) {
    $.ajax({
        url: 'mark_notification_read.php',
        type: 'POST',
        data: { notification_id: notificationId },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.status === 'success') {
                loadNotifications();
            } else {
                alert('Erro ao marcar notificação como lida: ' + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error marking notification as read:', error);
        }
    });
}

$(document).ready(function() {
    // Load documents on page load
    loadDocuments();

    // Set interval to load documents every 2 seconds
    setInterval(loadDocuments, 4000);
     // Load notifications on page load
     setInterval(() => {
        loadNotifications();
    }, 2500);
     // Toggle notification dropdown
     $('#notificationIcon').on('click', function() {
        $('#notificationDropdown').toggleClass('hidden');
    });
    // Add document form submission
    $('#addDocumentForm').on('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        $.ajax({
            url: 'add_document.php',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('#addFileModal').modal('hide');
                loadDocuments();
            }
        });
    });

    // Load folders
    function loadFolders() {
        $.ajax({
            url: 'get_folders.php',
            type: 'GET',
            success: function(response) {
                const data = JSON.parse(response);
                let folderOptions = '<option value="" disabled selected>Selecionar Pasta</option>';
                data.folders.forEach(folder => {
                    folderOptions += `<option value="${folder.path}">${folder.name}</option>`;
                });
                $('#floatingSelectFolder').html(folderOptions);
            },
            error: function(xhr, status, error) {
                console.error('Error loading folders:', error);
            }
        });
    }

    // Load subfolders
    function loadSubfolders() {
        $.ajax({
            url: 'get_subpastas.php',
            type: 'GET',
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    let subfolderOptions = '<option value="" disabled selected>Selecionar Subpasta</option>';
                    data.subfolders.forEach(subfolder => {
                        subfolderOptions += `<option value="${subfolder.id}">${subfolder.name} (Pasta: ${subfolder.folder_id})</option>`;
                    });
                    $('#floatingSelectSubfolder').html(subfolderOptions);
                } else {
                    console.error('Error loading subfolders:', data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error loading subfolders:', error);
            }
        });
    }

    // Load departments
    function loadDepartments() {
        $.ajax({
            url: 'get_departments.php',
            type: 'GET',
            success: function(response) {
                const userRole = '<?php echo $_SESSION['role']; ?>';
                const userDepartment = '<?php echo $_SESSION['user_department']; ?>';
                const data = JSON.parse(response);
                let departmentOptions = '<option value="" disabled selected>Selecionar Departamento</option>';
                data.departments.forEach(department => {
                    if (userRole === 'admin' || department.name === userDepartment) {
                        departmentOptions += `<option value="${department.id}">${department.name}</option>`;
                    }
                });
                $('#departmentSelect').html(departmentOptions);
            },
            error: function(xhr, status, error) {
                console.error('Error loading departments:', error);
            }
        });
    }

    // Load folders, subfolders, and departments on page load
    loadFolders();
    loadSubfolders();
    loadDepartments();
});

function updateStatus(documentId, status) {
    $.ajax({
        url: 'update_document_status.php',
        type: 'POST',
        data: { documentId: documentId, status: status },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.status === 'success') {
                alert('Status do documento atualizado com sucesso!');
                loadDocuments();
            } else {
                alert('Erro ao atualizar status do documento: ' + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error updating document status:', error);
        }
    });
}

function editDocument(documentId) {
    // Implement edit document functionality
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
                    loadDocuments();
                } else {
                    alert('Erro ao excluir documento: ' + data.message + documentId);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error deleting document:', error);
            }
        });
    }
}
</script>



</body>
</html>