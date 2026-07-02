const currentUser = {
  name: "<?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8') : 'Guest'; ?>",
  avatar:
    "<?php echo isset($_SESSION['avatar']) ? htmlspecialchars($_SESSION['avatar'], ENT_QUOTES, 'UTF-8') : 'img/default_avatar.jpg'; ?>",
  user_id:
    "<?php echo isset($_SESSION['user_id']) ? htmlspecialchars($_SESSION['user_id'], ENT_QUOTES, 'UTF-8') : '0'; ?>",
};

let currentGroupId = null;

// Fetch and render group list
async function renderGroupList(tab) {
  const groupList = document.getElementById("group-list");
  groupList.innerHTML = "";

  let groups = [];
  if (tab === "community") {
    try {
      const response = await fetch("get_groups.php");
      groups = await response.json();
      if (groups.error) throw new Error(groups.error);
    } catch (error) {
      console.error("Error fetching groups:", error);
      return;
    }
  }

  groups.forEach((group) => {
    const li = document.createElement("li");
    li.className = "community";
    li.setAttribute("data-id", group.group_id);
    li.setAttribute("data-title", group.title);
    li.setAttribute("data-img", group.avatar);
    li.innerHTML = `
            <img src="${group.avatar}" alt="group" />
            <div>
                <strong>${group.title}</strong><br />
            </div>
        `;
    li.onclick = () => showGroup(li);
    li.style.display = tab === "personal" ? "none" : "flex";
    groupList.appendChild(li);
  });
  console.log("Rendered groups for tab:", tab, groups);
}

// Show group chat
async function showGroup(element) {
  const title = element.getAttribute("data-title");
  const imgSrc = element.getAttribute("data-img");
  currentGroupId = element.getAttribute("data-id");

  document.getElementById("group-title").textContent = title;
  document.getElementById("group-avatar").src = imgSrc;
  document.getElementById("chat-container").style.display = "block";

  await renderChatMessages(currentGroupId);
}

// Fetch and render messages
async function renderChatMessages(groupId) {
  const chatBody = document.getElementById("chat-body");
  chatBody.innerHTML = "";

  try {
    const response = await fetch(`get_messages.php?group_id=${groupId}`);
    const messages = await response.json();

    if (messages.error) throw new Error(messages.error);

    messages.forEach((msg) => {
      const div = document.createElement("div");
      div.className = `message ${
        msg.name === currentUser.name ? "user" : "other"
      }`;
      let contentHtml = `
                <img src="${
                  msg.avatar || "img/default_avatar.jpg"
                }" alt="avatar" class="message-avatar" />
                <div class="message-content">
                    <strong>${msg.name}</strong><br />
            `;
      if (msg.content) contentHtml += `<span>${msg.content}</span><br />`;
      if (msg.image)
        contentHtml += `<img src="${msg.image}" alt="chat-image" style="max-width: 200px; margin-top: 5px;" /><br />`;
      contentHtml += `<small>${new Date(msg.timestamp).toLocaleTimeString(
        "vi-VN"
      )}</small></div>`;
      div.innerHTML = contentHtml;
      chatBody.appendChild(div);
    });

    chatBody.scrollTop = chatBody.scrollHeight;
  } catch (error) {
    console.error("Error fetching messages:", error);
  }
}

// Send message
async function sendMessage() {
  const messageInput = document.getElementById("message-input");
  const fileInput = document.getElementById("fileInput");
  const content = messageInput.value.trim();
  const file = fileInput.files[0];

  if (!content && !file) return;
  if (!currentGroupId) return;

  const formData = new FormData();
  formData.append("group_id", currentGroupId);
  formData.append("user_id", currentUser.user_id);
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
    await renderChatMessages(currentGroupId);
  } catch (error) {
    console.error("Error sending message:", error);
  }
}

// Initialize
window.addEventListener("DOMContentLoaded", () => {
  renderGroupList("personal");
});
