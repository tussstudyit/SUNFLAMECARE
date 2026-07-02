<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tài chính</title>
    <!-- Consolidated Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@300;400;600&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet" />
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <!-- Swiper JS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="taichinh.css" />
    
    <!-- <link rel="stylesheet" href="hoatdong.css" /> -->
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

<script src="anhten.js"></script>
<!-- Hero Banner Section -->
        <!-- Hero Banner Section -->
    <section class="banner-container">
      <div class="hr-cont" data-aos="fade-up" data-aos-duration="1000">
        <h1> Cùng nhìn lại thành quả và tiếp tục đồng hành cùng các dự án</h1>
        <p>Mọi khoản đóng góp của bạn đều được ghi nhận minh bạch tại trang TÀI CHÍNH</p>
      </div>
      <div class="hr-banner-wrapper">
        <img src="img/taichinh.jpg" alt="Hero Banner" class="hr-banner-img">
      </div>

    </section>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-background">
            <div class="hero-particles"></div>
        </div>
        <div class="container">
            <div class="hero-content" data-aos="fade-up">
                <div class="hero-layout">
                    <div class="hero-left" data-aos="fade-right">
                        <div class="hero-badge">
                            <i class="fas fa-fire"></i>
                            <span>Dự án thiện nguyện</span>
                        </div>
                        <h1 class="hero-title">
                            <span class="title-line">SUNFLAMECARE</span>
                            <span class="title-subtitle">Thắp sáng hy vọng - Trao gửi yêu thương</span>
                        </h1>
                        <p class="hero-description">
                            Tham gia cùng chúng tôi trong việc xây dựng một cộng đồng yêu thương, 
                            nơi mỗi đóng góp đều tạo nên sự khác biệt tích cực cho những hoàn cảnh khó khăn.
                        </p>
                        <div class="hero-stats">
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                                <div class="stat-icon">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="stat-content">
                                    <span class="stat-label">Cập nhật hàng ngày</span>
                                    <span class="stat-value">Vào buổi tối</span>
                                </div>
                            </div>
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                                <div class="stat-icon">
                                    <i class="fas fa-file-invoice-dollar"></i>
                                </div>
                                <div class="stat-content">
                                    <span class="stat-label">Sao kê toàn bộ</span>
                                    <span class="stat-value">Trước 2 ngày</span>
                                </div>
                            </div>
                            <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                                <div class="stat-icon">
                                    <i class="fas fa-user"></i>
                                </div>
                                <div class="stat-content">
                                    <span class="stat-label">Giám sát bởi</span>
                                    <span class="stat-value">20+ tình nguyện viên</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-right" data-aos="fade-left" data-aos-delay="200">
                        <div class="hero-card">
                            <div class="card-header">
                                <div class="card-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <h3>Trang tài chính & Sao kê dự án</h3>
                                <p>Được cập nhật bởi chính các thành viên trong dự án Sunflamecare</p>
                            </div>
                            <div class="card-content">
                                <div class="commitment-block">
                                    <div class="block-header">
                                        <i class="fas fa-shield-alt"></i>
                                        <h4>Cam kết minh bạch</h4>
                                    </div>
                                    <p>Dự án Sunflamecare vận hành theo nguyên tắc <strong>"minh bạch tuyệt đối"</strong> và <strong>"chặt chẽ hơn cả tiêu chuẩn thông thường"</strong>.</p>
                                </div>
                                <div class="features-list">
                                    <div class="feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Thiết kế cơ chế kiểm soát nội bộ đa tầng</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Lắng nghe ý kiến đóng góp từ cộng đồng</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-check-circle"></i>
                                        <span>Cập nhật liên tục phương pháp quản lý tài chính</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid" data-aos="fade-up">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="stat-number" id="ProjectCount">0</div>
                    <div class="stat-label">Dự án hoàn thành</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-number" id="MemJoin">0</div>
                    <div class="stat-label">Thành viên tham gia</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-donate"></i>
                    </div>
                    <div class="stat-number"><span id="totalFund">0</span> VNĐ</div>
                    <div class="stat-label">Tổng số tiền được quyên góp</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Transparency Section -->
    <section class="transparency-section">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <div class="section-badge">
                    <i class="fas fa-eye"></i>
                    <span>Minh bạch</span>
                </div>
                <h2 class="section-title">8+ CÁCH MINH BẠCH</h2>
                <p class="section-subtitle">Mà dự án Sunflamecare đang cố gắng áp dụng</p>
            </div>
            <div class="transparency-grid">
                <div class="transparency-column" data-aos="fade-right">
                    <div class="column-header documents">
                        <i class="fas fa-file-alt"></i>
                        <h3>Về mặt giấy tờ</h3>
                    </div>
                    <div class="transparency-items">
                        <div class="transparency-item">
                            <div class="item-icon">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                            <div class="item-content">
                                <h4>XÁC NHẬN BẰNG VĂN BẢN QUA INBOX</h4>
                                <p>Mỗi khi nhận được 1 khoản tiền chuyển qua INBOX (Có kèm mã QR). Dự án sẽ gửi phiếu nhận sau 24-48h thông qua INBOX, kèm theo thông tin chi tiết của dự án.</p>
                            </div>
                        </div>
                        <div class="transparency-item">
                            <div class="item-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="item-content">
                                <h4>CÓ CÔNG KHAI SAO KÊ TÀI KHOẢN</h4>
                                <p>Ngay phía dưới phần này, là công khai TOÀN BỘ sao kê gửi tới cho dự án. được cập nhật 2 ngày 1 lần.</p>
                            </div>
                        </div>
                        <div class="transparency-item">
                            <div class="item-icon">
                                <i class="fas fa-receipt"></i>
                            </div>
                            <div class="item-content">
                                <h4>GIẤY TỜ ĐỀ NGHỊ THANH TOÁN - XÁC NHẬN</h4>
                                <p>Dự án cung cấp các giấy tờ đề nghị thanh toán và xác nhận nhận tiền từ các bên liên quan công khai trên Fanpage, Group.</p>
                            </div>
                        </div>
                        <div class="transparency-item">
                            <div class="item-icon">
                                <i class="fas fa-university"></i>
                            </div>
                            <div class="item-content">
                                <h4>CHỈ CÓ 01 TÀI KHOẢN DUY NHẤT</h4>
                                <p>Để tránh việc khó kiểm soát cũng như minh bạch, chúng tôi chỉ dùng 01 tài khoản duy nhất được công khai tại sunflamecare.org.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="transparency-column" data-aos="fade-left">
                    <div class="column-header practical">
                        <i class="fas fa-hands-helping"></i>
                        <h3>Về mặt thực tế</h3>
                    </div>
                    <div class="transparency-items">
                        <div class="transparency-item">
                            <div class="item-icon">
                                <i class="fas fa-users-cog"></i>
                            </div>
                            <div class="item-content">
                                <h4>CÓ ĐỘI NGŨ GIÁM SÁT ĐA DẠNG</h4>
                                <p>Sunflamecare có đội ngũ giám sát đa dạng bao gồm các thành viên từ nhiều lĩnh vực khác nhau để đảm bảo tính khách quan.</p>
                            </div>
                        </div>
                        <div class="transparency-item">
                            <div class="item-icon">
                                <i class="fas fa-camera"></i>
                            </div>
                            <div class="item-content">
                                <h4>CÓ HÌNH ẢNH - VIDEO MINH CHỨNG</h4>
                                <p>Mọi hoạt động của dự án đều được ghi lại bằng hình ảnh và video để làm bằng chứng minh bạch với cộng đồng.</p>
                            </div>
                        </div>
                        <div class="transparency-item">
                            <div class="item-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <div class="item-content">
                                <h4>LẮNG NGHE PHẢN HỒI TỪ CỘNG ĐỒNG</h4>
                                <p>Chúng tôi luôn lắng nghe và tiếp nhận các ý kiến phản hồi từ cộng đồng để cải thiện hoạt động của dự án.</p>
                            </div>
                        </div>
                        <div class="transparency-item">
                            <div class="item-icon">
                                <i class="fas fa-handshake"></i>
                            </div>
                            <div class="item-content">
                                <h4>HỢP TÁC VỚI CÁC CHUYÊN GIA</h4>
                                <p>Sunflamecare được hỗ trợ bởi các chuyên gia từ tổ chức phi lợi nhuận, kiểm toán viên tâm huyết.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ongoing Donation Projects Section -->
    <!-- Donation Section -->
