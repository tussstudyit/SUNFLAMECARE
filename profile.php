<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: Login.php");
    exit();
}

if (!isset($_GET['user_id'])) {
    header("Location: Home.php");
    exit();
}

$user_id = $_GET['user_id'];

// Lấy thông tin người dùng
$stmt = $conn->prepare("SELECT name, email, job, address, facebook, avatar FROM user WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    header("Location: Home.php");
    exit();
}

// Lấy bài đăng của người dùng
$stmt_posts = $conn->prepare("SELECT id, content, image, created_at, likes FROM post WHERE user_id = ? ORDER BY created_at DESC");
$stmt_posts->bind_param("i", $user_id);
$stmt_posts->execute();
$result_posts = $stmt_posts->get_result();

$posts = [];
while ($row = $result_posts->fetch_assoc()) {
    $posts[] = $row;
}

// Kiểm tra các bài đăng mà người dùng hiện tại đã thích
$current_user_id = $_SESSION['user_id'];
$liked_posts = [];
if (!empty($posts)) {
    $post_ids = array_column($posts, 'id');
    $placeholders = implode(',', array_fill(0, count($post_ids), '?'));
    $stmt_likes = $conn->prepare("SELECT post_id FROM likes WHERE user_id = ? AND post_id IN ($placeholders)");
    $stmt_likes->bind_param(str_repeat('i', count($post_ids) + 1), $current_user_id, ...$post_ids);
    $stmt_likes->execute();
    $result_likes = $stmt_likes->get_result();
    while ($row = $result_likes->fetch_assoc()) {
        $liked_posts[] = $row['post_id'];
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hồ sơ của <?php echo htmlspecialchars($user['name']); ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- <link rel="stylesheet" href="Home.css" /> -->
    <link rel="stylesheet" href="prifile.css">

    
</head>
<body>
    <!-- Header -->
<header class="navbar">
  <div class="navbar-logo">
    <a class="logo" href="/">
      <img src="img/snapedit_1746947524060.png" alt="Logo SUNFLAMECARE Vietnam" />
    </a>
    <div class="text-container">
      <span class="text-main">SUNFLAMECARE</span>
      <span class="text-sub">Thắp sáng hy vọng - Trao gửi yêu thương</span>
    </div>
  </div>
  <ul class="navbar-menu">
    <li><a href="trangchu.php"><i class="fa fa-home"></i> TRANG CHỦ</a></li>
    <li><a href="sumenh.php"><i class="fa fa-flag"></i> SỨ MỆNH</a></li>
    <li><a href="congdong.php"><i class="fa fa-users"></i> CỘNG ĐỒNG</a></li>
    <li><a href="hoatdong.php"><i class="fas fa-newspaper"></i> HOẠT ĐỘNG</a></li>
    <li><a href="lienhe.php"><i class="fa fa-phone"></i> LIÊN HỆ</a></li>
  </ul>
  <div class="navbar-actions">
    <div class="user-info" onclick="toggleDropdown()">
      <img src="<?php echo htmlspecialchars($_SESSION['avatar'] ?? 'img/default_avatar.jpg'); ?>" alt="avatar">
      <span><?php echo htmlspecialchars($_SESSION['name']); ?></span>
    </div>
    <ul class="dropdown-menu" id="dropdownMenu">
      <li><a href="Home.php">Trang cá nhân</a></li>
      <li><a href="#">Chiến dịch của tôi</a></li>
      <li><a href="logout.php">Đăng xuất</a></li>
    </ul>
    <div class="menu-toggle" onclick="toggleMenu()">☰</div>
  </div>
</header>
    <!-- Main Content -->
    <div class="main-container">
        <!-- Hồ sơ người dùng -->
        <div class="profile-sidebar">
            <div class="profile-card">
                <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="avatar" class="profile-avatar">
                <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($user['email']); ?></p>
                <?php if (!empty($user['job'])): ?>
                    <p><i class="fas fa-briefcase"></i> <?php echo htmlspecialchars($user['job']); ?></p>
                <?php endif; ?>
                <?php if (!empty($user['address'])): ?>
                    <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($user['address']); ?></p>
                <?php endif; ?>
                <?php if (!empty($user['facebook'])): ?>
                    <p><i class="fab fa-facebook"></i> <?php echo htmlspecialchars($user['facebook']); ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Danh sách bài đăng -->
        <div class="main-content">
            <div id="postsContainer">
                <?php if (empty($posts)): ?>
                    <p>Người dùng này chưa có bài đăng nào.</p>
                <?php else: ?>
                    <?php foreach ($posts as $post): ?>
                        <div class="post" id="post-<?php echo $post['id']; ?>">
                            <div class="post-header">
                                <img src="<?php echo htmlspecialchars($user['avatar']); ?>" alt="avatar" class="post-avatar">
                                <div class="post-user-info">
                                    <h3><?php echo htmlspecialchars($user['name']); ?></h3>
                                    <small><?php echo (new DateTime($post['created_at']))->format('d/m/Y H:i'); ?></small>
                                </div>
                            </div>
                            <div class="post-content">
                                <p><?php echo htmlspecialchars($post['content']); ?></p>
                                <?php if ($post['image']): ?>
                                    <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="post image" class="post-image">
                                <?php endif; ?>
                            </div>
                            <div class="post-stats">
                                <span id="likes-<?php echo $post['id']; ?>"><?php echo $post['likes']; ?> Thích</span>
                                <span id="comments-count-<?php echo $post['id']; ?>">0 Bình luận</span>
                            </div>
                            <div class="post-actions">
                                <button class="action-like <?php echo in_array($post['id'], $liked_posts) ? 'liked' : ''; ?>" 
                                        onclick="likePost(<?php echo $post['id']; ?>)">
                                    Thích
                                </button>
                                <button class="action-comment" onclick="toggleCommentSection(<?php echo $post['id']; ?>)">
                                    Bình luận
                                </button>
                            </div>
                            <div class="comments-section" id="comments-section-<?php echo $post['id']; ?>" style="display: none;">
                                <div class="comments-list" id="comments-list-<?php echo $post['id']; ?>"></div>
                                <form class="comment-form" id="comment-form-<?php echo $post['id']; ?>" onsubmit="submitComment(event, <?php echo $post['id']; ?>)">
                                    <input type="text" placeholder="Viết bình luận..." required>
                                    <button type="submit">Gửi</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function toggleMenu() {
    const menu = document.querySelector(".navbar-menu");
    if (menu) {
        menu.classList.toggle("active");
    } else {
        console.error("Không tìm thấy navbar-menu!");
    }
}

        function toggleDropdown() {
            const dropdownMenu = document.getElementById("dropdownMenu");
            if (dropdownMenu) {
                dropdownMenu.classList.toggle("show");
            } else {
                console.error("Không tìm thấy dropdown menu!");
            }
        }

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
            .then(response => {
                if (!response.ok) throw new Error("Lỗi khi tải bình luận từ server");
                return response.json();
            })
            .then(comments => {
                // Lưu vào cache và đánh dấu không cần làm mới
                commentsCache[postId] = { data: comments, needsRefresh: false };
                renderComments(postId, comments);
            })
            .catch(error => {
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
    comments.forEach(comment => {
        const commentDiv = document.createElement("div");
        commentDiv.className = "comment";
        commentDiv.innerHTML = `
            <img src="${comment.avatar}" alt="avatar" class="comment-avatar">
            <div class="comment-content">
                <span class="commenter-name">${comment.name}</span>
                <p>${comment.content}</p>
                <small>${new Date(comment.created_at).toLocaleString('vi-VN', { day: '2-digit', month: '2-digit', year: 'numeric', hour: '2-digit', minute: '2-digit' })}</small>
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
                created_at: data.comment.created_at
            };
            commentsCache[postId].data.push(newCommentData);

            // Render lại toàn bộ danh sách bình luận từ cache (bao gồm cả cũ và mới)
            renderComments(postId, commentsCache[postId].data);

            // Cập nhật số lượng bình luận
            const commentCountSpan = document.getElementById(`comments-count-${postId}`);
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
                const likeButton = document.querySelector(`#post-${postId} .action-like`);
                if (likesSpan && likeButton) {
                    likesSpan.textContent = `${data.likes} Thích`;
                    if (data.liked) {
                        likeButton.classList.add('liked');
                    } else {
                        likeButton.classList.remove('liked');
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

    // Gọi loadComments khi trang tải để hiển thị bình luận ban đầu
    window.onload = function() {
        <?php foreach ($posts as $post): ?>
            loadComments(<?php echo $post['id']; ?>);
        <?php endforeach; ?>
    };
    </script>
</body>
</html>