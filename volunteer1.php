<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <title>Đăng ký tình nguyện viên</title>
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
     <link rel="stylesheet" href="hoatdong.css" />
     <link rel="stylesheet" href="volunteer.css" />
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
    <!-- <script src="congdong.js"></script> -->

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
    <section class="hero-banner-container">
        <div class="banner-overlay"></div>
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
            <h1>Tham gia hành trình yêu thương</h1>
            <p>Hãy cùng SUNFLAMECARE lan tỏa yêu thương đến cộng đồng</p>
        </div>
        <div class="hero-banner-wrapper">
            <img src="imgthuyennguyen/thanh-lap-hoi-thien-nguyen_3009083623.jpg" alt="Volunteer Hero Banner" class="hero-banner-img">
        </div>
        <div class="banner-shape-bottom">
            <svg viewBox="0 0 1440 100" preserveAspectRatio="none" fill="white">
                <path d="M0,0 C240,95 480,100 720,80 C960,60 1200,30 1440,70 L1440,100 L0,100 Z"></path>
            </svg>
        </div>
    </section>

    <!-- Main Content -->
    <main class="main-content">
        <div class="container">

        <!-- How It Works Section -->
            <section class="how-it-works-section" id="process">
                <div class="container">
                    <h2 class="section-title text-center" data-aos="fade-up">Quy Trình Tham Gia</h2>
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                            <div class="step-card">
                                <div class="step-icon">
                                    <i class="fas fa-pencil-alt"></i>
                                </div>
                                <h5 class="step-title">Bước 1: Điền Thông Tin</h5>
                                <p class="step-description">
                                    Điền vào mẫu đăng ký với thông tin cá nhân và hoạt động mong muốn.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                            <div class="step-card">
                                <div class="step-icon">
                                    <i class="fas fa-phone-volume"></i>
                                </div>
                                <h5 class="step-title">Bước 2: Xác Nhận</h5>
                                <p class="step-description">
                                    Nhóm SUNFLAMECARE sẽ liên hệ để xác nhận và trao đổi chi tiết.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                            <div class="step-card">
                                <div class="step-icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <h5 class="step-title">Bước 3: Tham Gia Đào Tạo</h5>
                                <p class="step-description">
                                    Tham gia buổi hướng dẫn hoặc đào tạo trước khi bắt đầu hoạt động.
                                </p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="400">
                            <div class="step-card">
                                <div class="step-icon">
                                    <i class="fas fa-hand-holding-heart"></i>
                                </div>
                                <h5 class="step-title">Bước 4: Lan Tỏa Yêu Thương</h5>
                                <p class="step-description">
                                    Tham gia các hoạt động tình nguyện để hỗ trợ cộng đồng.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Volunteer Form Section -->
            <section class="volunteer-form-section" id="volunteer-form">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <div class="form-container" data-aos="fade-up">
                            <h2><i class="fas fa-hand-holding-heart"></i> Đăng Ký Tình Nguyện Viên</h2>
                            <p class="form-description">
                                Vui lòng điền đầy đủ thông tin để chúng tôi có thể liên hệ và sắp xếp lịch hoạt động phù hợp với bạn.
                            </p>
                            <div id="notificationContainer"></div>
                            <form id="volunteerForm" method="POST" action="http://localhost:3000/volunteer.php">
    <div class="row">
        <div class="col-md-6 mb-3">
			
            <label for="fullName" class="form-label">
                <i class="fas fa-user"></i> Họ và tên <span class="required">*</span>
            </label>
            <input type="text" class="form-control" id="fullName" name="full_name" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="phone" class="form-label">
                <i class="fas fa-phone"></i> Số điện thoại <span class="required">*</span>
            </label>
            <input type="tel" class="form-control" id="phone" name="phone" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="email" class="form-label">
                <i class="fas fa-envelope"></i> Email <span class="required">*</span>
            </label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="col-md-6 mb-3">
            <label for="dob" class="form-label">
                <i class="fas fa-calendar-alt"></i> Ngày sinh <span class="required">*</span>
            </label>
            <input type="date" class="form-control" id="dob" name="dob" required>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="address" class="form-label">
                <i class="fas fa-map-marker-alt"></i> Địa chỉ <span class="required">*</span>
            </label>
            <textarea class="form-control" id="address" name="address" rows="3" 
                placeholder="Số nhà, tên đường, phường/xã, quận/huyện, tỉnh/thành phố" required></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="gender" class="form-label">
                <i class="fas fa-venus-mars"></i> Giới tính <span class="required">*</span>
            </label>
            <select class="form-control" id="gender" name="gender" required>
                <option value="">Chọn giới tính</option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
                <option value="Khác">Khác</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="occupation" class="form-label">
                <i class="fas fa-briefcase"></i> Nghề nghiệp
            </label>
            <input type="text" class="form-control" id="occupation" name="occupation" 
                placeholder="VD: Sinh viên, Giáo viên, Kỹ sư...">
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="activityType" class="form-label">
                <i class="fas fa-handshake"></i> Loại hoạt động muốn tham gia <span class="required">*</span>
            </label>
            <select class="form-control" id="activityType" name="activity_type" required>
                <option value="">Chọn loại hoạt động</option>
                <option value="Hỗ trợ giáo dục">Hỗ trợ giáo dục</option>
                <option value="Hỗ trợ y tế">Hỗ trợ y tế</option>
                <option value="Hoạt động cộng đồng">Hoạt động cộng đồng</option>
                <option value="Thu gom hiện vật">Thu gom hiện vật</option>
                <option value="Khác">Khác</option>
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label for="availability" class="form-label">
                <i class="fas fa-clock"></i> Thời gian có thể tham gia
            </label>
            <input type="text" class="form-control" id="availability" name="availability" 
                placeholder="VD: Thứ 2-6, 8:00-17:00 hoặc Cuối tuần">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="emergency_contact" class="form-label">
                <i class="fas fa-ambulance"></i> Liên hệ khẩn cấp
            </label>
            <input type="text" class="form-control" id="emergency_contact" name="emergency_contact" 
                placeholder="VD:Số điện thoại">
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="skills" class="form-label">
                <i class="fas fa-tools"></i> Kỹ năng hoặc kinh nghiệm
            </label>
            <textarea class="form-control" id="skills" name="skills" rows="3" 
                placeholder="VD: Dạy học, tổ chức sự kiện, truyền thông, y tế..."></textarea>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="notes" class="form-label">
                <i class="fas fa-sticky-note"></i> Ghi chú thêm
            </label>
            <textarea class="form-control" id="notes" name="notes" rows="2" 
                placeholder="Thông tin thêm mà bạn muốn chia sẻ..."></textarea>
        </div>
    </div>

    <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
        <label class="form-check-label" for="agreeTerms">
            Tôi đồng ý với <a href="#" class="text-primary">điều khoản sử dụng</a> 
            và xác nhận thông tin trên là chính xác <span class="required">*</span>
        </label>
    </div>

    <div class="text-center">
        <button type="submit" class="btn-submit">
            <i class="fas fa-paper-plane"></i> Gửi Đăng Ký
        </button>
    </div>
