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
                    <i class="fas fa-envelope text-gray-600 text-xl"></i>
                    <span class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-1">7</span>
                </div>
                <div class="ml-4 flex items-center">
                    <span class="text-gray-600" id="userName"><?php echo $_SESSION["username"]; ?></span>
                    <img alt="User avatar" class="ml-2 rounded-full" height="40" src="https://thumbs.dreamstime.com/b/default-avatar-profile-vector-user-profile-default-avatar-profile-vector-user-profile-profile-179376714.jpg" width="40"/>
                </div>
            </div>
        </header>