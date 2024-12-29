<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Document Manager</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #343a40;
            min-height: 100vh;
        }
        .sidebar a {
            color: #fff;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar p-3">
            <h4 class="text-white">MAPTS<sup>1</sup></h4>
            <nav class="nav flex-column">
                <a class="nav-link" href="#"><i class="fas fa-home"></i> Início</a>
                <a class="nav-link" href="#"><i class="fas fa-file-alt"></i> DOCUMENTOS</a>
                <a class="nav-link" href="#"><i class="fas fa-building"></i> Departamento</a>
                <a class="nav-link" href="#"><i class="fas fa-folder"></i> Pastas</a>
                <a class="nav-link" href="#"><i class="fas fa-users"></i> Usuários</a>
            </nav>
            <button class="btn btn-success mt-4 w-100" data-target="#addDocumentModal" data-toggle="modal">Adiciona Arquivos</button>
            <!-- Botão de adicionar novos usuários, visível apenas para administradores -->
            <button class="btn btn-primary mt-4 w-100" data-target="#addUserModal" data-toggle="modal" id="addUserButton" style="display: none;">Adicionar Usuário</button>
        </div>
        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="input-group">
                    <input class="form-control" placeholder="pesquisar" type="text"/>
                    <div class="input-group-append">
                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                    </div>
                </div>
                <div class="d-flex align-items-center">
                    <button class="btn btn-primary mr-3">Gerar Relatório</button>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-bell mr-3"></i>
                        <i class="fas fa-envelope mr-3"></i>
                        <span>Celestino Fragoso</span>
                        <img alt="User avatar" class="rounded-circle ml-2" height="40" src="https://storage.googleapis.com/a1aa/image/OynKbh0ah8KaG97gppnzVnSVUsajgWf8KhKUSew4q35Ehd7TA.jpg" width="40"/>
                    </div>
                </div>
            </div>
            <!-- Dashboard Cards -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">DOCUMENTOS</h5>
                                <h2 class="card-text">8</h2>
                            </div>
                            <i class="fas fa-file-alt fa-3x text-muted"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">DEPARTAMENTO</h5>
                                <h2 class="card-text">12</h2>
                            </div>
                            <i class="fas fa-globe fa-3x text-muted"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">PASTA</h5>
                                <h2 class="card-text">10</h2>
                            </div>
                            <i class="fas fa-folder fa-3x text-muted"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="card-title">USUARIOS</h5>
                                <h2 class="card-text">18</h2>
                            </div>
                            <i class="fas fa-users fa-3x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Filters -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                        <div class="d-flex flex-column flex-md-row mb-3 mb-md-0">
                            <select class="form-control mr-2 mb-2 mb-md-0">
                                <option>Buscar por Departamento</option>
                            </select>
                            <select class="form-control mr-2 mb-2 mb-md-0">
                                <option>Buscar por Pastas</option>
                            </select>
                            <select class="form-control mr-2 mb-2 mb-md-0">
                                <option>Buscar por Subpastas</option>
                            </select>
                            <div class="input-group">
                                <input class="form-control" placeholder="pesquisar por nome" type="text"/>
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-success">Adiciona Arquivos</button>
                    </div>
                </div>
            </div>
            <!-- Document Table -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tabela de Documentos</h5>
                    <div class="mb-3">
                        <label for="filter">Filtrar</label>
                        <select class="form-control" id="filter">
                            <option>10</option>
                        </select>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nome do Arquivo</th>
                                    <th>Descrição</th>
                                    <th>Data de Envio</th>
                                    <th>Usuário</th>
                                    <th>Departamento</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody id="documentTableBody">
                                <!-- Document rows will be appended here by JavaScript -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Document Modal -->
    <div aria-hidden="true" aria-labelledby="addDocumentModalLabel" class="modal fade" id="addDocumentModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDocumentModalLabel">Adicionar Documento</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addDocumentForm" enctype="multipart/form_data">
                        <div class="form-group">
                            <label for="documentName">Nome do Arquivo</label>
                            <input class="form-control" name="documentName" id="documentName" required="" type="text"/>
                        </div>
                        <div class="form-group">
                            <label for="documentDescription">Descrição</label>
                            <input class="form-control" name="documentDescription" id="documentDescription" required="" type="text"/>
                        </div>
                        <div class="form-group">
                            <label for="documentDepartment">Departamento</label>
                            <select class="form-control" name="documentDepartment" id="documentDepartment" required="">
                                <option value="Recursos Humanos">Recursos Humanos</option>
                                <option value="Finanças">Finanças</option>
                                <option value="Marketing">Marketing</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="documentDepartmentId">Código do Departamento</label>
                            <select class="form-control" name="documentDepartmentId" id="documentDepartmentId" required="">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="documentFolder">Pasta</label>
                            <select class="form-control" name="documentFolder" id="documentFolder" required="">
                                <option value="Recursos Humanos">Recursos Humanos</option>
                                <option value="Finanças">Finanças</option>
                                <option value="Marketing">Marketing</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="documentFile">Ficheiro</label>
                            <input class="form-control" name="documentFile" id="documentFile" required="" type="file"/>
                        </div>
                        <button class="btn btn-primary" type="submit">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add User Modal -->
    <div aria-hidden="true" aria-labelledby="addUserModalLabel" class="modal fade" id="addUserModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">Adicionar Usuário</h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addUserForm">
                        <div class="form-group">
                            <label for="username">Nome de Usuário</label>
                            <input class="form-control" id="username" required="" type="text"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha</label>
                            <input class="form-control" id="password" required="" type="password"/>
                        </div>
                        <div class="form-group">
                            <label for="role">Função</label>
                            <select class="form-control" id="role" required="">
                                <option value="admin">Admin</option>
                                <option value="user">Usuário</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userFunction">Função do Usuário</label>
                            <select class="form-control" id="userFunction" required="">
                                <option value="Chefe do Departamento">Chefe do Departamento</option>
                                <option value="Técnico do Departamento">Técnico do Departamento</option>
                                <option value="Especialista do Departamento">Especialista do Departamento</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userDepartment">Departamento</label>
                            <select class="form-control" id="userDepartment" required="">
                                <option value="Recursos Humanos">Recursos Humanos</option>
                                <option value="Finanças">Finanças</option>
                                <option value="Marketing">Marketing</option>
                            </select>
                        </div>
                        <button class="btn btn-primary" type="submit">Adicionar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            // Check if the user is an admin
            const userRole = 'admin'; // This should be dynamically set based on the logged-in user
            if (userRole === 'admin') {
                $('#addUserButton').show();
            }

            // Load documents on page load
            loadDocuments();

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
                        $('#addDocumentModal').modal('hide');
                        alert(formData.get("documentFolder"));
                        loadDocuments();
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
                        $('#addUserModal').modal('hide');
                        alert('Usuário adicionado com sucesso!');
                    }
                });
            });
        });

        function loadDocuments() {
            $.ajax({
                url: 'get_documents.php',
                type: 'GET',
                success: function(response) {
                    const documents = JSON.parse(response);
                    let documentRows = '';
                    documents.forEach(document => {
                        documentRows += `
                            <tr>
                                <td>${document.name}</td>
                                <td>${document.description}</td>
                                <td>${document.upload_time}</td>
                                <td>${document.user_id}</td>
                                <td>${document.department}</td>
                                <td>
                                    <i class="fas fa-download text-primary cursor-pointer"></i>
                                    ${userRole === 'admin' ? `
                                    <i class="fas fa-edit text-success cursor-pointer"></i>
                                    <i class="fas fa-trash text-danger cursor-pointer"></i>
                                    ` : ''}
                                </td>
                            </tr>
                        `;
                    });
                    $('#documentTableBody').html(documentRows);
                }
            });
        }
    </script>
</body>
</html>