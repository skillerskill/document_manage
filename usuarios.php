
<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>User Management</title>
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
                <a class="flex items-center py-2 mt-2 text-white" href="dashboarde.php">
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
            <button class="w-full bg-green-500 text-white py-2 rounded" data-bs-toggle="modal" data-bs-target="#addUserModal">Adicionar Usuário</button>
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
                <h1 class="text-2xl font-semibold">Gerenciamento de Usuários</h1>
                <button class="bg-green-500 text-white px-4 py-2 rounded" data-bs-toggle="modal" data-bs-target="#addUserModal">
                    <i class="fas fa-user-plus mr-2"></i>
                    Adicionar Usuário
                </button>
            </div>
            <div class="bg-white p-4 rounded shadow mb-6">
                <div class="flex mb-4">
                    <input class="border border-gray-300 rounded-l px-4 py-2 flex-1" placeholder="Pesquisar por nome" type="text" id="filterName"/>
                    <select class="border border-gray-300 rounded-r px-4 py-2" id="filterDepartment">
                        <!-- Department options will be loaded here by JavaScript -->
                    </select>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                        <tr>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">ID</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Nome de Usuário</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Função</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Departamento</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Data de Registro</th>
                            <th class="py-2 px-4 border-b border-gray-200 text-left text-sm font-semibold text-gray-600">Ações</th>
                        </tr>
                        </thead>
                        <tbody id="userTableBody">
                        <!-- User rows will be appended here by JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Adicionar Novo Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Adicionar Novo Usuário</h5>
                        <form id="addUserForm">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nome de Usuário</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Nome de Usuário" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Senha" required>
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Função</label>
                                <select class="form-select" id="role" name="role" required>
                                    <option value="user">Usuário</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="function" class="form-label">Função</label>
                                <input type="text" class="form-control" id="function" name="function" placeholder="Função" required>
                            </div>
                            <div class="mb-3">
                                <label for="department" class="form-label">Departamento</label>
                                <select class="form-select" id="department" name="department" required>
                                    <!-- Department options will be loaded here by JavaScript -->
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Adicionar Usuário</button>
                            </div>
                        </form>
                        <div id="message" class="mt-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Editar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Editar Usuário</h5>
                        <form id="editUserForm">
                            <input type="hidden" id="editUserId" name="editUserId">
                            <div class="mb-3">
                                <label for="editUsername" class="form-label">Nome de Usuário</label>
                                <input type="text" class="form-control" id="editUsername" name="editUsername" placeholder="Nome de Usuário" required>
                            </div>
                            <div class="mb-3">
                                <label for="editPassword" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="editPassword" name="editPassword" placeholder="Senha">
                            </div>
                            <div class="mb-3">
                                <label for="editRole" class="form-label">Função</label>
                                <select class="form-select" id="editRole" name="editRole" required>
                                    <option value="user">Usuário</option>
                                    <option value="admin">Administrador</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="editFunction" class="form-label">Função</label>
                                <input type="text" class="form-control" id="editFunction" name="editFunction" placeholder="Função" required>
                            </div>
                            <div class="mb-3">
                                <label for="editDepartment" class="form-label">Departamento</label>
                                <select class="form-select" id="editDepartment" name="editDepartment" required>
                                    <!-- Department options will be loaded here by JavaScript -->
                                </select>
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


<audio id="notificationSound" src="uploads/noti.mp3" preload="auto"></audio>

<script>
function loadUsers() {
    const searchName = $('#filterName').val();
    const filterDepartment = $('#filterDepartment').val();

    $.ajax({
        url: 'get_users.php',
        type: 'GET',
        data: {
            searchName: searchName,
            filterDepartment: filterDepartment
        },
        success: function(response) {
            const data = JSON.parse(response);
            let userRows = '';
            data.users.forEach(user => {
                userRows += `
                    <tr>
                        <td>${user.id}</td>
                        <td>${user.username}</td>
                        <td>${user.role}</td>
                        <td>${user.department}</td>
                        <td>${user.registration_date}</td>
                        <td>
                            <i class="fas fa-edit text-success cursor-pointer" onclick="editUser(${user.id})"></i>
                            <i class="fas fa-trash text-danger cursor-pointer" onclick="deleteUser(${user.id})"></i>
                        </td>
                    </tr>
                `;
            });
            $('#userTableBody').html(userRows);
        },
        error: function(xhr, status, error) {
            console.error('Error loading users:', error);
        }
    });
}

function loadDepartments() {
    $.ajax({
        url: 'get_departments.php',
        type: 'GET',
        success: function(response) {
            const data = JSON.parse(response);
            let departmentOptions = '<option value="" selected>Selecionar Departamento</option>';
            data.departments.forEach(department => {
                departmentOptions += `<option value="${department.name}">${department.name}</option>`;
            });
            $('#department').html(departmentOptions);
            $('#editDepartment').html(departmentOptions);
            $('#filterDepartment').html(departmentOptions);
        },
        error: function(xhr, status, error) {
            console.error('Error loading departments:', error);
        }
    });
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
    // Load users and departments on page load
    loadUsers();
    loadDepartments();

    // Load notifications on page load
    setInterval(() => {
        loadNotifications();
    }, 2500);

    // Toggle notification dropdown
    $('#notificationIcon').on('click', function() {
        $('#notificationDropdown').toggleClass('hidden');
    });

    // Add user form submission
    $('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        $.ajax({
            url: 'add_user.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                const data = JSON.parse(response);
                const messageDiv = $('#message');
                if (data.status === 'success') {
                    $('#addUserModal').modal('hide');
                    alert('Usuário adicionado com sucesso!');
                    loadUsers();
                } else {
                    messageDiv.html(`<div class="alert alert-danger">${data.message}</div>`);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error adding user:', error);
            }
        });
    });

    // Edit user form submission
    $('#editUserForm').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        $.ajax({
            url: 'edit_user.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                const data = JSON.parse(response);
                const messageDiv = $('#editMessage');
                if (data.status === 'success') {
                    $('#editUserModal').modal('hide');
                    alert('Usuário atualizado com sucesso!');
                    loadUsers();
                } else {
                    messageDiv.html(`<div class="alert alert-danger">${data.message}</div>`);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error editing user:', error);
            }
        });
    });

    // Filter users on input change
    $('#filterName, #filterDepartment').on('input change', function() {
        loadUsers();
    });
});

function editUser(userId) {
    $.ajax({
        url: 'get_user.php',
        type: 'GET',
        data: { userId: userId },
        success: function(response) {
            const data = JSON.parse(response);
            if (data.status === 'success') {
                const user = data.user;
                $('#editUserId').val(user.id);
                $('#editUsername').val(user.username);
                $('#editRole').val(user.role);
                $('#editFunction').val(user.function);
                $('#editDepartment').val(user.department);
                $('#editUserModal').modal('show');
            } else {
                alert('Erro ao carregar dados do usuário: ' + data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading user data:', error);
        }
    });
}

function deleteUser(userId) {
    if (confirm('Tem certeza de que deseja excluir este usuário?')) {
        $.ajax({
            url: 'delete_user.php',
            type: 'POST',
            data: { userId: userId },
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    alert('Usuário excluído com sucesso!');
                    loadUsers();
                } else {
                    alert('Erro ao excluir usuário: ' + data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error deleting user:', error);
            }
        });
    }
}
</script>

</body>
</html>