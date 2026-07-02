function openPostModal() {
  const modal = document.getElementById("postModal");
  if (modal) {
    modal.style.display = "flex"; // Use flex to trigger CSS centering
    // Reset modal content if needed
    document.getElementById("postContent").value = "";
    document.getElementById("postImagePreview").innerHTML = "";
    document.getElementById("postImageInput").value = "";
    document.getElementById("charCount").textContent = "0/1000";
    document.querySelector(".submit-post-btn").disabled = true;
  } else {
    console.error("Không tìm thấy postModal!");
  }
}

function closePostModal() {
  const modal = document.getElementById("postModal");
  if (modal) {
    modal.style.display = "none";
  }
}

// Close modal when clicking outside
window.onclick = function (event) {
  const modal = document.getElementById("postModal");
  if (event.target === modal) {
    closePostModal();
  }
};

//
function displayPosts() {
  fetch("get_posts.php")
    .then((response) => response.json())
    .then((posts) => {
      const container = document.getElementById("postsContainer");
      container.innerHTML = "";
      if (posts.length === 0) {
        container.innerHTML = "<p>Chưa có bài viết nào.</p>";
        return;
      }
      posts.forEach((post) => {
        const postDiv = document.createElement("div");
        postDiv.className = "post";
        postDiv.id = `post-${post.id}`; // Thêm ID để dễ thao tác

        // Header
        const postHeader = document.createElement("div");
        postHeader.className = "post-header";
        postHeader.innerHTML = `
                    <img src="${post.avatar}" alt="avatar" class="post-avatar">
                    <div class="post-user-info">
                        <h3>${post.name}</h3>
                        <small>${new Date(post.created_at).toLocaleString(
                          "vi-VN",
                          {
                            day: "2-digit",
                            month: "2-digit",
                            year: "numeric",
                            hour: "2-digit",
                            minute: "2-digit",
                          }
                        )}</small>
                    </div>
                    <div class="post-options">
                        <span class="more-options" id="more-options-${
                          post.id
                        }">...</span>
                        <div class="options-menu" id="options-${
                          post.id
                        }" style="display: none;">
                            <button onclick="openEditPostModal(${
                              post.id
                            }, '${encodeURIComponent(post.content)}', '${
          post.image
        }')">Sửa</button>
                            <button onclick="deletePost(${
                              post.id
                            })">Xóa</button>
                        </div>
                    </div>
                `;
        postHeader
          .querySelector(`#more-options-${post.id}`)
          .addEventListener("click", () => toggleOptions(post.id));

        // Nội dung bài đăng
        const postContent = document.createElement("div");
        postContent.className = "post-content";
        postContent.innerHTML = `
                    <p>${post.content}</p>
                    ${
                      post.image
                        ? `<img src="${post.image}" alt="post image" class="post-image">`
                        : ""
                    }
                `;

        // Thống kê
        const postStats = document.createElement("div");
        postStats.className = "post-stats";
        postStats.id = `stats-${post.id}`;
        postStats.innerHTML = `
                    <span id="likes-${post.id}">${post.likes || 0} Thích</span>
                    <span id="comments-count-${post.id}">0 Bình luận</span>
                `;

        // Nút hành động
        const postActions = document.createElement("div");
        postActions.className = "post-actions";
        const likeButton = document.createElement("button");
        likeButton.className = `action-like ${post.liked ? "liked" : ""}`; // Thêm trạng thái "liked"
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

        // Khu vực bình luận
        const commentsSection = document.createElement("div");
        commentsSection.className = "comments-section";
        commentsSection.id = `comments-section-${post.id}`;
        commentsSection.style.display = "none"; // Ban đầu ẩn khu vực bình luận

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

        // Gắn các phần tử vào bài đăng
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
// like vaf comemnt

// Xử lý nút "Thích"
// Hiển thị/ẩn form bình luận
// Hiển thị/ẩn khu vực bình luận
function toggleCommentSection(postId) {
  const section = document.getElementById(`comments-section-${postId}`);
  if (section) {
    if (section.style.display === "none") {
      section.style.display = "block";
      loadComments(postId); // Tải hoặc sử dụng cache
    } else {
      section.style.display = "none";
    }
  }
}

// Gửi bình luận mới
// Biến toàn cục để lưu trữ bình luận
// Biến toàn cục để lưu trữ bình luận
// Biến toàn cục để lưu trữ bình luận
const commentsCache = {};

// Hàm tải bình luận
function loadComments(postId) {
  const commentsList = document.getElementById(`comments-list-${postId}`);
  const commentsCount = document.getElementById(`comments-count-${postId}`);

  if (!commentsList || !commentsCount) {
    console.error(`Không tìm thấy phần tử cho postId: ${postId}`);
    return;
  }

  // Nếu đã có trong cache và không cần làm mới, sử dụng cache
  if (commentsCache[postId] && !commentsCache[postId].needsRefresh) {
    renderComments(postId, commentsCache[postId].data);
  } else {
    // Gọi API để tải bình luận mới nhất
    fetch(`get_comments.php?post_id=${postId}`)
      .then((response) => {
        if (!response.ok) throw new Error("Lỗi khi tải bình luận từ server");
        return response.json();
      })
      .then((comments) => {
        // Lưu vào cache và đánh dấu không cần làm mới
        commentsCache[postId] = { data: comments, needsRefresh: false };
        renderComments(postId, comments);
      })
      .catch((error) => {
        console.error("Lỗi khi tải bình luận:", error);
        commentsList.innerHTML = "<p>Không thể tải bình luận.</p>";
      });
  }
}

// Hàm render bình luận để tái sử dụng
function renderComments(postId, comments) {
  const commentsList = document.getElementById(`comments-list-${postId}`);
  const commentsCount = document.getElementById(`comments-count-${postId}`);
  commentsList.innerHTML = "";
  if (commentsCount) {
    commentsCount.textContent = `${comments.length} Bình luận`;
  }
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

  // Cuộn xuống bình luận cuối cùng
  commentsList.scrollTop = commentsList.scrollHeight;
}

// Hàm gửi bình luận
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
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `post_id=${postId}&content=${encodeURIComponent(content)}`,
  })
    .then((response) => {
      if (!response.ok) throw new Error("Lỗi khi gửi bình luận");
      return response.json();
    })
    .then((data) => {
      if (data.success) {
        alert("Bình luận thành công!");
        form.reset();

        // Thêm bình luận mới vào cache
        if (!commentsCache[postId]) {
          commentsCache[postId] = { data: [], needsRefresh: false };
        }
        const newCommentData = {
          avatar: data.comment.avatar,
          name: data.comment.name,
          content: data.comment.content,
          created_at: data.comment.created_at,
        };
        commentsCache[postId].data.push(newCommentData);

        // Render lại toàn bộ danh sách bình luận từ cache (bao gồm cả cũ và mới)
        renderComments(postId, commentsCache[postId].data);

        // Cập nhật số lượng bình luận
        const commentCountSpan = document.getElementById(
          `comments-count-${postId}`
        );
        if (commentCountSpan) {
          commentCountSpan.textContent = `${commentsCache[postId].data.length} Bình luận`;
        }
      } else {
        alert("Lỗi khi thêm bình luận: " + (data.error || "Không xác định"));
      }
    })
    .catch((error) => {
      console.error("Lỗi kết nối:", error);
      alert("Lỗi kết nối, vui lòng thử lại!");
    });
}
// Xử lý nút "Thích"
function likePost(postId) {
  fetch("like_post.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `post_id=${postId}`,
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.success) {
        const likesSpan = document.getElementById(`likes-${postId}`);
        const likeButton = document.querySelector(
          `#post-${postId} .action-like`
        );
        if (likesSpan && likeButton) {
          likesSpan.textContent = `${data.likes} Thích`;
          if (data.liked) {
            likeButton.classList.add("liked");
          } else {
            likeButton.classList.remove("liked");
          }
        }
      } else {
        alert("Lỗi khi thích bài viết: " + (data.error || "Không xác định"));
      }
    })
    .catch((error) => {
      console.error("Lỗi kết nối:", error);
      alert("Lỗi kết nối, vui lòng thử lại!");
    });
}

