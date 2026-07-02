// function expandPostBox() {
//   document.getElementById("postModal").style.display = "block";
// }

// function closePostModal() {
//   document.getElementById("postModal").style.display = "none";
// }

// Biến toàn cục để lưu trữ bình luận
const commentsCache = {};

function toggleOptions(postId) {
  const menu = document.getElementById(`options-${postId}`);
  if (menu) {
    menu.style.display = menu.style.display === "block" ? "none" : "block";
  }
}

function expandPostBox() {
  const modal = document.getElementById("postModal");
  if (modal) {
    modal.style.display = "block";
    // Reset form
    modal.querySelector("#newPostContent").value = "";
    modal.querySelector("#newImagePreview").innerHTML = "";
    modal.querySelector("#newPostImage").value = "";
  } else {
    console.error("Không tìm thấy modal để mở!");
    alert("Lỗi: Không tìm thấy modal để đăng bài!");
  }
}

function closePostModal() {
  const modal = document.getElementById("postModal");
  if (modal) {
    modal.style.display = "none";
  } else {
    console.error("Không tìm thấy modal để đóng!");
  }
}

function likePost(postId) {
  fetch("like_post.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `post_id=${postId}`,
  })
    .then((response) => {
      if (!response.ok) throw new Error("Lỗi khi thích bài viết");
      return response.text();
    })
    .then((data) => {
      try {
        const result = JSON.parse(data);
        if (result.success) {
          const likesSpan = document.getElementById(`likes-${postId}`);
          const likeButton = document.querySelector(
            `#post-${postId} .action-like`
          );
          if (likesSpan && likeButton) {
            likesSpan.textContent = `${result.likes} Thích`;
            if (result.liked) likeButton.classList.add("liked");
            else likeButton.classList.remove("liked");
          }
        } else {
          alert(
            "Lỗi khi thích bài viết: " + (result.error || "Không xác định")
          );
        }
      } catch (e) {
        console.error("Dữ liệu không hợp lệ:", data);
        alert("Lỗi: Dữ liệu từ server không hợp lệ!");
      }
    })
    .catch((error) => {
      console.error("Lỗi kết nối:", error);
      alert("Lỗi kết nối, vui lòng thử lại!");
    });
}

function toggleCommentSection(postId) {
  const section = document.getElementById(`comments-section-${postId}`);
  if (section) {
    if (section.style.display === "none") {
      section.style.display = "block";
      loadComments(postId);
    } else {
      section.style.display = "none";
    }
  }
}

function loadComments(postId) {
  const commentsList = document.getElementById(`comments-list-${postId}`);
  const commentsCount = document.getElementById(`comments-count-${postId}`);

  if (!commentsList || !commentsCount) {
    console.error(`Không tìm thấy phần tử cho postId: ${postId}`);
    return;
  }

  if (commentsCache[postId] && !commentsCache[postId].needsRefresh) {
    renderComments(postId, commentsCache[postId].data);
  } else {
    fetch(`get_group_comments.php?post_id=${postId}`)
      .then((response) => {
        if (!response.ok) throw new Error("Lỗi khi tải bình luận từ server");
        return response.text();
      })
      .then((data) => {
        try {
          const comments = JSON.parse(data);
          commentsCache[postId] = { data: comments, needsRefresh: false };
          renderComments(postId, comments);
        } catch (e) {
          console.error("Dữ liệu không hợp lệ:", data);
          commentsList.innerHTML =
            "<p>Lỗi: Dữ liệu bình luận không hợp lệ.</p>";
        }
      })
      .catch((error) => {
        console.error("Lỗi khi tải bình luận:", error);
        commentsList.innerHTML = "<p>Không thể tải bình luận.</p>";
      });
  }
}

