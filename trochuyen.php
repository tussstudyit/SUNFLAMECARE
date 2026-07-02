<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Cộng đồng</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      integrity="sha512-...tự động sinh ra..."
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
      <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@300;400;600&display=swap"
      rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&family=Open+Sans:wght@300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <!-- Font Awesome Icons -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <!-- Bootstrap CSS -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <!-- Swiper JS CSS -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="trochuyen.css" />
  </head>
  <body>
<!-- Header -->
<nav class="navbar">
  <!-- Logo và slogan -->
  <div class="navbar-logo">
    <a class="logo" href="/">
                      <img src="img/snapedit_1746947524060.png" alt="Logo SUNFLAMECARE Vietnam" />

    </a>
    <div class="text-container">
      <span class="text-main">SUNFLAMECARE</span>
      <span class="text-sub">Thắp sáng hy vọng - Trao gửi yêu thương</span>
    </div>
  </div>

  <!-- Menu chính -->
  <ul class="navbar-menu">
    <li><a href="trangchu.php"><i class="fa fa-home"></i>&nbsp;TRANG CHỦ</a></li>
    <li><a href="taichinh.php"><i class="fa fa-flag"></i>&nbsp;TÀI CHÍNH</a></li>
    <li><a href="congdong.php"><i class="fa fa-users"></i>&nbsp;CỘNG ĐỒNG</a></li>
    <li><a href="hoatdong.php"><i class="fas fa-newspaper"></i>&nbsp;HOẠT ĐỘNG</a></li>
    <li><a href="lienhe.php"><i class="fa fa-phone"></i>&nbsp;LIÊN HỆ</a></li>
  </ul>

  <!-- Phần đăng nhập hoặc avatar -->
  <div class="navbar-actions">
    <?php if (isset($_SESSION['name'])): ?>
      <div class="user-dropdown">
        <div class="user-info" onclick="toggleDropdown()">
          <img src="<?= $_SESSION['avatar'] ?? 'img/default_avatar.jpg' ?>" alt="avatar">
          <span><?= $_SESSION['name'] ?></span>
        </div>
        <ul class="dropdown-menu" id="dropdownMenu">
          <li><a href="Home.php">Trang cá nhân</a></li>
          <li><a href="hoatdong.php">Chiến dịch của tôi</a></li>
          <li><a href="logout.php">Đăng xuất</a></li>
        </ul>
      </div>
    <?php else: ?>
      <a href="Login.php" class="nav-login"><i class="fa fa-user"></i>&nbsp;ĐĂNG NHẬP</a>
    <?php endif; ?>
    
    <!-- Nút menu cho responsive -->
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
  </div>
</nav>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    <!-- Main JavaScript -->
    <script src="congdong.js"></script>

    <script>
      function toggleMenu() {
        const menu = document.querySelector(".navbar_menu");
        console.log("Toggle clicked", menu); // Debug
        menu.classList.toggle("active");
      }
    </script>
    <script>
      window.addEventListener("scroll", function () {
        const navbar = document.querySelector(".navbar");
        const header = document.querySelector("#site-header");
        if (window.scrollY > 50) {
          navbar.classList.add("scrolled");
          header.classList.add("scrolled");
        } else {
          navbar.classList.remove("scrolled");
          header.classList.remove("scrolled");
        }
      });
    </script>




<script src="anhten.js"></script>

    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Chats</h3>
        <div class="tab">
            <button class="tablink active">Cá nhân</button>
            <button class="tablink">Cộng đồng</button>
        </div>
        <input type="text" class="search-box" placeholder="Tìm kiếm người dùng" />
        <ul class="group-list" id="group-list">
            <!-- Danh sách người dùng/nhóm sẽ được thêm bằng JavaScript -->
        </ul>
    </div>

    <!-- Chat Container -->
    <div class="chat-container" id="chat-container">
        <div class="chat-box">
            <div class="chat-header">
                <div class="group-info">
                    <img id="group-avatar" src="avatar.jpg" alt="avatar" />
                    <div>
                        <strong id="group-title">Chọn một người dùng/nhóm để bắt đầu</strong>
                        <small>Đà Nẵng</small>
                    </div>
                </div>
                <div class="options">...</div>
            </div>
            <div class="chat-body" id="chat-body">
                <!-- Tin nhắn sẽ thêm vào đây -->
            </div>
            <div class="chat-input">
                <input type="text" id="message-input" placeholder="Nhập tin nhắn..." />
                <label for="fileInput" style="cursor: pointer;">
                    <i class="fa fa-camera" style="font-size: 30px; color: #555; margin-right: 4px;"></i>
                </label>
                <input type="file" id="fileInput" accept="image/*" style="display: none;" />
                <button onclick="sendMessage()">Gửi</button>
            </div>
        </div>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    <script src="congdong.js"></script>

    <script>
        // Truyền thông tin người dùng từ PHP sang JavaScript
        const currentUser = {
            name: "<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') : 'Guest'; ?>",
            avatar: "<?php echo isset($_SESSION['avatar']) ? htmlspecialchars($_SESSION['avatar'], ENT_QUOTES, 'UTF-8') : 'img/default_avatar.jpg'; ?>",
            user_id: "<?php echo isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id'], ENT_QUOTES, 'UTF-8') : '0'; ?>"
        };

        let currentChatId = null; // Thay currentGroupId bằng currentChatId để hỗ trợ cả người dùng và nhóm

        // Bật/tắt menu trên thiết bị di động
