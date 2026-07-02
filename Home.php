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
    <link rel="stylesheet" href="Home.css" />
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

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    <!-- Main JavaScript -->

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

    </script>

  <!-- Main Content -->
  <div class="main-container">
    <!-- Phần hồ sơ cá nhân bên trái -->
    <div class="profile-sidebar">
     <div class="profile-card">
    <img src="<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="avatar" class="profile-avatar">
    <h2><?php echo htmlspecialchars($_SESSION['name']); ?></h2>
    <p><i class="fas fa-envelope"></i> <?php echo htmlspecialchars($_SESSION['email']); ?></p>
    <?php if (!empty($_SESSION['job'])): ?>
        <p><i class="fas fa-briefcase"></i> <?php echo htmlspecialchars($_SESSION['job']); ?></p>
    <?php endif; ?>
    <?php if (!empty($_SESSION['address'])): ?>
        <p><i class="fas fa-map-marker-alt"></i> <?php echo htmlspecialchars($_SESSION['address']); ?></p>
    <?php endif; ?>
    <?php if (!empty($_SESSION['facebook'])): ?>
        <p><i class="fab fa-facebook"></i> <?php echo htmlspecialchars($_SESSION['facebook']); ?></p>
    <?php endif; ?>
    <button class="edit-profile-btn">Chỉnh sửa hồ sơ</button>
</div>
      <?php if (isset($_SESSION['user_id'])): ?>
        <div class="suggestions">
            <h3>Gợi ý cho bạn</h3>

          <div id="suggestionsList"></div>
            
        </div>
    <?php endif; ?>
    </div>

    <!-- Phần chính (form đăng bài và danh sách bài đăng) -->
<div class="main-content">
  <!-- Form đăng bài -->
  <div class="post-container">
    <div class="post-header">
      <img src="<?php echo htmlspecialchars($_SESSION['avatar']); ?>" alt="avatar" class="profile-avatar">
      <input type="text" placeholder="Hãy viết gì đó cho bài viết của bạn..." onclick="openPostModal()">
    </div>
  </div>
  <!-- Container for displaying posts -->
  <div id="postsContainer"></div>
</div>
  
  


  <!-- Form chỉnh sửa hồ sơ cá nhân -->
  <div id="editForm" class="edit-form-container">
    <div class="edit-form-content">
      <div class="edit-form-header">
        <div class="avatar-upload">
          <div class="avatar-preview" id="avatarPreview"></div>
          <input type="file" id="avatarInput" accept="image/*" hidden />
          <button type="button" class="avatar-btn" onclick="document.getElementById('avatarInput').click()">+ chọn avatar</button>
        </div>
      </div>
      <form onsubmit="saveProfile(event)">
        <label for="displayName">Tên hiển thị</label>
        <input type="text" id="displayName" placeholder="Nhập tên hiển thị" />
        <label>Thông tin</label>
        <div class="input-group">
          <i class="fas fa-map-marker-alt"></i>
          <input type="text" id="address" placeholder="Địa chỉ" />
        </div>
        <div class="input-group">
          <i class="fas fa-building"></i>
          <input type="text" id="job" placeholder="Công việc, đơn vị..." />
        </div>
        <label>Tài khoản mạng xã hội</label>
        <div class="input-group">
          <i class="fab fa-facebook"></i>
          <input type="text" id="facebook" placeholder="Link Facebook..." />
        </div>
        <div class="form-buttons">
          <button type="button" class="cancel-btn" onclick="closeEditForm()">Hủy</button>
          <button type="submit" class="save-btn">Lưu</button>
        </div>
      </form>
    </div>
  </div>

  <!-- Modal thêm bài viết -->
 <div id="postModal" class="post-modal-container">
  <div class="post-modal-content">
    <div class="post-modal-header">
      <h3>Thêm bài viết</h3>
      <span class="close-modal" onclick="closePostModal()">×</span>
    </div>
    <form onsubmit="savePost(event)">
      <textarea id="postContent" placeholder="Bạn đang nghĩ gì vậy..." maxlength="1000" oninput="updateCharCount()"></textarea>
      <div class="char-count" id="charCount">0/1000</div>
      <div class="post-image-upload">
        <div class="post-image-preview" id="postImagePreview"></div>
        <input type="file" id="postImageInput" accept="image/*" hidden />
        <button type="button" class="post-image-btn" onclick="document.getElementById('postImageInput').click()">
          <i class="fas fa-image"></i> Thêm ảnh
        </button>
      </div>
      <button type="submit" class="submit-post-btn" disabled>Đăng bài viết</button>
    </form>
  </div>
</div>

  <!-- Modal chỉnh sửa bài viết -->
 <div id="editPostModal" class="post-modal-container">
    <div class="post-modal-content">
        <div class="post-modal-header">
            <h3>Chỉnh sửa bài viết</h3>
            <span class="close-modal" onclick="closeEditPostModal()">×</span>
        </div>
        <form onsubmit="saveEditedPost(event)">
            <textarea id="editPostContent" placeholder="Bạn đang nghĩ gì vậy..."></textarea>
            <div class="post-image-upload">
                <div class="post-image-preview" id="editPostImagePreview"></div>
                <input type="file" id="editPostImageInput" accept="image/*" hidden />
                <button type="button" class="post-image-btn" onclick="document.getElementById('editPostImageInput').click()">
                    <i class="fas fa-image"></i> Thêm ảnh
                </button>
            </div>
            <button type="submit" class="submit-post-btn">Lưu thay đổi</button>
        </form>
    </div>
