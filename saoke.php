<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Sao kê</title>
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@300;400;600&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- AOS Animation -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <!-- Swiper JS CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="congdong.css" />
  <link rel="stylesheet" href="saoke.css" />
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

      <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-overlay"></div>
      <div class="hero-content" data-aos="fade-up">
        <h1 class="hero-title">Hành Trình Yêu Thương</h1>
        <p class="hero-subtitle">Mang Ánh Sáng Đến Trẻ Em Vùng Cao</p>
        <div class="hero-stats">
          <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-number">500+</div>
            <div class="stat-label">Triệu đồng</div>
          </div>
          <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-number">500+</div>
            <div class="stat-label">Trẻ em</div>
          </div>
          <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-number">2000+</div>
            <div class="stat-label">Nhà hảo tâm</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Article Content -->
    <main class="article-content">
        <div class="article-container" data-aos="fade-up">
            <!-- Article Header -->
            <div class="article-header">
                <h1 class="article-title">Hành Trình Yêu Thương - Mang Ánh Sáng Đến Trẻ Em Vùng Cao Tháng 6/2023</h1>
                <div class="article-meta">
                    <div class="article-author">
                        <img src="https://i.pravatar.cc/60?img=3" alt="Avatar tác giả" class="author-avatar">
                        <div class="author-info">
                            <span class="author-name">Trần Minh Đức</span>
                            <span class="author-role">Trưởng Ban Điều Hành</span>
                        </div>
                    </div>
                    <div class="article-date">
                        <i class="far fa-calendar-alt"></i>
                        <span id="publish-date">Đang tải...</span>
                    </div>
                </div>
                <div class="article-share">
                    <span>Chia sẻ:</span>
                    <a href="#" class="share-link facebook" aria-label="Chia sẻ lên Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="share-link twitter" aria-label="Chia sẻ lên Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="share-link linkedin" aria-label="Chia sẻ lên LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="share-link email" aria-label="Chia sẻ qua Email"><i class="far fa-envelope"></i></a>
                </div>
            </div>

            <!-- Article Rating -->
            <div class="article-rating" data-aos="fade-up">
                <span>Đánh giá bài viết:</span>
                <div class="star-rating">
                    <i class="far fa-star" data-rating="1"></i>
                    <i class="far fa-star" data-rating="2"></i>
                    <i class="far fa-star" data-rating="3"></i>
                    <i class="far fa-star" data-rating="4"></i>
                    <i class="far fa-star" data-rating="5"></i>
                </div>
                <span class="rating-count">(0 đánh giá)</span>
            </div>

            <!-- Article Summary -->
            <div class="article-summary" data-aos="fade-up">
                <p>Chiến dịch "Hành Trình Yêu Thương" đã hoàn thành chuyến đi thiện nguyện tại các huyện vùng cao tỉnh Hà Giang với tổng giá trị hơn 700 triệu đồng, mang lại niềm vui và cơ hội học tập cho hơn 500 trẻ em. Bài viết dưới đây bao gồm thông tin chi tiết về hoạt động và báo cáo tài chính minh bạch.</p>
            </div>

            <!-- Article Body -->
            <div class="article-body">
                <section class="article-section" data-aos="fade-up">
                    <h2>Mục tiêu và ý nghĩa</h2>
                    <p>Chiến dịch "Hành Trình Yêu Thương" được SUNFLAMECARE phát động từ tháng 4/2023, nhằm hỗ trợ trẻ em có hoàn cảnh khó khăn tại các vùng cao phía Bắc Việt Nam. Với sự đóng góp của hơn 2,000 nhà hảo tâm từ khắp cả nước, chiến dịch đã gây quỹ thành công với tổng số tiền 750 triệu đồng.</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/91/5f/7b/915f7b98f94e532c5b41d61afdeae978.jpg" alt="Đoàn thiện nguyện chụp ảnh lưu niệm với trẻ em và người dân địa phương" loading="lazy">
                        <p class="image-caption">Đoàn thiện nguyện chụp ảnh lưu niệm với trẻ em và người dân địa phương</p>
                    </div>
                    <p>Hoạt động chính của chiến dịch tập trung vào ba mục tiêu: (1) Xây dựng và sửa chữa cơ sở vật chất trường học, (2) Trao tặng học bổng và nhu yếu phẩm cho học sinh khó khăn, và (3) Tổ chức các hoạt động vui chơi, giao lưu văn hóa để nâng cao tinh thần cho trẻ em vùng cao.</p>
                </section>

                <section class="article-section" data-aos="fade-up">
                    <h2>Hành trình thiện nguyện</h2>
                    <p>Đoàn thiện nguyện của SUNFLAMECARE bao gồm 35 tình nguyện viên đã có chuyến đi kéo dài 7 ngày (từ 10-16/6/2023) đến các xã vùng cao của huyện Mèo Vạc và Đồng Văn, tỉnh Hà Giang. Hành trình trải qua nhiều thử thách với đường đèo dốc, thời tiết khắc nghiệt, nhưng tất cả đều được đền đáp bằng những nụ cười rạng rỡ của trẻ em nơi đây.</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/89/35/d1/8935d1fdd4b2512bef5e5ff249063956.jpg" alt="Trao học bổng cho học sinh xuất sắc" loading="lazy">
                        <p class="image-caption">Lễ trao học bổng cho học sinh xuất sắc tại Trường Tiểu học Pả Vi A</p>
                    </div>
                    <p>Trong suốt hành trình, đoàn đã đến thăm và tổ chức hoạt động tại 5 điểm trường với các hoạt động cụ thể:</p>
                    <ul class="activity-list">
                        <li>Khánh thành 2 phòng học mới tại điểm trường thôn Tả Lủng, xã Pả Vi</li>
                        <li>Trao tặng 50 suất học bổng (mỗi suất 2 triệu đồng) cho học sinh nghèo hiếu học</li>
                        <li>Trao 500 suất quà gồm sách vở, đồ dùng học tập, quần áo, và nhu yếu phẩm</li>
                        <li>Tổ chức khám sức khỏe và phát thuốc miễn phí cho 300 người dân địa phương</li>
                        <li>Tổ chức các hoạt động văn nghệ, trò chơi giáo dục và giao lưu văn hóa</li>
                    </ul>
                </section>

                <section class="article-section" data-aos="fade-up">
                    <h2>Những câu chuyện xúc động</h2>
                    <p>Trong chuyến đi, đoàn thiện nguyện đã gặp gỡ và lắng nghe nhiều câu chuyện cảm động từ trẻ em và người dân địa phương. Câu chuyện của em Giàng Thị Mỷ, học sinh lớp 4 tại Trường Tiểu học Pả Vi A, đã để lại ấn tượng sâu sắc với cả đoàn.</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/9b/0d/9a/9b0d9a2fa3802080fdfa48850f3307aa.jpg" alt="Niềm vui của trẻ em khi nhận quà" loading="lazy">
                        <p class="image-caption">Niềm vui của các em học sinh khi nhận quà từ đoàn thiện nguyện</p>
                    </div>
                    <blockquote class="story-quote">
                        "Em phải đi bộ hơn 5km đường núi mỗi ngày đến trường, dù nắng hay mưa. Bố mẹ em làm nông, nên em phải dậy từ 4 giờ sáng để phụ giúp việc nhà trước khi đi học. Ước mơ của em là được trở thành cô giáo, để giúp các em nhỏ ở bản em có cơ hội học tập tốt hơn."
                    </blockquote>
                    <p>Câu chuyện của Mỷ là một trong nhiều hoàn cảnh khó khăn mà đoàn thiện nguyện gặp phải. Đó là lý do vì sao SUNFLAMECARE không chỉ tập trung vào việc trao quà mà còn hướng đến các giải pháp bền vững như xây dựng cơ sở vật chất và trao học bổng dài hạn.</p>
                </section>

                <!-- Donation System Section (Replaces Financial Report) -->
                <section class="donation-section" data-aos="fade-up">
                    <h2><i class="fas fa-heart"></i> Hỗ trợ chúng tôi</h2>
                    <p>Hãy cùng chúng tôi tiếp tục hành trình mang yêu thương đến những trẻ em vùng cao. Mỗi đóng góp của bạn đều có ý nghĩa to lớn.</p>
                    <div class="donation-actions">
                        <a href="hoatdong.php"><button class="donation-btn primary" id="donate-btn">
                            <i class="fas fa-donate"></i>
                            <span>Nhận quyên góp</span>
                        </button>
                        </a>
                         <a href="danhsach.php">
                               <button class="donation-btn secondary" id="donation-history-btn">
                            <i class="fas fa-history"></i>
                            <span>Xem lịch sử quyên góp</span>
                        </button>
                        </a>
                    </div>
                </section>

                <section class="article-section" data-aos="fade-up">
                    <h2>Kết quả đạt được</h2>
                    <p>Sau 7 ngày hoạt động tích cực, chiến dịch "Hành Trình Yêu Thương" đã đạt được những kết quả ấn tượng:</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/d5/35/88/d535889eaf6ffb7d468cdb66f8b6360b.jpg" alt="Đoàn thiện nguyện và ban giám hiệu nhà trường" loading="lazy">
                        <p class="image-caption">Đoàn thiện nguyện và ban giám hiệu nhà trường trong buổi lễ khánh thành phòng học mới</p>
                    </div>
                    <div class="achievements-grid">
                        <div class="achievement-card">
                            <i class="fas fa-school"></i>
                            <h4>2 phòng học kiên cố</h4>
                            <p>Hoàn thành xây dựng với đầy đủ trang thiết bị</p>
                        </div>
                        <div class="achievement-card">
                            <i class="fas fa-graduation-cap"></i>
                            <h4>50 suất học bổng</h4>
                            <p>Và 500 suất quà trao tặng</p>
                        </div>
                        <div class="achievement-card">
                            <i class="fas fa-users"></i>
                            <h4>5 buổi giao lưu</h4>
                            <p>Văn hóa và giáo dục</p>
                        </div>
                        <div class="achievement-card">
                            <i class="fas fa-stethoscope"></i>
                            <h4>3 buổi khám bệnh</h4>
                            <p>Chữa bệnh miễn phí</p>
                        </div>
                    </div>
                </section>

                <section class="article-section" data-aos="fade-up">
                    <h2>Kế hoạch tiếp theo</h2>
                    <p>Không dừng lại ở thành công của chuyến đi tháng 6/2023, SUNFLAMECARE đang lên kế hoạch cho các hoạt động tiếp theo trong năm 2023-2024:</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/10/a6/07/10a607eb8a0c07db7f20824aa8d40d7d.jpg" 
                            alt="Các tình nguyện viên SUNFLAMECARE trong buổi họp lập kế hoạch" loading="lazy">
                        <p class="image-caption">Các tình nguyện viên SUNFLAMECARE trong buổi họp lập kế hoạch cho chiến dịch tiếp theo</p>
                    </div>
                    <div class="future-plans">
                        <div class="plan-item">
                            <div class="plan-icon">
                                <i class="fas fa-calendar-check"></i>
                            </div>
                            <div class="plan-content">
                                <h4>Chương trình "Mùa đông ấm áp"</h4>
                                <p>Trao tặng 1,000 áo ấm cho trẻ em vùng cao trong mùa đông 2023</p>
                            </div>
                        </div>
                        <div class="plan-item">
                            <div class="plan-icon">
                                <i class="fas fa-laptop"></i>
                            </div>
                            <div class="plan-content">
                                <h4>Dự án "Công nghệ cho trẻ em vùng cao"</h4>
                                <p>Xây dựng phòng máy tính và đào tạo kỹ năng công nghệ thông tin</p>
                            </div>
                        </div>
                        <div class="plan-item">
                            <div class="plan-icon">
                                <i class="fas fa-book-open"></i>
                            </div>
                            <div class="plan-content">
                                <h4>Chương trình "Thư viện di động"</h4>
                                <p>Mang sách và kiến thức đến gần hơn với trẻ em các vùng xa</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Comments Section -->
            <div class="comments-section" data-aos="fade-up">
                <h3><i class="fas fa-comments"></i> Bình luận (<span id="comment-count">3</span>)</h3>
                
                <div class="comment-form-container">
                    <h4>Để lại bình luận</h4>
                    <form id="comment-form" class="comment-form">
                        
                        <div class="form-group">
                            <textarea id="comment-text" placeholder="Nội dung bình luận *" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="submit-comment-btn">
                            <i class="fas fa-paper-plane"></i>
                            Gửi bình luận
                        </button>
                    </form>
                </div>

                <div class="comments-list" id="comment-list">
                    <div class="comment-item">
                        <img src="https://i.pravatar.cc/50?img=15" alt="Avatar" class="comment-avatar">
                        <div class="comment-content">
                            <div class="comment-header">
                                <span class="comment-author">Nguyễn Văn An</span>
                                <span class="comment-date">2 ngày trước</span>
                            </div>
                            <div class="comment-text">
                                Tôi rất cảm động trước những hoạt động ý nghĩa của SUNFLAMECARE. Những việc làm này thực sự mang lại giá trị cho cộng đồng và giúp đỡ những trẻ em có hoàn cảnh khó khăn. Chúc tổ chức sẽ có nhiều hoạt động tốt đẹp hơn nữa!
                            </div>
                        </div>
                    </div>

                    <div class="comment-item">
                        <img src="https://i.pravatar.cc/50?img=25" alt="Avatar" class="comment-avatar">
                        <div class="comment-content">
                            <div class="comment-header">
                                <span class="comment-author">Phạm Thị Hoa</span>
                                <span class="comment-date">5 ngày trước</span>
                            </div>
                            <div class="comment-text">
                                Báo cáo rất chi tiết và minh bạch. Tôi đã quyên góp cho chiến dịch này và rất vui khi thấy số tiền được sử dụng đúng mục đích. Hy vọng sẽ có thêm nhiều người cùng chung tay giúp đỡ.
                            </div>
                        </div>
                    </div>

                    <div class="comment-item">
                        <img src="https://i.pravatar.cc/50?img=40" alt="Avatar" class="comment-avatar">
                        <div class="comment-content">
                            <div class="comment-header">
                                <span class="comment-author">Lê Minh Tuấn</span>
                                <span class="comment-date">1 tuần trước</span>
                            </div>
                            <div class="comment-text">
                                Những hình ảnh trong bài viết rất cảm động. Cảm ơn đoàn thiện nguyện đã mang niềm vui đến cho các em nhỏ. Tôi sẽ tiếp tục theo dõi và ủng hộ các hoạt động của tổ chức.
                            </div>
                        </div>
                    </div>
                </div>

                <button class="load-more-btn" id="load-more-comments">
                    <i class="fas fa-plus"></i>
                    Xem thêm bình luận
                </button>
            </div>
        </div>
    </main>

    <!-- Donation History Modal -->
<form action="http://localhost:3000/saoke.php"></form>

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
                <p class="copyright">©2023 SUNFLAMECARE. Tất cả quyền được bảo lưu.</p>
                <div class="footer-links">
                    <a href="#">Điều khoản sử dụng</a>
                    <a href="#">Chínsh sách bảo mật</a>
                    <a href="#">Chính sách cookie</a>
                </div>
            </div>
        </div>
    </footer>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
  <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
  <!-- Custom JavaScript -->
  <script src="congdong.js"></script>
  <script src="anhten.js"></script>
  <script src="saoke.js"></script>
  <script>
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

  </script>

</body>
</html>