function renderComments(postId, comments) {
  const commentsList = document.getElementById(`comments-list-${postId}`);
  const commentsCount = document.getElementById(`comments-count-${postId}`);
  if (!commentsList || !commentsCount) return;

  commentsList.innerHTML = "";
  commentsCount.textContent = `${comments.length} Bình luận`;
  comments.forEach((comment) => {
    const commentDiv = document.createElement("div");
    commentDiv.className = "comment";
    commentDiv.innerHTML = `
      <img src="${comment.avatar}" alt="avatar" class="comment-avatar">
      <div class="comment-content">
        <span class="commenter-name">${comment.name}</span>
        <p>${comment.content}</p>
        <small>${new Date(comment.created_at).toLocaleString("vi-VN", {
          day: "2-digit",
          month: "2-digit",
          year: "numeric",
          hour: "2-digit",
          minute: "2-digit",
        })}</small>
      </div>
    `;
    commentsList.appendChild(commentDiv);
  });

  commentsList.scrollTop = commentsList.scrollHeight;
}

function submitComment(event, postId) {
  event.preventDefault();
  const form = event.target;
  const content = form.querySelector("input").value.trim();

  if (!content) {
    alert("Nội dung bình luận không được để trống!");
    return;
  }

  fetch("add_comment.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `post_id=${postId}&content=${encodeURIComponent(content)}`,
  })
    .then((response) => {
      if (!response.ok) throw new Error("Lỗi khi gửi bình luận");
      return response.text();
    })
    .then((data) => {
      try {
        const result = JSON.parse(data);
        if (result.success) {
          alert("Bình luận thành công!");
          form.reset();
          if (!commentsCache[postId])
            commentsCache[postId] = { data: [], needsRefresh: false };
          const newCommentData = {
            avatar: result.comment.avatar,
            name: result.comment.name,
            content: result.comment.content,
            created_at: result.comment.created_at,
          };
          commentsCache[postId].data.push(newCommentData);
          renderComments(postId, commentsCache[postId].data);
        } else {
          alert(
            "Lỗi khi thêm bình luận: " + (result.error || "Không xác định")
          );
        }
      } catch (e) {
        console.error("Dữ liệu không hợp lệ:", data);
        alert("Lỗi: Dữ liệu từ server không hợp lệ!");
      }
    })
    .catch((error) => {
      console.error("Lỗi kết nối:", error);
      alert("Lỗi kết nối, vui lòng thử lại!");
    });
}

function openEditPostModal(postId, content, image) {
  const decodedContent = decodeURIComponent(content);
  const modal = document.createElement("div");
  modal.className = "post-modal";
  modal.style.display = "flex";
  modal.innerHTML = `
    <div class="post-modal-content">
      <textarea id="postText">${decodedContent}</textarea>
      <label for="postImage" class="icon-upload">
        <i class="fa-solid fa-image"></i> Thêm ảnh
      </label>
      <input type="file" id="postImage" accept="image/*" style="display: none;" />
      <div id="imagePreview" class="image-preview">
        ${image ? `<img src="${image}" alt="Current Image">` : ""}
      </div>
      <div class="modal-buttons">
       <button onclick="closePostModal(this.closest('.post-modal'))">Hủy</button>

      <button class="green-btn" onclick="savePost(${postId}, this) " style="background: green;">Lưu</button>

      </div>
    </div>
  `;
  document.body.appendChild(modal);

  const editFileInput = modal.querySelector("#postImage");
  const editPreviewContainer = modal.querySelector("#imagePreview");
  if (editFileInput && editPreviewContainer) {
    editFileInput.addEventListener("change", function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          editPreviewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
        };
        reader.readAsDataURL(file);
      } else if (image) {
        editPreviewContainer.innerHTML = `<img src="${image}" alt="Current Image">`;
      }
    });
  }
}