</div>

  <!-- JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
  <script src="anhten.js"></script>
 

  <!-- Inline JavaScript -->
  <script>
    document.querySelector(".edit-profile-btn").addEventListener("click", openEditForm);

  function openEditForm() {
  const form = document.getElementById("editForm");
  if (form) {
    form.style.display = "flex";

    // Điền thông tin vào form
    document.getElementById("displayName").value = userProfile.name || "";
    document.getElementById("job").value = userProfile.job || "";
    document.getElementById("address").value = userProfile.address || "";
    document.getElementById("facebook").value = userProfile.facebook || "";
  }
}

    function closeEditForm() {
      const form = document.getElementById("editForm");
      if (form) {
        form.style.display = "none";
      }
    }
  </script>
<!--  -->
  <script>

  function savePost(event) {
    event.preventDefault();

    const content = document.getElementById('postContent').value;
    const imageFile = document.getElementById('postImageInput').files[0];
    const userId = <?= json_encode($_SESSION['user_id']) ?>;

    if (!content && !imageFile) {
        alert('Vui lòng nhập nội dung hoặc chọn ảnh!');
        return;
    }

    const formData = new FormData();
    formData.append('content', content);
    formData.append('user_id', userId);
    if (imageFile) {
        formData.append('image', imageFile);
    }

    fetch('save_post.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        if (data.trim() === 'success') {
            alert('Đăng bài viết thành công!');
            closePostModal();
            // Reset form
            document.getElementById('postContent').value = '';
            document.getElementById('postImagePreview').innerHTML = '';
            document.getElementById('postImageInput').value = '';
            document.getElementById('charCount').textContent = '0/1000';
            document.querySelector('.submit-post-btn').disabled = true;
            displayPosts(); // Tải lại danh sách bài đăng
        } else {
            alert('Lỗi khi đăng bài: ' + data);
        }
    })
    .catch(error => {
        console.error('Lỗi kết nối:', error);
        alert('Lỗi kết nối, vui lòng thử lại!');
    });
}

// Preview ảnh khi chọn
document.getElementById('postImageInput').addEventListener('change', function(e) {
    const preview = document.getElementById('postImagePreview');
    preview.innerHTML = '';
    if (e.target.files[0]) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(e.target.files[0]);
        img.style.maxWidth = '100%';
        preview.appendChild(img);
        document.querySelector('.submit-post-btn').disabled = false;
    }
});

// Cập nhật số ký tự
function updateCharCount() {
    const textarea = document.getElementById('postContent');
    const charCount = document.getElementById('charCount');
    charCount.textContent = textarea.value.length + '/1000';
    document.querySelector('.submit-post-btn').disabled = textarea.value.length === 0 && !document.getElementById('postImageInput').files[0];
}


</script>


<!-- Gửi thông tin và ảnh avatar -->

<script>
// Preview avatar
document.getElementById('avatarInput').addEventListener('change', function(e) {
    const preview = document.getElementById('avatarPreview');
    preview.innerHTML = '';
    if (e.target.files[0]) {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(e.target.files[0]);
        img.style.maxWidth = '100%';
        preview.appendChild(img);
    }
});

function saveProfile(event) {
    event.preventDefault();
    
    const formData = new FormData();
    formData.append('name', document.getElementById('displayName').value);
    formData.append('job', document.getElementById('job').value);
    formData.append('address', document.getElementById('address').value);
    formData.append('facebook', document.getElementById('facebook').value);
    
    const avatarFile = document.getElementById('avatarInput').files[0];
    if (avatarFile) {
        formData.append('avatar', avatarFile);
    }

    fetch('update_profile.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log('Response from server:', data); // Log để kiểm tra
        if (data === 'success') {
            alert('Cập nhật thông tin thành công!');
            location.reload();
        } else {
            alert('Có lỗi xảy ra khi cập nhật: ' + data);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Lỗi kết nối');
    });
}  
</script>



<script>
  const userProfile = {
    name: <?= json_encode($_SESSION['name'] ?? '') ?>,
    job: <?= json_encode($_SESSION['job'] ?? '') ?>,
    address: <?= json_encode($_SESSION['address'] ?? '') ?>,
    facebook: <?= json_encode($_SESSION['facebook'] ?? '') ?>
  };
</script>

<!-- <script>
  // Gọi displayPosts khi trang tải
  window.onload = function() {
    saveProfile(event);
  };
</script> -->

<script>
    window.onload = function() {
        <?php foreach ($posts as $post): ?>
            loadComments(<?php echo $post['id']; ?>);
        <?php endforeach; ?>
    };
</script>
  <script src="Home.js"></script>

</body>
</html>
