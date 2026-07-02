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
    <link rel="stylesheet" href="congdongg.css" />
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

    
  <!-- Main Content -->
  <div class="main-container">
    <div class="sidebar" data-aos="fade-right">
      <h3><b>Nhóm</b></h3>
      <input type="text" placeholder="Tìm kiếm nhóm" class="search-box" />
      <ul class="group-list">
        <li onclick="showGroup(this)" data-title="Bữa cơm 0đ tại Cẩm Lệ - 18/05/2025" data-img="img/5DM37927.jpg">
          <img src="img/5DM37927.jpg" alt="Bữa cơm 0đ" />
          <div>
            <strong>Bữa cơm 0đ tại Cẩm Lệ - 18/05/2025</strong><br />
            <small>Đà Nẵng</small>
          </div>
        </li>
        <li onclick="showGroup(this)" data-title="Cuộc dân vận lên huyện Kprang (DakLak) - 24/06/2025" data-img="img/AoamchoemJPG.jpg">
          <img src="img/AoamchoemJPG.jpg" alt="Cuộc dân vận Kprang" />
          <div>
            <strong>Cuộc dân vận lên huyện Kprang tỉnh DakLak - 24/06/2025</strong><br />
            <small>DakLak</small>
          </div>
        </li>
        <li onclick="showGroup(this)" data-title="Thăm các cụ ở viện dưỡng lão An Sinh Đường - 13/07/2025" data-img="img/IMG_0139-1024x683.jpg.webp">
          <img src="img/IMG_0139-1024x683.jpg.webp" alt="Thăm viện dưỡng lão" />
          <div>
            <strong>Thăm các cụ ở viện dưỡng lão An Sinh Đường - 13/07/2025</strong><br />
            <small>Đà Nẵng</small>
          </div>
        </li>
      </ul>
    </div>  

    <div class="content" data-aos="fade-up">
      <img src="" alt="" class="campaign-img" id="campaignImg" />
      <h2 id="campaignTitle"></h2>
      <div class="button-group">
        <!-- <button class="green-btn"><i class="fas fa-share"></i> Chia sẻ</button> -->
        <button class="green-btn" style="background: green;"><a href="trochuyen.php"><i class="fas fa-comments"></i> Chat</a></button>
        <button class="green-btn"  style="background: green;"><a href="hoatdong.php"><i class="fas fa-flag"></i> Chiến dịch</a></button>
      </div>
    </div>
  </div>

  <!-- Post Creation Box -->
  <div class="post-box" onclick="expandPostBox()" data-aos="fade-up">
    <img id="currentUserAvatar" src="<?php echo $_SESSION['avatar'] ?? 'img/default_avatar.jpg'; ?>" alt="avatar" class="avatar" />
    <input type="text" placeholder="Bạn có thông tin gì mới cho nhóm không..." class="post-input" readonly />
  </div>

  <!-- Post Modal -->
  <div class="post-modal" id="postModal">
    <div class="post-modal-content">
      <textarea placeholder="Bạn muốn chia sẻ điều gì với nhóm?" id="postText"></textarea>
      <label for="postImage" class="icon-upload">
        <i class="fa-solid fa-image"></i> Thêm ảnh
      </label>
      <input type="file" id="postImage" accept="image/*" style="display: none;" />
      <div id="imagePreview" class="image-preview"></div>
      <div class="modal-buttons">
        <button onclick="closePostModal()">Hủy</button>
        <button class="green-btn" id="postSubmit" style="background: green;">Đăng</button>
      </div>
    </div>
  </div>

  <!-- Posts Container -->
  <div id="postsContainer" data-aos="fade-up"></div>

  <!-- CSRF Token -->
  <input type="hidden" id="csrfToken" value="<?php echo $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); ?>">

  <!-- JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script src="group_community.js"></script>
  <script src="anhten.js"></script>
  
  <script>
    // Initialize AOS
    AOS.init({
      duration: 800,
      once: true
    });
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
  

    // Show Group
    function showGroup(element) {
      const title = element.getAttribute("data-title");
      const img = element.getAttribute("data-img");
      document.getElementById("campaignTitle").textContent = title;
      document.getElementById("campaignImg").src = img;
      document.getElementById("campaignImg").alt = title;
      displayPosts(); // Assuming this function exists in group_community.js
    }

    // Post Modal
    function expandPostBox() {
      document.getElementById("postModal").style.display = "flex";
    }

    function closePostModal(modal = null) {
      if (!modal) {
        const modals = document.querySelectorAll(".post-modal");
        modals.forEach(m => {
          if (m.id === "postModal") {
            m.style.display = "none";
          } else {
            m.remove();
          }
        });
      } else {
        if (modal.id === "postModal") {
          modal.style.display = "none";
        } else {
          modal.remove();
        }
      }
    }

    // Close modal on outside click
    window.addEventListener("click", function (event) {
      const modal = document.getElementById("postModal");
      if (event.target === modal) {
        modal.style.display = "none";
      }
    });
  </script>
</body>
</html>