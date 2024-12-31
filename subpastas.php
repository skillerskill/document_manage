<?php
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