// Hiển thị/ẩn menu tùy chọn
// Hàm toggle menu tùy chọn
function toggleOptions(postId) {
  const menu = document.getElementById(`options-${postId}`);
  if (menu) {
    menu.style.display = menu.style.display === "block" ? "none" : "block";
  }
}

// Hàm xóa bài đăng
function deletePost(postId) {
  if (confirm("Bạn có chắc muốn xóa bài đăng này?")) {
    fetch("delete_post.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `post_id=${postId}`,
    })
      .then((response) => response.text())
      .then((data) => {
        if (data === "success") {
          const postDiv = document.getElementById(`post-${postId}`);
          if (postDiv) {
            postDiv.remove();
          }
          alert("Xóa bài đăng thành công!");
        } else {
          alert("Lỗi khi xóa bài đăng: " + data);
        }
      })
      .catch((error) => {
        console.error("Lỗi kết nối:", error);
        alert("Lỗi kết nối, vui lòng thử lại!");
      });
  }
}

// Hàm mở modal chỉnh sửa bài đăng
function openEditPostModal(postId, content, image) {
  const modal = document.getElementById("editPostModal");
  if (modal) {
    modal.style.display = "flex";

    // Điền nội dung hiện tại
    document.getElementById("editPostContent").value = content || "";
    const editPreview = document.getElementById("editPostImagePreview");
    editPreview.innerHTML = image
      ? `<img src="${image}" alt="post image" style="max-width: 100%;">`
      : "";

    // Lưu postId để sử dụng khi lưu
    modal.dataset.postId = postId;
  }
}

