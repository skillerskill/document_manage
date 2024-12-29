<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            width: 300px;
        }
    </style>
</head>
<body>
<div class="login-container">
    <h2 class="text-center">Login</h2>
    <form id="loginForm">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Login</button>
    </form>
    <div id="loginError" class="alert alert-danger mt-3" style="display: none;"></div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            const username = $('#username').val();
            const password = $('#password').val();
            $.ajax({
                url: 'login.php',
                type: 'POST',
                data: { username: username, password: password },
                success: function(response) {
                    if (response === 'success') {
                        window.location.href = 'dashboarde.php'; // Redirecionar para o dashboard
                    } else {
                        $('#loginError').text(response).show();
                    }
                }
            });
        });
    });
</script>
</body>
</html>