<section class="donation-section" id="donation-section">
    <h2 class="section-title">CÁC DỰ ÁN ĐANG THỰC HIỆN</br><h3 style="text-align: center;">Những hoạt động thiện nguyện đang được triển khai</h3></h2>
    <div class="header-container">
        
    </div>
    
    <div class="donation-carousel-container">
        <div class="carousel-wrapper">
            <div class="donation-carousel">
                <!-- Card 1 -->
                <div class="donation-card">
                    <div class="donation-image">
                        <img src="img/traohocbonghagiang.webp" alt="Quyên góp học bổng">
                        <span class="donation-status ongoing">Đang diễn ra</span>
                    </div>
                    <div class="donation-content">
                        <h3>Chương trình trao tặng học bổng</h3>
                        <h5>Mã HĐ: SL21325</h5>
                        <p>Hỗ trợ học bổng cho học sinh nghèo vượt khó, giúp các em tiếp tục con đường học vấn.</p>
                        <div class="progress-bar">
                            <div class="progress progress-0"></div>
                        </div>
                        <div class="donation-stats">
                            <div class="stat">
                                <span class="label">Đã quyên góp</span>
                                <span class="value">4.031.000 VND</span>
                            </div>
                            <div class="stat">
                                <span class="label">Mục tiêu</span>
                                <span class="value">5.000.000 VND</span>
                            </div>
                        </div>
                        <div class="donation-meta">
                            <span>Lượt quyên góp: 3.901</span>
                            <span>Đạt 81%</span>
                        </div>
                        <div class="donation-actions">
                            <a href="donate.html?activity_code=SL21325" class="donate-button" target="_blank">Quyên Góp</a>
                            <br />
                            <a href="saoke.php" class="saoke-button">Tìm hiểu thêm</a>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="donation-card">
                    <div class="donation-image">
                        <img src="img/xaynhatinhthuong.jpg" alt="Xây dựng phòng học">
                        <span class="donation-status ongoing">Đang diễn ra</span>
                    </div>
                    <div class="donation-content">
                        <h3>Xây dựng nhà tình thương</h3>
                        <h5>Mã HĐ: SL25325</h5>
                        <p>Xây dựng ngôi nhà mới cho các gia đình có hoàn cảnh khó khăn.</p>
                        <div class="progress-bar">
                            <div class="progress progress-0"></div>
                        </div>
                        <div class="donation-stats">
                            <div class="stat">
                                <span class="label">Đã quyên góp</span>
                                <span class="value">135.000.000 VND</span>
                            </div>
                            <div class="stat">
                                <span class="label">Mục tiêu</span>
                                <span class="value">300.000.000 VND</span>
                            </div>
                        </div>
                        <div class="donation-meta">
                            <span>Lượt quyên góp: 1.247</span>
                            <span>Đạt 45%</span>
                        </div>
                        <a href="donate.html?activity_code=SL25325" class="donate-button" target="_blank">Quyên Góp</a>
                        <br />
                        <a href="saoke.php" class="saoke-button">Tìm hiểu thêm</a>
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="donation-card">
                    <div class="donation-image">
                        <img src="imgthuyennguyen/img4.jpg" alt="Khám bệnh miễn phí">
                        <span class="donation-status ongoing">Đang diễn ra</span>
                    </div>
                    <div class="donation-content">
                        <h3>Khám bệnh cho trẻ em vùng cao</h3>
                        <h5>Mã HĐ: SL1425</h5>
                        <p>Tổ chức khám bệnh, phát thuốc miễn phí, tuyên truyền sức khỏe cho trẻ em nghèo.</p>
                        <div class="progress-bar">
                            <div class="progress progress-0"></div>
                        </div>
                        <div class="donation-stats">
                            <div class="stat">
                                <span class="label">Đã quyên góp</span>
                                <span class="value">97.500.000 VND</span>
                            </div>
                            <div class="stat">
                                <span class="label">Mục tiêu</span>
                                <span class="value">150.000.000 VND</span>
                            </div>
                        </div>
                        <div class="donation-meta">
                            <span>Lượt quyên góp: 842</span>
                            <span>Đạt 65%</span>
                        </div>
                        <a href="donate.html?activity_code=SL1425" class="donate-button" target="_blank">Quyên Góp</a>
                        <br />
                        <a href="saoke.php" class="saoke-button">Tìm hiểu thêm</a>
                    </div>
                </div>
                <!-- Card 4 -->
                <div class="donation-card">
                    <div class="donation-image">
                        <img src="img/chamsocnguoigia.jpg" alt="Hỗ trợ nhu yếu phẩm">
                        <span class="donation-status ongoing">Đang diễn ra</span>
                    </div>
                    <div class="donation-content">
                        <h3>Chăm sóc người già</h3>
                        <h5>Mã HĐ: SL7525</h5>
                        <p>Hỗ trợ thuốc men và chăm sóc sức khỏe cho người già neo đơn.</p>
                        <div class="progress-bar">
                            <div class="progress progress-0"></div>
                        </div>
                        <div class="donation-stats">
                            <div class="stat">
                                <span class="label">Đã quyên góp</span>
                                <span class="value">35.000.000 VND</span>
                            </div>
                            <div class="stat">
                                <span class="label">Mục tiêu</span>
                                <span class="value">50.000.000 VND</span>
                            </div>
                        </div>
                        <div class="donation-meta">
                            <span>Lượt quyên góp: 2.150</span>
                            <span>Đạt 75%%</span>
                        </div>
                        <a href="donate.html?activity_code=SL7525" class="donate-button" target="_blank">Quyên Góp</a>
                        <br />
                        <a href="saoke.php" class="saoke-button">Tìm hiểu thêm</a>
                    </div>
                </div>
                <!-- Card 5 -->
                <div class="donation-card">
                    <div class="donation-image">
                        <img src="imgthuyennguyen/img5.jpg" alt="Dạy kỹ năng sống">
                        <span class="donation-status ongoing">Đang diễn ra</span>
                    </div>
                    <div class="donation-content">
                        <h3>Dạy kỹ năng sống cho trẻ em</h3>
                        <h5>Mã HĐ: SL22425</h5>
                        <p>Tổ chức các lớp học kỹ năng sống để giúp trẻ em vùng cao phát triển toàn diện.</p>
                        <div class="progress-bar">
                            <div class="progress progress-0"></div>
                        </div>
                        <div class="donation-stats">
                            <div class="stat">
                                <span class="label">Đã quyên góp</span>
                                <span class="value">27.500.000 VND</span>
                            </div>
                            <div class="stat">
                                <span class="label">Mục tiêu</span>
                                <span class="value">50.000.000 VND</span>
                            </div>
                        </div>
                        <div class="donation-meta">
                            <span>Lượt quyên góp: 1.320</span>
                            <span>Đạt 55%</span>
                        </div>
                        <a href="donate.html?activity_code=SL22425" class="donate-button" target="_blank">Quyên Góp</a>
                        <br />
                        <a href="saoke.php" class="saoke-button">Tìm hiểu thêm</a>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Navigation Arrows -->
        <button class="carousel-arrow carousel-arrow-prev">&lt;</button>
        <button class="carousel-arrow carousel-arrow-next">&gt;</button>
    </div>
    
    
