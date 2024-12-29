<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Usuários</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 p-4">
            <h4 class="text-xl font-bold mb-4">MAPTS<sup>1</sup></h4>
            <nav class="space-y-2">
                <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="dashboarde.php">
                    <i class="fas fa-home mr-2"></i> Início
                </a>
                <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="documents.php">
                    <i class="fas fa-file-alt mr-2"></i> DOCUMENTOS
                </a>
                <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="#">
                    <i class="fas fa-building mr-2"></i> Departamento
                </a>
                <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="#">
                    <i class="fas fa-folder mr-2"></i> Pastas
                </a>
                <a class="flex items-center p-2 hover:bg-gray-700 rounded" href="users.php">
                    <i class="fas fa-users mr-2"></i> Usuários
                </a>
                <a class="flex items-center p-2 hover:bg-gray-700 rounded" data-target="#logoutModal" data-toggle="modal" href="#">
                    <i class="fas fa-sign-out-alt mr-2"></i> Terminar Sessão
                </a>
            </nav>
            <button class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded mt-4 w-full" onclick="openModal('addDocumentModal')">Adiciona Arquivos</button>
            <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded mt-4 w-full" onclick="openModal('addUserModal')" id="addUserButton">Adicionar Usuário</button>
        </div>

        <!-- Main Content -->
        <div class="flex-grow p-6">
            <h2 class="text-2xl font-bold mb-4">Gerenciar Usuários</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th class="py-2 px-4 border-b">Nome de Usuário</th>
                            <th class="py-2 px-4 border-b">Função</th>
                            <th class="py-2 px-4 border-b">Departamento</th>
                            <th class="py-2 px-4 border-b">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="userTableBody">
                        <!-- User rows will be appended here by JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Document Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center hidden" id="addDocumentModal">
        <div class="bg-white rounded-lg shadow-lg w-96">
            <div class="border-b p-4 flex justify-between items-center">
                <h5 class="text-lg font-bold">Adicionar Documento</h5>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('addDocumentModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="addDocumentForm" enctype="multipart/form-data">
                    <div class="mb-4">
                        <label for="documentName" class="block text-sm font-medium text-gray-700">Nome do Arquivo</label>
                        <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="documentName" name="documentName" required type="text"/>
                    </div>
                    <div class="mb-4">
                        <label for="documentDescription" class="block text-sm font-medium text-gray-700">Descrição</label>
                        <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="documentDescription" name="documentDescription" required type="text"/>
                    </div>
                    <div class="mb-4">
                        <label for="documentDepartment" class="block text-sm font-medium text-gray-700">Departamento</label>
                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="documentDepartment" name="documentDepartment" required>
                            <option value="Recursos Humanos">Recursos Humanos</option>
                            <option value="Finanças">Finanças</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="documentFolder" class="block text-sm font-medium text-gray-700">Pasta</label>
                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="documentFolder" name="documentFolder" required>
                            <option value="Recursos Humanos">Recursos Humanos</option>
                            <option value="Finanças">Finanças</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="documentFile" class="block text-sm font-medium text-gray-700">Ficheiro</label>
                        <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="documentFile" name="documentFile" required type="file"/>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded" type="submit">Adicionar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit User Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center hidden" id="editUserModal">
        <div class="bg-white rounded-lg shadow-lg w-96">
            <div class="border-b p-4 flex justify-between items-center">
                <h5 class="text-lg font-bold">Editar Usuário</h5>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('editUserModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="editUserForm">
                    <input type="hidden" id="editUserId" name="userId">
                    <div class="mb-4">
                        <label for="editUsername" class="block text-sm font-medium text-gray-700">Nome de Usuário</label>
                        <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="editUsername" name="username" required type="text"/>
                    </div>
                    <div class="mb-4">
                        <label for="editRole" class="block text-sm font-medium text-gray-700">Função</label>
                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="editRole" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="user">Usuário</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="editUserDepartment" class="block text-sm font-medium text-gray-700">Departamento</label>
                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="editUserDepartment" name="userDepartment" required>
                            <option value="Recursos Humanos">Recursos Humanos</option>
                            <option value="Finanças">Finanças</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded" type="submit">Salvar Alterações</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Add User Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center hidden" id="addUserModal">
        <div class="bg-white rounded-lg shadow-lg w-96">
            <div class="border-b p-4 flex justify-between items-center">
                <h5 class="text-lg font-bold">Adicionar Usuário</h5>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('addUserModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4">
                <form id="addUserForm">
                    <div class="mb-4">
                        <label for="username" class="block text-sm font-medium text-gray-700">Nome de Usuário</label>
                        <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="username" name="username" required type="text"/>
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                        <input class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="password" name="password" required type="password"/>
                    </div>
                    <div class="mb-4">
                        <label for="role" class="block text-sm font-medium text-gray-700">Função</label>
                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="user">Usuário</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="userDepartment" class="block text-sm font-medium text-gray-700">Departamento</label>
                        <select class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" id="userDepartment" name="userDepartment" required>
                            <option value="Recursos Humanos">Recursos Humanos</option>
                            <option value="Finanças">Finanças</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>
                    <button class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded" type="submit">Adicionar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="fixed inset-0 z-50 flex items-center justify-center hidden" id="logoutModal">
        <div class="bg-white rounded-lg shadow-lg w-96">
            <div class="border-b p-4 flex justify-between items-center">
                <h5 class="text-lg font-bold">Terminar Sessão</h5>
                <button class="text-gray-500 hover:text-gray-700" onclick="closeModal('logoutModal')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-4">
                <p>Tem certeza de que deseja terminar a sessão?</p>
            </div>
            <div class="border-t p-4 flex justify-end space-x-2">
                <button class="bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded" onclick="closeModal('logoutModal')">Cancelar</button>
                <button class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded" id="confirmLogoutButton">Terminar Sessão</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            loadUsers();

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
                        closeModal('addDocumentModal');
                        alert('Documento adicionado com sucesso!');
                        loadUsers();
                    }
                });
            });

            // Edit user form submission
            $('#editUserForm').on('submit', function(e) {
                e.preventDefault();
                const formData = $(this).serialize();
                $.ajax({
                    url: 'update_user.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        closeModal('editUserModal');
                        alert('Usuário atualizado com sucesso!');
                        loadUsers();
                    }
                });
            });

           
            

            // Add user form submission
            $('#addUserForm').on('submit', function(e) {
                e.preventDefault();
                const formData = {
                username: $('#username').val(),
                password: $('#password').val(),
                role: $('#role').val(),
                userFunction: $('#userFunction').val(),
                userDepartment: $('#userDepartment').val()
            };

                $.ajax({
                    url: 'add_user.php',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        closeModal('addUserModal');
                        alert('Usuário adicionado com sucesso!');
                        loadUsers();
                    }
                });
            });

            // Confirm logout button click
            $('#confirmLogoutButton').on('click', function() {
                window.location.href = 'logout.php'; // Redirect to login page
            });
        });

        function loadUsers() {
            $.ajax({
                url: 'get_user.php',
                type: 'GET',
                success: function(response) {
                    const users = JSON.parse(response);
                    let userRows = '';
                    users.forEach(user => {
                        userRows += `
                            <tr>
                                <td class="py-2 px-4 border-b">${user.username}</td>
                                <td class="py-2 px-4 border-b">${user.role}</td>
                                <td class="py-2 px-4 border-b">${user.department}</td>
                                <td class="py-2 px-4 border-b">
                                    <i class="fas fa-edit text-green-500 cursor-pointer" onclick="editUser(${user.id})"></i>
                                    <i class="fas fa-trash text-red-500 cursor-pointer" onclick="deleteUser(${user.id})"></i>
                                </td>
                            </tr>
                        `;
                    });
                    $('#userTableBody').html(userRows);
                }
            });
        }

        function editUser(userId) {
            $.ajax({
                url: 'editUser.php',
                type: 'GET',
                data: { id: userId },
                success: function(response) {
                    const user = JSON.parse(response);
                    $('#editUserId').val(user.id);
                    $('#editUsername').val(user.username);
                    $('#editRole').val(user.role);
                    $('#editUserDepartment').val(user.department);
                    openModal('editUserModal');
                }
            });
        }

        function deleteUser(userId) {
            if (confirm('Tem certeza de que deseja excluir este usuário?')) {
                $.ajax({
                    url: 'delete_user.php',
                    type: 'POST',
                    data: { id: userId },
                    success: function(response) {
                        alert('Usuário excluído com sucesso!');
                        loadUsers();
                    }
                });
            }
        }

        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }
    </script>
</body>
</html>