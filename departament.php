<?php   
session_start();
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Manage Departments</title>
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
            <button class="w-full bg-green-500 text-white py-2 rounded" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">Adicionar Departamento</button>
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
                <h1 class="text-2xl font-semibold">Gerenciar Departamentos</h1>
                <button class="bg-blue-900 text-white px-4 py-2 rounded" data-bs-toggle="modal" data-bs-target="#addDepartmentModal">
                    <i class="fas fa-plus mr-2"></i>
                    Adicionar Departamento
                </button>
            </div>
            <div class="bg-white p-4 rounded shadow mb-6">
                <h2 class="text-gray-600 mb-4">Departamentos Existentes</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Nome do Departamento</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Ações</th>
                        </tr>
                        </thead>
                        <tbody id="departmentTableBody">
                        <!-- Department rows will be appended here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add Department Modal -->
<div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addDepartmentModalLabel">Adicionar Novo Departamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar Novo Departamento</h5>
                        <form class="row g-3" id="addDepartmentForm">
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="departmentName" name="departmentName" placeholder="Nome do Departamento" required/>
                                    <label for="departmentName">Nome do Departamento</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Adicionar Departamento</button>
                            </div>
                        </form>
                        <div id="message" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Department Modal -->
<div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDepartmentModalLabel">Editar Departamento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editar Departamento</h5>
                        <form class="row g-3" id="editDepartmentForm">
                            <input type="hidden" id="editDepartmentId" name="editDepartmentId"/>
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="editDepartmentName" name="editDepartmentName" placeholder="Nome do Departamento" required/>
                                    <label for="editDepartmentName">Nome do Departamento</label>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            </div>
                        </form>
                        <div id="editMessage" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
   $(document).ready(function() {
    // Load departments on page load
    loadDepartments();

    // Add department form submission
    $('#addDepartmentForm').on('submit', function(e) {
        e.preventDefault();
        const formData = {
            departmentName: $('#departmentName').val()
        };
        $.ajax({
            url: 'add_department.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                const data = JSON.parse(response);
                const messageDiv = $('#message');
                if (data.status === 'success') {
                    $('#addDepartmentModal').modal('hide');
                    alert('Departamento adicionado com sucesso!');
                    loadDepartments();
                } else {
                    messageDiv.html(`<div class="alert alert-danger">${data.message}</div>`);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error adding department:', error);
            }
        });
    });

    // Edit department form submission
    $('#editDepartmentForm').on('submit', function(e) {
        e.preventDefault();
        const formData = {
            departmentId: $('#editDepartmentId').val(),
            departmentName: $('#editDepartmentName').val()
        };
        $.ajax({
            url: 'edit_department.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                const data = JSON.parse(response);
                const messageDiv = $('#editMessage');
                if (data.status === 'success') {
                    $('#editDepartmentModal').modal('hide');
                    alert('Departamento atualizado com sucesso!');
                    loadDepartments();
                } else {
                    messageDiv.html(`<div class="alert alert-danger">${data.message}</div>`);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error editing department:', error);
            }
        });
    });
});

function loadDepartments() {
    $.ajax({
        url: 'get_departments.php',
        type: 'GET',
        success: function(response) {
            const data = JSON.parse(response);
            let departmentRows = '';
            data.departments.forEach(department => {
                departmentRows += `
                    <tr>
                        <td class="py-2 px-4 border-b border-gray-200">${department.name}</td>
                        <td class="py-2 px-4 border-b border-gray-200">
                            <button class="bg-yellow-500 text-white px-4 py-2 rounded" onclick="editDepartment(${department.id}, '${department.name}')">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                        </td>
                    </tr>
                `;
            });
            $('#departmentTableBody').html(departmentRows);
        },
        error: function(xhr, status, error) {
            console.error('Error loading departments:', error);
        }
    });
}

function editDepartment(id, name) {
    $('#editDepartmentId').val(id);
    $('#editDepartmentName').val(name);
    $('#editDepartmentModal').modal('show');
}
</script>
</body>
</html>