</section>

    <!-- Completed Donation Projects Section -->
    <!-- Donation Section -->
<section class="donation-section" id="donation-section">
    <h2 class="section-title">CÁC DỰ ÁN ĐÃ HOÀN THÀNH</br><h3 style="text-align: center;">Những hoạt động thiện nguyện đã triển khai</h3></h2>
    <div class="header-container">
        
    </div>
    
    <div class="donation-carousel-container">
        <div class="carousel-wrapper">
            <div class="donation-carousel">
                <!-- Card 1 -->
                <div class="donation-card">
                    <div class="donation-image">
                        <img src="imgthuyennguyen/donate1.png" alt="Quyên góp học bổng">
                        <span class="donation-status ongoing">Đang diễn ra</span>
                    </div>
                    <div class="donation-content">
                        <h3>Giúp đỡ xã Trà Tập</h3>
                        <h5>Mã HĐ: SL1125</h5>
                        <p>Hỗ trợ học bổng cho học sinh nghèo vượt khó tại xã Trà Tập, tỉnh Quảng Nam.</p>
                        <div class="progress-bar">
                            <div class="progress progress-0"></div>
                        </div>
                        <div class="donation-stats">
                            <div class="stat">
                                <span class="label">Đã quyên góp</span>
                                <span class="value">60.031.000 VND</span>
                            </div>
                            <div class="stat">
                                <span class="label">Mục tiêu</span>
                                <span class="value">50.000.000 VND</span>
                            </div>
                        </div>
                        <div class="donation-meta">
                            <span>Lượt quyên góp: 4.901</span>
                            <span>Đạt 120%</span>
                        </div>
                        <a href="hoanthanh.php" class="donate-button">Đã hoàn thành</a>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="donation-card">
                    <div class="donation-image">
                        <img src="imgthuyennguyen/donate2.png" alt="Xây dựng phòng học">
                        <span class="donation-status ongoing">Đang diễn ra</span>
                    </div>
                    <div class="donation-content">
                        <h3>Giúp đỡ xã Trà Dơn</h3>
                        <h5>Mã HĐ: SL81224</h5>
                        <p>Cải thiện cơ sở vật chất trường học tại xã Trà Dơn, tỉnh Quảng Nam.</p>
                        <div class="progress-bar">
                            <div class="progress progress-0"></div>
                        </div>
                        <div class="donation-stats">
                            <div class="stat">
                                <span class="label">Đã quyên góp</span>
                                <span class="value">300.000.000 VND</span>
                            </div>
                            <div class="stat">
                                <span class="label">Mục tiêu</span>
                                <span class="value">300.000.000 VND</span>
                            </div>
                        </div>
                        <div class="donation-meta">
                            <span>Lượt quyên góp: 1.247</span>
                            <span>Đạt 100%</span>
                        </div>
                        <a href="hoanthanh.php" class="donate-button">Đã hoàn thành</a>
                    </div>
                </div>
                
                <!-- Card 3 -->
                <div class="donation-card">
                    <div class="donation-image">
                        <img src="imgthuyennguyen/donate3.png" alt="Hỗ trợ nhu yếu phẩm">
                        <span class="donation-status ongoing">Đang diễn ra</span>
                    </div>
                    <div class="donation-content">
                        <h3>Tựa nắng ôm bản</h3>
                        <h5>Mã HĐ: SL5625</h5>
                        <p>Trao tặng quần áo, đồ dùng thiết yếu cho trẻ em đồng bào tại xã Trà Giác, tỉnh Quảng Nam.</p>
                        <div class="progress-bar">
                            <div class="progress progress-0"></div>
                        </div>
                        <div class="donation-stats">
                            <div class="stat">
                                <span class="label">Đã quyên góp</span>
                                <span class="value">50.000.000 VND</span>
                            </div>
                            <div class="stat">
                                <span class="label">Mục tiêu</span>
                                <span class="value">50.000.000 VND</span>
                            </div>
                        </div>
                        <div class="donation-meta">
                            <span>Lượt quyên góp: 2.150</span>
                            <span>Đạt 100%</span>
                        </div>
                        <a href="donate.html?activity_code=SL7525" class="donate-button" target="_blank">Đã hoàn thành</a>
                    </div>
                </div>

                
        
        
        <!-- Navigation Arrows -->
        <button class="carousel-arrow carousel-arrow-prev">&lt;</button>
        <button class="carousel-arrow carousel-arrow-next">&gt;</button>
    </div>
    
    