// Hàm lưu bài đăng đã chỉnh sửa
function saveEditedPost(event) {
  event.preventDefault();

  const postId = document.getElementById("editPostModal").dataset.postId;
  const content = document.getElementById("editPostContent").value;
  const imageFile = document.getElementById("editPostImageInput").files[0];

  const formData = new FormData();
  formData.append("post_id", postId);
  formData.append("content", content);
  if (imageFile) {
    formData.append("image", imageFile);
  }

  fetch("edit_post.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data === "success") {
        alert("Cập nhật bài đăng thành công!");
        closeEditPostModal();
        displayPosts(); // Tải lại danh sách bài đăng
      } else {
        alert("Lỗi khi cập nhật bài đăng: " + data);
      }
    })
    .catch((error) => {
      console.error("Lỗi kết nối:", error);
      alert("Lỗi kết nối, vui lòng thử lại!");
    });
}

// Hàm đóng modal chỉnh sửa
function closeEditPostModal() {
  const modal = document.getElementById("editPostModal");
  if (modal) {
    modal.style.display = "none";
    document.getElementById("editPostContent").value = "";
    document.getElementById("editPostImagePreview").innerHTML = "";
    document.getElementById("editPostImageInput").value = "";
  }
}
// goi y
function displaySuggestions() {
  fetch("get_new_users.php")
    .then((response) => response.json())
    .then((users) => {
      const suggestionsList = document.getElementById("suggestionsList");
      suggestionsList.innerHTML = "";
      if (users.error) {
        suggestionsList.innerHTML = "<p>Không thể tải gợi ý.</p>";
        return;
      }
      if (users.length === 0) {
        suggestionsList.innerHTML = "<p>Không có người dùng nào.</p>";
        return;
      }
      users.forEach((user) => {
        const userDiv = document.createElement("div");
        userDiv.className = "suggestion-item";
        userDiv.style.cursor = "pointer";
        userDiv.addEventListener("click", () => {
          window.location.href = `profile.php?user_id=${user.id}`;
        });
        userDiv.innerHTML = `
                    <img src="${user.avatar}" alt="avatar" class="suggestion-avatar">
                    <div class="suggestion-info">
                        <span class="suggestion-name">${user.name}</span>
                        <span class="suggestion-email">@${user.email}</span>
                    </div>
                `;
        suggestionsList.appendChild(userDiv);
      });
    })
    .catch((error) => {
      console.error("Lỗi khi tải gợi ý:", error);
      document.getElementById("suggestionsList").innerHTML =
        "<p>Lỗi khi tải gợi ý.</p>";
    });
}

window.onload = function () {
  displayPosts();
  displaySuggestions();
};