</form>
                        </div>
                    </div>
                </div>
            </section>

            <div class="carousel-container">
        <div class="carousel">
          <img src="imgthuyennguyen/slide1.jpg" class="carousel-img active" alt="Hình ảnh 1">
          <img src="imgthuyennguyen/slide3.jpg" class="carousel-img" alt="Hình ảnh 2">
          <img src="imgthuyennguyen/slide2.jpg" class="carousel-img" alt="Hình ảnh 3">
          <img src="imgthuyennguyen/slide6.jpg" class="carousel-img" alt="Hình ảnh 4">
          <img src="imgthuyennguyen/slide11.jpg" class="carousel-img" alt="Hình ảnh 5">
          <img src="imgthuyennguyen/slide5.jpg" class="carousel-img" alt="Hình ảnh 6">
        </div>
      </div>

            
        </div>
    </main>

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
                    <a href="#" class="social-link" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-link" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-link" title="YouTube"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="social-link" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-link" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <div class="newsletter">
                    <h4>Đăng ký nhận tin</h4>
                    <form class="newsletter-form">
                        <input type="email" placeholder="Email của bạn" required>
                        <button type="submit" title="Đăng ký nhận tin">
                            <span class="visually-hidden">Đăng ký nhận tin</span>
                            <i class="far fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p class="copyright">© 2023 SUNFLAMECARE. Tất cả quyền được bảo lưu.</p>
                <div class="footer-links">
                    <a href="#">Điều khoản sử dụng</a>
                    <a href="#">Chính sách bảo mật</a>
                    <a href="#">Chính sách cookie</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="hoatdong.js"></script>
    <script src="volunteer.js"></script>
    </body>
</html>