</section>

    <!-- Volunteer Section -->
    <section class="volunteer-section">
        <div class="volunteer-container">
            <div class="volunteer-header">
                <p class="volunteer-subtitle">Chung tay vì cộng đồng</p>
                <h2 class="volunteer-title">Gửi trao yêu thương</h2>
            </div>
            <div class="volunteer-content">
                <p class="volunteer-text">
                    Mỗi khoản đóng góp của bạn là một tia sáng hy vọng, giúp chúng tôi
                    thực hiện các dự án ý nghĩa và mang lại sự thay đổi tích cực cho
                    những hoàn cảnh khó khăn.
                </p>
                <a href="hoatdong.php">
                    <button class="volunteer-btn" aria-label="Đóng góp ngay">Đóng góp ngay</button>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="footer-container">
            <div class="footer-about">
                <h3>Về SUNFLAMECARE</h3>
                <p>SUNFLAMECARE là tổ chức phi lợi nhuận hoạt động với sứ mệnh hỗ trợ giáo dục và sức khỏe cho trẻ em có hoàn cảnh khó khăn tại Việt Nam.</p>
                <p>Được thành lập từ năm 2020, chúng tôi đã thực hiện nhiều chương trình thiện nguyện, giúp đỡ hơn 10,000 trẻ em trên khắp cả nước.</p>
            </div>
            <div class="footer-contact">
                <h3>Liên hệ</h3>
                <ul class="contact-list">
                    <li><i class="fas fa-map-marker-alt"></i> 470 Trần Đại Nghĩa, Ngũ Hành Sơn, Đà Nẵng</li>
                    <li><i class="fas fa-phone"></i> (024) 1234 5678</li>
                    <li><i class="fas fa-envelope"></i> info@sunflamecare.org</li>
                </ul>
            </div>
            <div class="footer-social">
                <h3>Kết nối</h3>
                <div class="social-links">
                    <a href="#" class="social-link" title="Facebook" aria-label="Kết nối qua Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link" title="Twitter" aria-label="Kết nối qua Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link" title="YouTube" aria-label="Kết nối qua YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-link" title="Instagram" aria-label="Kết nối qua Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link" title="LinkedIn" aria-label="Kết nối qua LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="newsletter">
                    <h4>Đăng ký nhận tin</h4>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Email của bạn" required aria-label="Nhập email để đăng ký nhận tin" />
                        <button type="submit" title="Đăng ký nhận tin" aria-label="Đăng ký nhận tin">
                            <span class="visually-hidden">Đăng ký nhận tin</span>
                            <i class="far fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p class="copyright">© <?php echo date('Y'); ?> SUNFLAMECARE. Tất cả quyền được bảo lưu.</p>
                <div class="footer-links">
                    <a href="#">Điều khoản sử dụng</a>
                    <a href="#">Chính sách bảo mật</a>
                    <a href="#">Chính sách cookie</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Donation Carousel Functionality