function savePost(postId, btn) {
  const modal = btn.closest(".post-modal"); // Lấy đúng modal đang thao tác
  if (!modal) {
    alert("Lỗi: Modal không tồn tại!");
    return;
  }
  const textElement = modal.querySelector("#postText");
  const fileInput = modal.querySelector("#postImage");
  const campaignTitle = document.getElementById("campaignTitle");

  if (!textElement || !fileInput || !campaignTitle) {
    alert("Lỗi: Thiếu thành phần cần thiết!");
    return;
  }

  const text = textElement.value.trim();
  const file = fileInput.files[0];
  const groupName = campaignTitle.textContent;

  if (!text && !file) {
    alert("Vui lòng nhập nội dung hoặc chọn ảnh!");
    return;
  }

  const formData = new FormData();
  formData.append("post_id", postId);
  formData.append("content", text);
  formData.append("group_name", groupName);
  if (file) formData.append("image", file);

  fetch("edit_group_post.php", { method: "POST", body: formData })
    .then((response) => {
      if (!response.ok) throw new Error("Lỗi khi chỉnh sửa bài viết");
      return response.text();
    })
    .then((data) => {
      const result = JSON.parse(data);
      if (result.success) {
        alert("Chỉnh sửa bài viết thành công!");
        closePostModal(modal);
        if (typeof displayPosts === "function") displayPosts();
      } else {
        alert("Lỗi khi chỉnh sửa: " + (result.error || "Không xác định"));
      }
    })
    .catch((error) => {
      alert("Lỗi kết nối, vui lòng thử lại!");
      console.error(error);
    });
}

function deletePost(postId) {
  if (!confirm("Bạn có chắc muốn xóa bài viết này?")) return;

  fetch("delete_group_post.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: `post_id=${postId}`,
  })
    .then((response) => {
      if (!response.ok) throw new Error("Lỗi khi xóa bài viết");
      return response.text();
    })
    .then((data) => {
      try {
        const result = JSON.parse(data);
        if (result.success) {
          alert("Xóa bài viết thành công!");
          if (typeof displayPosts === "function") displayPosts();
          else console.error("Hàm displayPosts không được định nghĩa");
        } else {
          alert("Lỗi khi xóa bài viết: " + (result.error || "Không xác định"));
        }
      } catch (e) {
        console.error("Dữ liệu không hợp lệ:", data);
        alert("Lỗi: Dữ liệu từ server không hợp lệ!");
      }
    })
    .catch((error) => {
      console.error("Lỗi kết nối:", error);
      alert("Lỗi kết nối, vui lòng thử lại!");
    });
}

