<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hoạt động</title>
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
    <section class="hero-banner-container">
      <div class="banner-overlay"></div>
      <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
        <h1>Hành trình yêu thương</h1>
        <p>Mỗi sự đóng góp nhỏ sẽ tạo nên những thay đổi lớn</p>
      </div>
      <div class="hero-banner-wrapper">
        <img src="imgthuyennguyen/thanh-lap-hoi-thien-nguyen_3009083623.jpg" alt="Hero Banner" class="hero-banner-img">
      </div>
      <div class="banner-shape-bottom">
        <svg viewBox="0 0 1440 100" preserveAspectRatio="none" fill="white">
          <path d="M0,0 C240,95 480,100 720,80 C960,60 1200,30 1440,70 L1440,100 L0,100 Z"></path>
        </svg>
      </div>
    </section>

    <!-- Nội dung chính -->
    <main class="main-content">
      <div class="content">
        <h1>Chia Sẻ Yêu Thương - Cùng Nhau Xây Dựng Tương Lai</h1>
        <h4>Cùng nhau, chúng ta gieo những hạt giống yêu thương, mỗi hành động là một lời hứa để mang lại hy vọng cho những mảnh đời khó khăn, giúp đỡ những trẻ em và học sinh vượt qua thử thách. Từ cộng đồng đến các tổ chức, hãy cùng chung tay xây dựng một xã hội nhân ái và bền vững cho các thế hệ tương lai.</h4>
        <hr class="section-divider">
      </div>

      <h2 class="section-title">HOẠT ĐỘNG NỔI BẬT</h2>
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

      <!-- Donation Section -->
<section class="donation-section" id="donation-section">
    <h2 class="section-title">HỖ TRỢ NGAY HÔM NAY</h2>
    <div class="header-container">
        <form class="search-form hvr-grow" action="/search" method="get">
            <input type="text" name="keyword" placeholder="Nhập từ khóa tìm kiếm..." class="search-input" />
            <button type="submit" title="Search" class="search-button hvr-bounce-in"><i class="fas fa-search"></i></button>
        </form>
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
                        <a href="donate.html?activity_code=SL21325" class="donate-button" target="_blank">Quyên Góp</a>
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
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Navigation Arrows -->
        <button class="carousel-arrow carousel-arrow-prev">&lt;</button>
        <button class="carousel-arrow carousel-arrow-next">&gt;</button>
    </div>
    
    
</section>

      

      <h2 class="section-title">HOẠT ĐỘNG</h2>
    <div class="post-list">
        <div class="card-container">
            <div class="card">
                <div class="card-left">
                    <img src="imgthuyennguyen/img1.jpg" alt="Hình ảnh chương trình học bổng">
                </div>
                <div class="card-right">
                    <h2>Chương trình học bổng và sách vở</h2>
                    <h3>Các tổ chức thiện nguyện cung cấp học bổng và quyên góp sách vở, đồ dùng học tập giúp trẻ em ở vùng khó khăn tiếp tục học hành.</h3>
                    <a href="post1.php">
                        <button class="card-button">Xem thêm</button>
                    </a>
                </div>
            </div>
            <div class="card reverse">
                <div class="card-left">
                    <img src="imgthuyennguyen/img2.png" alt="Hình ảnh xây dựng trường học">
                </div>
                <div class="card-right">
                    <h2>Xây dựng cơ sở vật chất trường học</h2>
                    <h3>Các chương trình xây dựng trường học, phòng học mới và cải thiện cơ sở vật chất tại các vùng khó khăn giúp nâng cao chất lượng giáo dục.</h3>
                    <a href="post1.html">
                        <button class="card-button">Xem thêm</button>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-left">
                    <img src="imgthuyennguyen/img3.jpg" alt="Hình ảnh hỗ trợ nhu yếu phẩm">
                </div>
                <div class="card-right">
                    <h2>Hỗ trợ nhu yếu phẩm và sinh hoạt</h2>
                    <h3>Các tổ chức thiện nguyện tổ chức các đợt trao quà, phát thực phẩm, quần áo, giày dép cho học sinh nghèo, giúp giảm bớt khó khăn trong sinh hoạt hàng ngày và hỗ trợ các em tiếp tục học tập.</h3>
                    <a href="post1.html">
                        <button class="card-button">Xem thêm</button>
                    </a>
                </div>
            </div>
            <div class="card reverse">
                <div class="card-left">
                    <img src="imgthuyennguyen/img4.jpg" alt="Hình ảnh khám chữa bệnh">
                </div>
                <div class="card-right">
                    <h2>Sức khỏe và khám chữa bệnh</h2>
                    <h3>Các tổ chức tổ chức khám bệnh miễn phí, phát thuốc và nâng cao nhận thức về vệ sinh, dinh dưỡng cho trẻ em.</h3>
                    <a href="post1.html">
                        <button class="card-button">Xem thêm</button>
                    </a>
                </div>
            </div>
            <div class="card">
                <div class="card-left">
                    <img src="imgthuyennguyen/img5.jpg" alt="Hình ảnh tình nguyện viên">
                </div>
                <div class="card-right">
                    <h2>Tình nguyện viên và kỹ năng sống</h2>
                    <h3>Các hoạt động tình nguyện và dạy kỹ năng sống giúp học sinh phát triển toàn diện và có cái nhìn tích cực về cuộc sống.</h3>
                    <a href="post1.html">
                        <button class="card-button">Xem thêm</button>
                    </a>
                </div>
            </div>
        </div>
    </div>