document.addEventListener("DOMContentLoaded", () => {
  const carousel = document.querySelector(".donation-carousel");
  const cards = document.querySelectorAll(".donation-card");
  const prevButton = document.querySelector(".carousel-arrow-prev");
  const nextButton = document.querySelector(".carousel-arrow-next");

  if (carousel && cards.length > 0 && prevButton && nextButton) {
    let currentIndex = 0;
    const totalCards = cards.length;
    let cardsPerView = 3; // Default for desktop

    // Function to update cards per view based on screen size
    const updateCardsPerView = () => {
      if (window.innerWidth <= 768) {
        cardsPerView = 1;
      } else if (window.innerWidth <= 1024) {
        cardsPerView = 2;
      } else {
        cardsPerView = 3;
      }
    };

    // Function to update carousel position
    const updateCarouselPosition = () => {
      const cardWidth = cards[0].offsetWidth + 30; // Including gap
      const offset = -currentIndex * cardWidth;
      carousel.style.transform = `translateX(${offset}px)`;
    };

    // Next button handler
    nextButton.addEventListener("click", () => {
      updateCardsPerView();
      if (currentIndex < totalCards - cardsPerView) {
        currentIndex++;
      } else {
        currentIndex = 0; // Loop back to start
      }
      updateCarouselPosition();
    });

    // Previous button handler
    prevButton.addEventListener("click", () => {
      updateCardsPerView();
      if (currentIndex > 0) {
        currentIndex--;
      } else {
        currentIndex = totalCards - cardsPerView; // Loop to end
      }
      updateCarouselPosition();
    });

    // Update on window resize
    window.addEventListener("resize", () => {
      updateCardsPerView();
      updateCarouselPosition();
    });

    // Initial setup
    updateCardsPerView();
    updateCarouselPosition();
  }
});