function displayPosts() {
  const groupName = document.getElementById("campaignTitle").textContent;
  fetch(`get_group_posts.php?group_name=${encodeURIComponent(groupName)}`)
    .then((response) => {
      if (!response.ok) throw new Error("Lỗi khi tải bài viết");
      return response.json();
    })
    .then((posts) => {
      const container = document.getElementById("postsContainer");
      container.innerHTML = "";
      if (posts.error) {
        container.innerHTML = `<p>${posts.error}</p>`;
        return;
      }
      if (posts.length === 0) {
        container.innerHTML = "<p>Chưa có bài viết nào trong nhóm này.</p>";
        return;
      }
      posts.forEach((post) => {
        const postDiv = document.createElement("div");
        postDiv.className = "post";
        postDiv.id = `post-${post.id}`;

        const postHeader = document.createElement("div");
        postHeader.className = "post-header";
        postHeader.innerHTML = `
          <img src="${post.author.avatar}" alt="avatar" class="avatar">
          <div class="post-user-info">
            <h3>${post.author.name}</h3>
            <small>${new Date(post.created_at).toLocaleString("vi-VN", {
              day: "2-digit",
              month: "2-digit",
              year: "numeric",
            })}</small>
          </div>
          <div class="post-options">
            <span class="more-options" id="more-options-${post.id}">...</span>
            <div class="options-menu" id="options-${
              post.id
            }" style="display: none;">
              <button onclick="openEditPostModal(${
                post.id
              }, '${encodeURIComponent(post.content)}', '${
          post.image || ""
        }')">Sửa</button>
              <button onclick="deletePost(${post.id})">Xóa</button>
            </div>
          </div>
        `;
        postHeader
          .querySelector(`#more-options-${post.id}`)
          .addEventListener("click", () => toggleOptions(post.id));

        const postContent = document.createElement("div");
        postContent.className = "post-content";
        postContent.innerHTML = `
          <p>${post.content || ""}</p>
          ${
            post.image
              ? `<img src="${post.image}" alt="post image" class="post-image">`
              : ""
          }
        `;

        const postStats = document.createElement("div");
        postStats.className = "post-stats";
        postStats.id = `stats-${post.id}`;
        postStats.innerHTML = `
          <span id="likes-${post.id}">${post.likes || 0} Thích</span>
          <span id="comments-count-${post.id}">${
          post.comments_count || 0
        } Bình luận</span>
        `;

        const postActions = document.createElement("div");
        postActions.className = "post-actions";
        const likeButton = document.createElement("button");
        likeButton.className = `action-like ${post.liked ? "liked" : ""}`;
        likeButton.textContent = "Thích";
        likeButton.addEventListener("click", () => likePost(post.id));

        const commentButton = document.createElement("button");
        commentButton.className = "action-comment";
        commentButton.textContent = "Bình luận";
        commentButton.addEventListener("click", () =>
          toggleCommentSection(post.id)
        );

        postActions.appendChild(likeButton);
        postActions.appendChild(commentButton);

        const commentsSection = document.createElement("div");
        commentsSection.className = "comments-section";
        commentsSection.id = `comments-section-${post.id}`;
        commentsSection.style.display = "none";

        const commentsList = document.createElement("div");
        commentsList.className = "comments-list";
        commentsList.id = `comments-list-${post.id}`;

        const commentForm = document.createElement("form");
        commentForm.className = "comment-form";
        commentForm.id = `comment-form-${post.id}`;
        commentForm.innerHTML = `
          <input type="text" placeholder="Viết bình luận..." required>
          <button type="submit">Gửi</button>
        `;
        commentForm.addEventListener("submit", (event) =>
          submitComment(event, post.id)
        );

        commentsSection.appendChild(commentsList);
        commentsSection.appendChild(commentForm);

        postDiv.appendChild(postHeader);
        postDiv.appendChild(postContent);
        postDiv.appendChild(postStats);
        postDiv.appendChild(postActions);
        postDiv.appendChild(commentsSection);

        container.appendChild(postDiv);
      });
    })
    .catch((error) => {
      console.error("Lỗi khi tải bài đăng:", error);
      document.getElementById("postsContainer").innerHTML =
        "<p>Lỗi khi tải bài đăng.</p>";
    });
}