<!-- Quick Links Section -->
<div class="quick-links-section">
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <div class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fas fa-hand-holding-heart"></i>
                    </div>
                    <div class="quick-link-content">
                        <h5>Quyên góp tiền mặt</h5>
                        <p>Đóng góp tiền mặt trực tiếp cho các chương trình</p>
                        <a href="#donation-section" class="btn btn-outline-primary btn-sm">Quyên góp ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fas fa-gift"></i>
                    </div>
                    <div class="quick-link-content">
                        <h5>Quyên góp hiện vật</h5>
                        <p>Trao tặng quần áo, sách vở, đồ dùng học tập, đồ chơi</p>
                        <a href="hienvat1.php" class="btn btn-outline-success btn-sm">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="quick-link-card">
                    <div class="quick-link-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="quick-link-content">
                        <h5>Tình nguyện viên</h5>
                        <p>Tham gia các hoạt động thiện nguyện cộng đồng</p>
                        <a href="volunteer1.php" class="btn btn-outline-info btn-sm">Đăng ký ngay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

      <!-- Statistics Section -->
      <section class="statistics-section">
          <div class="container">
              <h2 class="section-title text-center">THÀNH QUẢ ĐẠT ĐƯỢC</h2>
              <div class="row">
                  <div class="col-lg-3 col-md-6 mb-4">
                      <div class="stat-item">
                          <div class="stat-icon">
                              <i class="fas fa-graduation-cap"></i>
                          </div>
                          <div class="stat-number" data-target="1250">0</div>
                          <div class="stat-label">Học bổng đã trao</div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 mb-4">
                      <div class="stat-item">
                          <div class="stat-icon">
                              <i class="fas fa-school"></i>
                          </div>
                          <div class="stat-number" data-target="45">0</div>
                          <div class="stat-label">Trường học được hỗ trợ</div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 mb-4">
                      <div class="stat-item">
                          <div class="stat-icon">
                              <i class="fas fa-heart"></i>
                          </div>
                          <div class="stat-number" data-target="8500">0</div>
                          <div class="stat-label">Trẻ em được hỗ trợ</div>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 mb-4">
                      <div class="stat-item">
                          <div class="stat-icon">
                              <i class="fas fa-hands-helping"></i>
                          </div>
                          <div class="stat-number" data-target="15600">0</div>
                          <div class="stat-label">Lượt quyên góp</div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
    </main>

    <!-- Footer -->
     <footer class="site-footer" >
        <div class="footer-container">
            <div class="footer-about">
                <h3>Về SUNFLAMECARE</h3>
                <p>SUNFLAMECARE là tổ chức phi lợi nhuận hoạt động với sứ mệnh hỗ trợ giáo dục và sức khỏe cho trẻ em có hoàn cảnh khó khăn tại Việt Nam.</p>
                <p>Được thành lập từ năm 2020, chúng tôi đã thực hiện nhiều chương trình thiện nguyện, giúp đỡ hơn 10,000 trẻ em trên khắp cả nước.</p>
            </div>
            <div class="footer-contact">
                <h3>Liên hệ</h3>
                <ul class="contact-list">
                    <li><i class="fas fa-map-marker-alt"></i>  470 Trần Đại Nghĩa, Ngũ Hành Sơn, Đà Nẵng</li>
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
 <script src="hienvat.js"></script>
 
 <!-- Enhanced JavaScript for donation carousel -->
 <script>
 // Enhanced carousel functionality
 function scrollCarousel(direction) {
     const carousel = document.querySelector('.donation-carousel');
     const cardWidth = carousel.querySelector('.donation-card').offsetWidth + 30; // Including gap
     const currentScroll = carousel.scrollLeft;
     
     const newScroll = currentScroll + (direction * cardWidth * 2); // Scroll 2 cards at a time
     
     carousel.scrollTo({
         left: newScroll,
         behavior: 'smooth'
     });
 }

 // Auto-scroll carousel
 let carouselAutoScroll = setInterval(() => {
     scrollCarousel(1);
 }, 5000);

 // Pause auto-scroll on hover
 const carouselContainer = document.querySelector('.donation-carousel-container');
 carouselContainer.addEventListener('mouseenter', () => {
     clearInterval(carouselAutoScroll);
 });

 carouselContainer.addEventListener('mouseleave', () => {
     carouselAutoScroll = setInterval(() => {
         scrollCarousel(1);
     }, 5000);
 });

 // Statistics counter animation
 function animateCounters() {
     const counters = document.querySelectorAll('.stat-number');
     const options = {
         threshold: 0.5
     };

     const observer = new IntersectionObserver((entries) => {
         entries.forEach(entry => {
             if (entry.isIntersecting) {
                 const counter = entry.target;
                 const target = parseInt(counter.getAttribute('data-target'));
                 const duration = 2000; // 2 seconds
                 const step = target / (duration / 16); // 60fps
                 let current = 0;

                 const updateCounter = () => {
                     current += step;
                     if (current < target) {
                         counter.textContent = Math.floor(current).toLocaleString();
                         requestAnimationFrame(updateCounter);
                     } else {
                         counter.textContent = target.toLocaleString();
                     }
                 };

                 updateCounter();
                 observer.unobserve(counter);
             }
         });
     }, options);

     counters.forEach(counter => {
         observer.observe(counter);
     });
 }

 // Initialize counter animation when DOM is loaded
 document.addEventListener('DOMContentLoaded', animateCounters);
 </script>
  </body>
</html>
