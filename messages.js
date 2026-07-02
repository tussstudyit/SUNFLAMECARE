// chat.js

// Hàm lấy danh sách người dùng từ server
async function fetchUsers() {
  try {
    const response = await fetch("fetch_users.php"); // Gọi API để lấy danh sách người dùng
    const users = await response.json();
    return users;
  } catch (error) {
    console.error("Error fetching users:", error);
    return [];
  }
}

// Hàm lấy danh sách tin nhắn gần nhất với một người dùng cụ thể
async function fetchLastMessage(userId) {
  try {
    const response = await fetch(
      `fetch_last_message.php?receiver_id=${userId}`
    );
    const message = await response.json();
    return message;
  } catch (error) {
    console.error("Error fetching last message:", error);
    return null;
  }
}

// Hàm hiển thị danh sách người dùng trong tab Cá nhân
async function renderGroupList(type) {
  const groupList = document.getElementById("group-list");
  groupList.innerHTML = ""; // Xóa danh sách hiện tại

  if (type === "personal") {
    const users = await fetchUsers();
    for (const user of users) {
      const lastMessage = await fetchLastMessage(user.id);
      const li = document.createElement("li");
      li.innerHTML = `
                <div class="group-item" onclick="loadChat(${user.id}, '${
        user.name
      }', '${user.avatar}')">
                    <img src="${
                      user.avatar || "img/default_avatar.jpg"
                    }" alt="avatar" />
                    <div>
                        <strong>${user.name}</strong>
                        <p>${
                          lastMessage ? lastMessage.content : "Chưa có tin nhắn"
                        }</p>
                    </div>
                </div>
            `;
      groupList.appendChild(li);
    }
  } else {
    // Xử lý tab Cộng đồng (nếu cần)
    groupList.innerHTML =
      '<li><div class="group-item">Chưa có nhóm cộng đồng</div></li>';
  }
}

// Hàm tải cuộc trò chuyện với một người dùng
async function loadChat(userId, name, avatar) {
  const chatBody = document.getElementById("chat-body");
  const groupTitle = document.getElementById("group-title");
  const groupAvatar = document.getElementById("group-avatar");

  // Cập nhật tiêu đề và ảnh đại diện của người nhận
  groupTitle.textContent = name;
  groupAvatar.src = avatar || "img/default_avatar.jpg";

  // Lấy tin nhắn giữa currentUser và userId
  try {
    const response = await fetch(`fetch_messages.php?receiver_id=${userId}`);
    const messages = await response.json();

    chatBody.innerHTML = ""; // Xóa tin nhắn cũ
    messages.forEach((msg) => {
      const isSender = msg.sender_id == currentUser.id; // So sánh với ID của người dùng hiện tại
      const messageDiv = document.createElement("div");
      messageDiv.className = `message ${isSender ? "sent" : "received"}`;
      messageDiv.innerHTML = `
                <div class="message-content">
                    ${
                      msg.image
                        ? `<img src="${msg.image}" alt="image" style="max-width: 200px;" />`
                        : ""
                    }
                    <p>${msg.content}</p>
                    <small>${new Date(
                      msg.created_at
                    ).toLocaleTimeString()}</small>
                </div>
            `;
      chatBody.appendChild(messageDiv);
    });

    // Cuộn xuống tin nhắn mới nhất
    chatBody.scrollTop = chatBody.scrollHeight;

    // Lưu ID người nhận để gửi tin nhắn
    chatBody.dataset.receiverId = userId;
  } catch (error) {
    console.error("Error loading chat:", error);
  }
}

// Hàm gửi tin nhắn
async function sendMessage() {
  const messageInput = document.getElementById("message-input");
  const fileInput = document.getElementById("fileInput");
  const chatBody = document.getElementById("chat-body");
  const receiverId = chatBody.dataset.receiverId;

  if (!receiverId) {
    alert("Vui lòng chọn một người để trò chuyện!");
    return;
  }

  const content = messageInput.value.trim();
  const file = fileInput.files[0];
  if (!content && !file) return;

  const formData = new FormData();
  formData.append("receiver_id", receiverId);
  formData.append("content", content);
  if (file) formData.append("image", file);

  try {
    const response = await fetch("send_message.php", {
      method: "POST",
      body: formData,
    });
    const result = await response.json();

    if (result.success) {
      // Thêm tin nhắn mới vào giao diện
      const messageDiv = document.createElement("div");
      messageDiv.className = "message sent";
      messageDiv.innerHTML = `
                <div class="message-content">
                    ${
                      file
                        ? `<img src="${result.image_url}" alt="image" style="max-width: 200px;" />`
                        : ""
                    }
                    <p>${content}</p>
                    <small>${new Date().toLocaleTimeString()}</small>
                </div>
            `;
      chatBody.appendChild(messageDiv);
      chatBody.scrollTop = chatBody.scrollHeight;

      // Xóa input
      messageInput.value = "";
      fileInput.value = "";
    } else {
      alert("Gửi tin nhắn thất bại!");
    }
  } catch (error) {
    console.error("Error sending message:", error);
    alert("Đã có lỗi xảy ra!");
  }
}