// Xử lý đăng bài
document.getElementById("postSubmit").addEventListener("click", function () {
  const text = document.getElementById("postText").value.trim();
  const fileInput = document.getElementById("postImage");
  const file = fileInput.files[0];
  const groupName = document.getElementById("campaignTitle").textContent;
  const csrfToken = document.getElementById("csrfToken").value;

  if (!text && !file) {
    alert("Vui lòng nhập nội dung hoặc chọn ảnh.");
    return;
  }

  const formData = new FormData();
  formData.append("content", text);
  formData.append("group_name", groupName);
  formData.append("csrf_token", csrfToken);
  if (file) formData.append("image", file);

  fetch("add_group_post.php", { method: "POST", body: formData })
    .then((response) => {
      if (!response.ok) throw new Error("Lỗi khi đăng bài");
      return response.text();
    })
    .then((data) => {
      try {
        const result = JSON.parse(data);
        if (result.success) {
          alert("Đăng bài thành công!");
          document.getElementById("postText").value = "";
          document.getElementById("postImage").value = "";
          document.getElementById("imagePreview").innerHTML = "";
          document.getElementById("imagePreview").style.display = "none";
          closePostModal();

          const container = document.getElementById("postsContainer");
          const post = result.post;
          const postDiv = document.createElement("div");
          postDiv.className = "post";
          postDiv.id = `post-${post.id}`;

          const postHeader = document.createElement("div");
          postHeader.className = "post-header";
          postHeader.innerHTML = `
            <img src="${post.author.avatar}" alt="avatar" class="avatar">
            <div class="post-user-info">
              <h3>${post.author.name}</h3>
              <small>${new Date(post.created_at).toLocaleString("vi-VN", {
                day: "2-digit",
                month: "2-digit",
                year: "numeric",
              })}</small>
            </div>
            <div class="post-options">
              <span class="more-options" id="more-options-${post.id}">...</span>
              <div class="options-menu" id="options-${
                post.id
              }" style="display: none;">
                <button onclick="openEditPostModal(${
                  post.id
                }, '${encodeURIComponent(post.content)}', '${
            post.image || ""
          }')">Sửa</button>
                <button onclick="deletePost(${post.id})">Xóa</button>
              </div>
            </div>
          `;
          postHeader
            .querySelector(`#more-options-${post.id}`)
            .addEventListener("click", () => toggleOptions(post.id));

          const postContent = document.createElement("div");
          postContent.className = "post-content";
          postContent.innerHTML = `
            <p>${post.content || ""}</p>
            ${
              post.image
                ? `<img src="${post.image}" alt="post image" class="post-image">`
                : ""
            }
          `;

          const postStats = document.createElement("div");
          postStats.className = "post-stats";
          postStats.id = `stats-${post.id}`;
          postStats.innerHTML = `
            <span id="likes-${post.id}">${post.likes || 0} Thích</span>
            <span id="comments-count-${post.id}">${
            post.comments_count || 0
          } Bình luận</span>
          `;

          const postActions = document.createElement("div");
          postActions.className = "post-actions";
          const likeButton = document.createElement("button");
          likeButton.className = "action-like";
          likeButton.textContent = "Thích";
          likeButton.addEventListener("click", () => likePost(post.id));

          const commentButton = document.createElement("button");
          commentButton.className = "action-comment";
          commentButton.textContent = "Bình luận";
          commentButton.addEventListener("click", () =>
            toggleCommentSection(post.id)
          );

          postActions.appendChild(likeButton);
          postActions.appendChild(commentButton);

          const commentsSection = document.createElement("div");
          commentsSection.className = "comments-section";
          commentsSection.id = `comments-section-${post.id}`;
          commentsSection.style.display = "none";

          const commentsList = document.createElement("div");
          commentsList.className = "comments-list";
          commentsList.id = `comments-list-${post.id}`;

          const commentForm = document.createElement("form");
          commentForm.className = "comment-form";
          commentForm.id = `comment-form-${post.id}`;
          commentForm.innerHTML = `
            <input type="text" placeholder="Viết bình luận..." required>
            <button type="submit">Gửi</button>
          `;
          commentForm.addEventListener("submit", (event) =>
            submitComment(event, post.id)
          );

          commentsSection.appendChild(commentsList);
          commentsSection.appendChild(commentForm);

          postDiv.appendChild(postHeader);
          postDiv.appendChild(postContent);
          postDiv.appendChild(postStats);
          postDiv.appendChild(postActions);
          postDiv.appendChild(commentsSection);

          container.prepend(postDiv);
        } else {
          alert("Lỗi khi đăng bài: " + (result.error || "Không xác định"));
        }
      } catch (e) {
        console.error("Dữ liệu không hợp lệ:", data);
        alert("Lỗi: Dữ liệu từ server không hợp lệ!");
      }
    })
    .catch((error) => {
      console.error("Lỗi kết nối:", error);
      alert("Lỗi kết nối, vui lòng thử lại!");
    });
});

// Khởi tạo giao diện
window.addEventListener("DOMContentLoaded", function () {
  displayPosts();

  // Xử lý preview ảnh khi chọn
  const fileInput = document.getElementById("postImage");
  const previewContainer = document.getElementById("imagePreview");
  if (fileInput && previewContainer) {
    fileInput.addEventListener("change", function () {
      const file = this.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
          previewContainer.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
          previewContainer.style.display = "block";
        };
        reader.readAsDataURL(file);
      }
    });
  }
});
