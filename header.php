<header class="flex items-center justify-between bg-white p-4 shadow">
    <div class="flex items-center">
        <input class="border border-gray-300 rounded-l px-4 py-2" placeholder="pesquisar" type="text" id="searchName"/>
        <button class="bg-blue-900 text-white px-4 py-2 rounded-r" id="searchButton">
            <i class="fas fa-search"></i>
        </button>
    </div>
    <div class="flex items-center">
        <div class="relative">
            <i class="fas fa-bell text-gray-600 text-xl cursor-pointer" id="notificationIcon"></i>
            <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1" id="notificationCount">0</span>
            <div class="absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded shadow-lg hidden" id="notificationDropdown">
                <div class="p-4">
                    <h4 class="text-gray-600">Notificações</h4>
                    <ul id="notificationList" class="list-none p-0">
                        <!-- Notifications will be appended here by JavaScript -->
                    </ul>
                </div>
            </div>
        </div>
        <div class="relative ml-4">
            <a href="menssagens.php" id="messageIcon">
                <i class="fas fa-envelope text-gray-600 text-xl"></i>
                <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1" id="messageCount">0</span>
            </a>
        </div>
        <div class="ml-4 flex items-center">
            <span class="text-gray-600" id="userName"><?php echo $_SESSION["username"]; ?></span>
            <img alt="User avatar" class="ml-2 rounded-full" height="40" src="https://thumbs.dreamstime.com/b/default-avatar-profile-vector-user-profile-default-avatar-profile-vector-user-profile-profile-179376714.jpg" width="40"/>
        </div>
    </div>
</header>

<script>
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

                notifications.forEach(notification => {
                    if (!notification.is_read) {
                        unreadCount++;
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
                if (unreadCount > 0) {
                    $('#notificationCount').removeClass('hidden');
                } else {
                    $('#notificationCount').addClass('hidden');
                }
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

function checkNewMessages() {
    $.ajax({
        url: 'check_new_messages.php',
        type: 'GET',
        success: function(response) {
            const data = JSON.parse(response);
            if (data.new_messages > 0) {
                $('#messageCount').text(data.new_messages).removeClass('hidden');
            } else {
                $('#messageCount').addClass('hidden');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error checking new messages:', error);
        }
    });
}

function markMessagesAsRead() {
    $.ajax({
        url: 'mark_messages_read.php',
        type: 'POST',
        success: function(response) {
            const data = JSON.parse(response);
            if (data.status === 'success') {
                $('#messageCount').addClass('hidden');
            } else {
                console.error('Error marking messages as read:', data.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error marking messages as read:', error);
        }
    });
}

$(document).ready(function() {
    // Check for new messages periodically
    setInterval(() => {
        checkNewMessages();
    }, 5000);

    // Load notifications periodically
    setInterval(() => {
        loadNotifications();
    }, 2500);

    // Toggle notification dropdown
    $('#notificationIcon').on('click', function() {
        $('#notificationDropdown').toggleClass('hidden');
    });

    // Clear message count and mark messages as read when message icon is clicked
    $('#messageIcon').on('click', function() {
        markMessagesAsRead();
    });

    // Clear message count and mark messages as read if on the messages page
    if (window.location.pathname.endsWith('mensagens.php')) {
        markMessagesAsRead();
    }
});
</script>