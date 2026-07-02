function sanitizeText(str) {
  const div = document.createElement("div");
  div.textContent = str;
  return div.innerHTML;
}

function toggleDropdown() {
  const dropdown = document.getElementById("userDropdown");
  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
}

function togglePostOptions(postId) {
  const optionsMenu = document.getElementById(`post-options-${postId}`);
  optionsMenu.style.display =
    optionsMenu.style.display === "block" ? "none" : "block";
}

function toggleCommentSection(postId) {
  const commentSection = document.getElementById(`comment-section-${postId}`);
  commentSection.style.display =
    commentSection.style.display === "block" ? "none" : "block";
}

function openPostModal() {
  document.getElementById("postModal").style.display = "block";
  document.getElementById("postContent").value = "";
  const preview = document.getElementById("postImagePreview");
  preview.src = "";
  preview.style.display = "none";
}

function closePostModal() {
  document.getElementById("postModal").style.display = "none";
  document.getElementById("postContent").value = "";
  const preview = document.getElementById("postImagePreview");
  preview.src = "";
  preview.style.display = "none";
}

function openEditForm() {
  document.getElementById("editForm").style.display = "block";
}

function closeEditForm() {
  document.getElementById("editForm").style.display = "none";
}

function handleLogout(event) {
  event.preventDefault();
  fetch("logout.php", {
    method: "POST",
    headers: { "X-Requested-With": "XMLHttpRequest" },
  })
    .then((res) => res.json())
    .catch((error) => {
      console.error("Fetch error:", error);
      // Tiếp tục đăng xuất ngay cả khi fetch thất bại, vì localStorage đã được xóa trong logout.php
      localStorage.removeItem("currentUser");
      updateAuthLink();
      window.location.href = "Login.php";
    });
}

function updateAuthLink() {
  const authLink = document.getElementById("authLink");
  const currentUser = localStorage.getItem("currentUser");
  if (authLink) {
    if (currentUser) {
      authLink.innerHTML = `<a href="#" onclick="handleLogout(event)">
                                    <i class="fa-solid fa-sign-out-alt"></i> ĐĂNG XUẤT
                                 </a>`;
    } else {
      authLink.innerHTML = `<a href="Login.php">
                                    <i class="fa-regular fa-circle-user"></i> ĐĂNG NHẬP
                                  </a>`;
    }
  }
}
