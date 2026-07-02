<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#e78d2d" /> <!-- Màu chủ đạo cho trình duyệt -->
    <title>Sao kê</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="trangchu.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet" /> <!-- Thêm phông Roboto -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="danhsach.css" />
  </head>
  <body>
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

    <div class="container">
      <div class="sidebar">
        <h3>Nhóm</h3>
        <div class="search-container">
          <input type="text" id="groupSearchInput" placeholder="Tìm kiếm nhóm..." onkeyup="filterGroups()">
        </div>
        <div class="group-buttons" id="groupButtons">
          <div class="session">
            <button onclick="loadTable('SL21325', '')">Chương trình trao tặng 100 suất học bổng <br> <b>Mã HĐ: SL21325</b></button>
            <button onclick="loadTable('SL25325', '')">Xây dựng phòng học mới tại Cát Tiên <br> <b>Mã HĐ: SL25325</b></button>
            <button onclick="loadTable('SL1425', '')">Khám bệnh miễn phí cho trẻ em vùng cao <br> <b >Mã HĐ: SL1425</b></button>
          </div>
        </div>
      </div>
      <div class="main-content">
        <div class="session">
          <button onclick="loadTable('', '')">Đầu vào</button>
          <button onclick="window.location.href='daura.html'">Đầu ra</button>
          <button onclick="loadTable('', '')">Còn lại</button>
        </div>

        <div class="table">
          <div id="donationsTableContainer"></div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    <script src="congdong.js"></script>
    <script src="hoatdong.js"></script>

    <script>
      function toggleMenu() {
        const menu = document.querySelector(".navbar-menu");
        menu.classList.toggle("active");
      }

      function toggleDropdown(event) {
        event.preventDefault();
        const dropdown = document.getElementById("dropdownMenu");
        dropdown.classList.toggle("show");
      }

      // Đóng dropdown khi click ra ngoài
      document.addEventListener("click", function (event) {
        const dropdown = document.getElementById("dropdownMenu");
        const userInfo = document.querySelector(".user-info");
        if (!userInfo.contains(event.target) && !dropdown.contains(event.target)) {
          dropdown.classList.remove("show");
        }
      });

      window.addEventListener("scroll", function () {
        const navbar = document.querySelector(".navbar");
        if (window.scrollY > 50) {
          navbar.classList.add("scrolled");
        } else {
          navbar.classList.remove("scrolled");
        }
      });

      function loadTable(activityCode, transferContent) {
        let url = 'get_donations.php?activity_code=' + encodeURIComponent(activityCode) + '&transfer_content=' + encodeURIComponent(transferContent);
        fetch(url)
          .then(response => response.text())
          .then(data => {
            document.getElementById('donationsTableContainer').innerHTML = data;
            searchTable(); // Áp dụng tìm kiếm sau khi tải dữ liệu
          })
          .catch(error => console.error('Error:', error));
      }

      function searchTable() {
        let input = document.getElementById('searchInput')?.value.toLowerCase() || '';
        let table = document.getElementById('donationsTable');
        if (!table) return;
        let tr = table.getElementsByTagName('tr');

        for (let i = 1; i < tr.length; i++) {
          let found = false;
          let tds = tr[i].getElementsByTagName('td');
          for (let j = 0; j < tds.length; j++) {
            if (tds[j].textContent.toLowerCase().indexOf(input) > -1) {
              found = true;
              break;
            }
          }
          tr[i].style.display = found ? '' : 'none';
        }
      }

      function filterGroups() {
        let input = document.getElementById('groupSearchInput').value.toLowerCase();
        let buttons = document.getElementById('groupButtons').getElementsByTagName('button');
        for (let i = 0; i < buttons.length; i++) {
          let text = buttons[i].textContent.toLowerCase();
          buttons[i].style.display = text.indexOf(input) > -1 ? '' : 'none';
        }
      }

      // Load danh sách nhóm từ get_donations.php
      function loadGroups() {
        fetch('get_donations.php?get_groups=true')
          .then(response => response.json())
          .then(data => {
            const groupButtons = document.getElementById('groupButtons');
            groupButtons.innerHTML = ''; // Xóa các button cũ
            data.forEach(group => {
              const button = document.createElement('button');
              button.textContent = group.activity_code + ' - ' + (group.description || 'Không có mô tả');
              button.onclick = () => loadTable(group.activity_code, '');
              groupButtons.appendChild(button);
            });
            // Thêm các button cố định nếu không có dữ liệu từ server
            if (data.length === 0) {
              const defaultButtons = [
                { code: 'SL21325', desc: 'Chương trình trao tặng 100 suất học bổng' },
                { code: 'SL25325', desc: 'Xây dựng phòng học mới tại Cát Tiên' },
                { code: 'SL1425', desc: 'Khám bệnh miễn phí cho trẻ em vùng cao' }
              ];
              defaultButtons.forEach(btn => {
                const button = document.createElement('button');
                button.textContent = btn.code + ' - ' + btn.desc;
                button.onclick = () => loadTable(btn.code, '');
                groupButtons.appendChild(button);
              });
            }
          })
          .catch(error => console.error('Error loading groups:', error));
      }

      // Load tất cả dữ liệu và nhóm khi trang mở
      window.onload = function() {
        loadTable('', '');
        loadGroups();
      };
    </script>
  </body>
</html>