function toggleMenu() {
  const navbarMenu = document.querySelector(".navbar-menu");
  const menuToggle = document.querySelector(".menu-toggle");
  if (navbarMenu && menuToggle) {
    navbarMenu.classList.toggle("active");
    menuToggle.classList.toggle("active");
    document.body.classList.toggle("menu-open");
  }
}

// Gắn sự kiện cho menu toggle
const menuToggle = document.querySelector(".menu-toggle");
if (menuToggle) {
  menuToggle.addEventListener("click", function (event) {
    toggleMenu();
    event.stopPropagation(); // Ngăn sự kiện click lan tỏa
  });

  menuToggle.addEventListener("touchstart", function (event) {
    event.preventDefault(); // Ngăn hành vi mặc định (như scroll)
    toggleMenu();
    event.stopPropagation(); // Ngăn sự kiện touchstart lan tỏa
  });
}

// Đóng menu khi nhấn hoặc chạm ra ngoài
function closeMenuOnOutsideInteraction(event) {
  const menu = document.querySelector(".navbar-menu");
  const menuToggle = document.querySelector(".menu-toggle");
  if (menu && menuToggle && menu.classList.contains("active")) {
    const target = event.target;
    if (
      !menu.contains(target) &&
      !menuToggle.contains(target) &&
      target !== menuToggle
    ) {
      menu.classList.remove("active");
      menuToggle.classList.remove("active");
      document.body.classList.remove("menu-open");
    }
  }
}

// Gắn sự kiện click và touchstart để đóng menu
document.addEventListener("click", closeMenuOnOutsideInteraction);
document.addEventListener("touchstart", closeMenuOnOutsideInteraction);