// Hàm cập nhật chiều cao header động với giá trị dự phòng
function updateHeaderHeight() {
  const header = document.querySelector("#site-header");
  if (header) {
    const headerHeight =
      header.offsetHeight || (window.innerWidth <= 768 ? 60 : 110); // Giá trị dự phòng: 60px cho mobile, 110px cho desktop
    document.documentElement.style.setProperty(
      "--header-height",
      `${headerHeight}px`
    );
  }
}

window.addEventListener("scroll", function () {
  const navbar = document.querySelector(".navbar");
  const header = document.querySelector("#site-header");
  if (navbar && header) {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
      header.classList.add("scrolled");
      updateHeaderHeight(); // Cập nhật chiều cao khi header hiện
    } else {
      navbar.classList.remove("scrolled");
      header.classList.remove("scrolled");
    }
  }
});

// Gọi hàm updateHeaderHeight khi trang tải và khi thay đổi kích thước cửa sổ
window.addEventListener("resize", updateHeaderHeight);
window.addEventListener("load", updateHeaderHeight);

document.addEventListener("DOMContentLoaded", function () {
  // Lấy tất cả các thẻ donation-card
  const donationCards = document.querySelectorAll(".donation-card");

  donationCards.forEach((card) => {
    // Lấy số tiền đã quyên góp, mục tiêu và trạng thái
    const donatedElement = card.querySelector(
      ".donation-stats .stat:first-child .value"
    );
    const goalElement = card.querySelector(
      ".donation-stats .stat:last-child .value"
    );
    const statusElement = card.querySelector(".donation-status");

    if (donatedElement && goalElement && statusElement) {
      // Lấy giá trị số từ chuỗi (loại bỏ "VND" và dấu chấm)
      const donatedText = donatedElement.textContent.replace(/[^\d]/g, "");
      const goalText = goalElement.textContent.replace(/[^\d]/g, "");

      const donated = parseInt(donatedText, 10);
      const goal = parseInt(goalText, 10);

      // Tính tỷ lệ phần trăm
      let percentage = (donated / goal) * 100;

      // Giới hạn tối đa 100% nếu vượt mục tiêu
      if (percentage > 100) {
        percentage = 100;
      }

      // Lấy thẻ progress
      const progressBar = card.querySelector(".progress");

      if (progressBar) {
        // Cập nhật chiều rộng thanh tiến độ
        progressBar.style.width = percentage + "%";

        // Nếu đạt hoặc vượt mục tiêu, thêm lớp full và cập nhật trạng thái
        if (donated >= goal) {
          progressBar.classList.add("full");
          statusElement.textContent = "Đã hoàn thành";
          statusElement.classList.remove("ongoing");
          statusElement.classList.add("completed");
        } else {
          statusElement.textContent = "Đang diễn ra";
          statusElement.classList.add("ongoing");
          statusElement.classList.remove("completed");
        }
      }
    }
  });
});
    </script>

    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    
    <!-- Custom JavaScript -->
    
    <script src="script.js"></script>
    <script src="congdong.js"></script>
    <script src="hoatdong.js"></script>
    <script src="anhten.js"></script>
</body>
</html>