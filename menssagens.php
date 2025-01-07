<?php
session_start();
?>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Document Manager - Mensagens</title>
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
                <a class="flex items-center py-2 text-blue-300" href="subpastas.php">
                    <i class="fas fa-folder-open mr-3"></i>
                    Subpastas
                </a>
                <a class="flex items-center py-2 text-blue-300" href="usuarios.php">
                    <i class="fas fa-users mr-3"></i>
                    Usuarios
                </a>
                <a class="flex items-center py-2 text-blue-300" href="mensagens.php">
                    <i class="fas fa-envelope mr-3"></i>
                    Mensagens
                </a>
                <a class="flex items-center py-2 text-blue-300" href="logout.php">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Logout
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-grow-1 flex flex-col">
        <!-- Header -->
        <?php include_once("header.php"); ?>
        <!-- Main content -->
        <main class="flex-1 p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold">Mensagens</h1>
                <button class="bg-blue-900 text-white px-4 py-2 rounded" data-bs-toggle="modal" data-bs-target="#messageModal">
                    <i class="fas fa-envelope mr-2"></i>
                    Nova Mensagem
                </button>
            </div>
            <div class="bg-white p-4 rounded shadow">
                <h2 class="text-blue-600 mb-4">Caixa de Entrada</h2>
                <div id="messageContainer" class="overflow-y-auto h-96 p-4 border border-gray-200 rounded">
                    <!-- Messages will be appended here by JavaScript -->
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="messageModalLabel">Enviar Mensagem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="sendMessageForm" method="post">
                    <div class="mb-3">
                        <label for="departmentSelect" class="form-label">Departamento</label>
                        <select class="form-select" id="departmentSelect" name="department">
                            <!-- Options will be populated by JavaScript -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="messageContent" class="form-label">Mensagem</label>
                        <textarea class="form-control" id="messageContent" name="message" rows="4"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
function loadMessages() {
    $.ajax({
        url: 'get_messages.php',
        type: 'GET',
        success: function(response) {
            const data = JSON.parse(response);
            const messageContainer = $('#messageContainer');
            const userId = <?php echo $_SESSION['user_id']; ?>;
            messageContainer.empty();
            if (data.messages && data.messages.length > 0) {
                const messages = data.messages;
                let messageHtml = '';
                messages.forEach(message => {
                    const isUserMessage = message.sender_id == userId;
                    messageHtml += `
                        <div class="mb-4 ${isUserMessage ? 'text-right' : ''}">
                            <div class="flex items-center mb-2 ${isUserMessage ? 'justify-end' : ''}">
                                <img src="https://thumbs.dreamstime.com/b/default-avatar-profile-vector-user-profile-default-avatar-profile-vector-user-profile-profile-179376714.jpg" alt="Profile picture of ${message.sender_name}" class="w-10 h-10 rounded-full ${isUserMessage ? 'ml-3' : 'mr-3'}">
                                <div>
                                    <p class="text-sm font-semibold">${message.sender_name}</p>
                                    <p class="text-xs text-gray-500">${new Date(message.timestamp).toLocaleString()}</p>
                                </div>
                            </div>
                            <div class="inline-block max-w-xs p-3 rounded-lg ${isUserMessage ? 'bg-blue-500 text-white' : 'bg-gray-300'}">
                                <p>${message.content}</p>
                            </div>
                        </div>
                    `;
                });
                messageContainer.html(messageHtml);
            } else {
                const noMessagesElement = `
                    <div class="p-4 text-center text-gray-500">
                        Não há mensagens disponíveis.
                    </div>
                `;
                messageContainer.html(noMessagesElement);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading messages:', error);
        }
    });
}

function loadDepartments() {
    $.ajax({
        url: 'get_recipients.php',
        type: 'GET',
        success: function(response) {
            try {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    const departments = data.departments;
                    let departmentOptions = '<option value="" disabled selected>Selecionar Departamento</option>';
                    
                    departments.forEach(department => {
                        departmentOptions += `<option value="${department.id}">${department.name}</option>`;
                    });
                    $('#departmentSelect').html(departmentOptions);
                } else {
                    console.error('Error loading departments:', data.message);
                }
            } catch (error) {
                console.error('Error parsing JSON response:', error);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error loading departments:', error);
        }
    });
}

$(document).ready(function() {
    // Load messages on page load
    
    setInterval(() => {
        loadMessages();
    }, 500);

    // Load departments on page load
    loadDepartments();

    // Send message form submission
    $('#sendMessageForm').on('submit', function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        const department = $('#departmentSelect').val();
        const message = $('#messageContent').val();
        alert(`Department: ${department}\nMessage: ${message}`);
        $.ajax({
            url: 'send_message.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                const data = JSON.parse(response);
                if (data.status === 'success') {
                    $('#messageModal').modal('hide');
                    loadMessages();
                } else {
                    console.error('Error sending message:', data.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error sending message:', error);
            }
        });
    });
});
</script>

</body>
</html>