// Đóng menu khi nhấn vào một mục menu
document.querySelectorAll(".navbar-menu li a").forEach((item) => {
  item.addEventListener("click", () => {
    const navbarMenu = document.querySelector(".navbar-menu");
    const menuToggle = document.querySelector(".menu-toggle");
    if (navbarMenu && menuToggle) {
      navbarMenu.classList.remove("active");
      menuToggle.classList.remove("active");
      document.body.classList.remove("menu-open");
    }
  });
});

        const tablinks = document.querySelectorAll('.tablink');
        const groupList = document.getElementById('group-list');

        tablinks.forEach((tab, index) => {
            tab.addEventListener('click', () => {
                tablinks.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
                renderGroupList(index === 0 ? 'personal' : 'community');
                if (pollingInterval) {
                    clearInterval(pollingInterval); // Dừng polling khi chuyển tab
                }
            });
        });

        // Fetch and render user/group list
        async function renderGroupList(tab) {
            groupList.innerHTML = "";
            let items = [];
            if (tab === "personal") {
                try {
                    const response = await fetch("get_users.php");
                    items = await response.json();
                    if (items.error) throw new Error(items.error);
                    items = items.filter(item => item.id != currentUser.user_id);
                } catch (error) {
                    console.error("Error fetching users:", error);
                    return;
                }
            } else if (tab === "community") {
                try {
                    const response = await fetch("get_groups.php");
                    items = await response.json();
                    if (items.error) throw new Error(items.error);
                } catch (error) {
                    console.error("Error fetching groups:", error);
                    return;
                }
            }
            items.forEach((item) => {
                const li = document.createElement("li");
                li.className = "community";
                li.setAttribute("data-id", tab === "personal" ? item.id : item.group_id);
                li.setAttribute("data-title", tab === "personal" ? item.name : item.title);
                li.setAttribute("data-img", tab === "personal" ? item.avatar : item.avatar || 'img/default_group.jpg');
                li.setAttribute("data-type", tab);
                li.innerHTML = `
                    <img src="${tab === 'personal' ? item.avatar : item.avatar || 'img/default_group.jpg'}" alt="${tab === 'personal' ? 'user' : 'group'}" />
                    <div>
                        <strong>${tab === 'personal' ? item.name : item.title}</strong><br />
                    </div>
                `;
                li.onclick = () => showChat(li);
                li.style.display = "flex";
                groupList.appendChild(li);
            });
        }

        // Show chat (for both users and groups)
        async function showChat(element) {
            const title = element.getAttribute("data-title");
            const imgSrc = element.getAttribute("data-img");
            currentChatId = element.getAttribute("data-id");
            const chatType = element.getAttribute("data-type");

            document.getElementById("group-title").textContent = title;
            document.getElementById("group-avatar").src = imgSrc;
            document.getElementById("chat-container").style.display = "block";

            if (chatType === "personal") {
                await renderPrivateMessages(currentChatId);
                startPolling(currentChatId, 'personal'); // Bắt đầu polling cho chat cá nhân
            } else {
                await renderChatMessages(currentChatId);
                startPolling(currentChatId, 'group'); // Bắt đầu polling cho chat nhóm
            }
        }

        // Fetch and render private messages
        async function renderPrivateMessages(receiverId) {
            const chatBody = document.getElementById("chat-body");
            chatBody.innerHTML = "";

            try {
                const response = await fetch(`get_private_messages.php?sender_id=${currentUser.user_id}&receiver_id=${receiverId}`);
                const messages = await response.json();

                if (messages.error) {
                    if (messages.error === 'Unauthorized access') {
                        chatBody.innerHTML = '<div class="message error">Bạn không có quyền xem tin nhắn này.</div>';
                    } else {
                        throw new Error(messages.error);
                    }
                    return;
                }

                messages.forEach((msg) => {
                    const isCurrentUser = msg.sender_id == currentUser.user_id;
                    const div = document.createElement("div");
                    div.className = `message ${isCurrentUser ? "user" : "other"}`;

                    let contentHtml = "";
                    if (isCurrentUser) {
                        contentHtml = `
                            <div class="message-content">
                                ${msg.content ? `<span>${msg.content}</span><br />` : ""}
                                ${msg.image ? `<img src="${msg.image}" alt="chat-image" style="max-width: 200px; margin-top: 5px;" /><br />` : ""}
                                <small>${new Date(msg.timestamp).toLocaleTimeString("vi-VN")}</small>
                            </div>
                        `;
                    } else {
                        contentHtml = `
                            <img src="${msg.avatar || 'img/default_avatar.jpg'}" alt="avatar" class="message-avatar" />
                            <div class="message-content">
                                <strong>${msg.name}</strong><br />
                                ${msg.content ? `<span>${msg.content}</span><br />` : ""}
                                ${msg.image ? `<img src="${msg.image}" alt="chat-image" style="max-width: 200px; margin-top: 5px;" /><br />` : ""}
                                <small>${new Date(msg.timestamp).toLocaleTimeString("vi-VN")}</small>
                            </div>
                        `;
                    }
                    div.innerHTML = contentHtml;
                    chatBody.appendChild(div);
                });

                chatBody.scrollTop = chatBody.scrollHeight;
            } catch (error) {
                console.error("Error fetching private messages:", error);
            }
        }

        // Fetch and render group messages
        async function renderChatMessages(groupId) {
            const chatBody = document.getElementById("chat-body");
            chatBody.innerHTML = "";

            try {
                const response = await fetch(`get_messages.php?group_id=${groupId}`);
                const messages = await response.json();

                if (messages.error) {
                    chatBody.innerHTML = '<div class="message error">Không thể tải tin nhắn nhóm: ' + messages.error + '</div>';
                    return;
                }

                messages.forEach((msg) => {
                    const isCurrentUser = msg.user_id == currentUser.user_id;
                    const div = document.createElement("div");
                    div.className = `message ${isCurrentUser ? "user" : "other"}`;

                    let contentHtml = "";
                    if (isCurrentUser) {
                        contentHtml = `
                            <div class="message-content">
                                ${msg.content ? `<span>${msg.content}</span><br />` : ""}
                                ${msg.image ? `<img src="${msg.image}" alt="chat-image" style="max-width: 200px; margin-top: 5px;" /><br />` : ""}
                                <small>${new Date(msg.timestamp).toLocaleTimeString("vi-VN")}</small>
                            </div>
                        `;
                    } else {
                        contentHtml = `
                            <img src="${msg.avatar || 'img/default_avatar.jpg'}" alt="avatar" class="message-avatar" />
                            <div class="message-content">
                                <strong>${msg.name}</strong><br />
                                ${msg.content ? `<span>${msg.content}</span><br />` : ""}
                                ${msg.image ? `<img src="${msg.image}" alt="chat-image" style="max-width: 200px; margin-top: 5px;" /><br />` : ""}
                                <small>${new Date(msg.timestamp).toLocaleTimeString("vi-VN")}</small>
                            </div>
                        `;
                    }
                    div.innerHTML = contentHtml;
                    chatBody.appendChild(div);
                });

                chatBody.scrollTop = chatBody.scrollHeight;
            } catch (error) {
                console.error("Error fetching group messages:", error);
                chatBody.innerHTML = '<div class="message error">Lỗi khi tải tin nhắn nhóm.</div>';
            }
        }

        // Send message
        async function sendMessage() {
            const messageInput = document.getElementById("message-input");
            const fileInput = document.getElementById("fileInput");
            const content = messageInput.value.trim();
            const file = fileInput.files[0];

            if (!content && !file) return;
            if (!currentChatId) return;

            const formData = new FormData();
            if (tablinks[0].classList.contains('active')) { // Tab "Cá nhân"
                formData.append("sender_id", currentUser.user_id);
                formData.append("receiver_id", currentChatId);
                formData.append("type", "private");
                if (content) formData.append("content", content);
                if (file) formData.append("image", file);
                try {
                    const response = await fetch("send_private_message.php", {
                        method: "POST",
                        body: formData,
                    });
                    const result = await response.json();
                    if (result.error) throw new Error(result.error);
                    messageInput.value = "";
                    fileInput.value = "";
                    await renderPrivateMessages(currentChatId); // Hiển thị ngay sau khi gửi
                } catch (error) {
                    console.error("Error sending private message:", error);
                }
            } else { // Tab "Cộng đồng"
                formData.append("group_id", currentChatId);
                formData.append("user_id", currentUser.user_id);
                formData.append("type", "group");
                if (content) formData.append("content", content);
                if (file) formData.append("image", file);
                try {
                    const response = await fetch("send_message.php", {
                        method: "POST",
                        body: formData,
                    });
                    const result = await response.json();
                    if (result.error) throw new Error(result.error);
                    messageInput.value = "";
                    fileInput.value = "";
                    await renderChatMessages(currentChatId); // Hiển thị ngay sau khi gửi
                } catch (error) {
                    console.error("Error sending group message:", error);
                }
            }
        }

        // Biến toàn cục để theo dõi last_message_id và interval
        let lastMessageId = 0;
        let pollingInterval = null;

        // Hàm kiểm tra tin nhắn mới định kỳ
        async function checkNewMessages(id, type) {
            try {
                let response;
                if (type === 'personal') {
                    response = await fetch(`get_private_messages.php?sender_id=${currentUser.user_id}&receiver_id=${id}&last_id=${lastMessageId}`);
                } else {
                    response = await fetch(`get_messages.php?group_id=${id}&last_id=${lastMessageId}`);
                }
                const messages = await response.json();

                if (messages.error) {
                    if (messages.error !== 'Unauthorized access') {
                        console.error("Error in checkNewMessages:", messages.error);
                    }
                    return;
                }

                if (messages.length > 0) {
                    lastMessageId = messages[messages.length - 1].id;
                    if (type === 'personal' && tablinks[0].classList.contains('active') && currentChatId == id) {
                        renderPrivateMessages(id); // Cập nhật tin nhắn cá nhân
                    } else if (type === 'group' && !tablinks[0].classList.contains('active') && currentChatId == id) {
                        renderChatMessages(id); // Cập nhật tin nhắn nhóm
                    }
                }
            } catch (error) {
                console.error("Error checking new messages:", error);
            }
        }

        // Hàm khởi tạo polling khi hiển thị chat
        function startPolling(id, type) {
            if (pollingInterval) {
                clearInterval(pollingInterval); // Dừng interval cũ nếu có
            }
            if (currentChatId) {
                checkNewMessages(id, type); // Kiểm tra ngay lập tức
                pollingInterval = setInterval(() => checkNewMessages(id, type), 2000); // Kiểm tra mỗi 2 giây
            }
        }

        // Initialize
        window.addEventListener("DOMContentLoaded", () => {
            renderGroupList("personal");
        });
    </script>
</body>
</html>


