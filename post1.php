<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Bài viết</title>
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
    <link rel="stylesheet" href="postnguyen.css" />
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

<script src="anhten.js"></script>
<script src="updateUserInfo.js"></script>

    <!-- Article Content -->
    <main class="article-content">
        <div class="article-container">
            <!-- Article Header -->
            <div class="article-header">
                <h1 class="article-title">Hành Trình Tri Thức - Mang Học Bổng và Sách Vở Đến Mọi Miền Đất Nước</h1>
                <div class="article-meta">
                    <div class="article-author">
                        <img src="https://i.pravatar.cc/40" alt="Avatar tác giả" class="author-avatar">
                        <div class="author-info">
                            <span class="author-name">Nguyễn Văn Anh</span>
                            <span class="author-role">Tình nguyện viên</span>
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
            <div class="article-rating">
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
            <div class="article-summary">
                <p>Chương trình "Hành Trình Tri Thức" đã mang hơn 10,000 suất quà, học bổng và xây dựng 50 phòng học mới cho trẻ em tại các vùng khó khăn trên khắp Việt Nam. Cùng nhìn lại hành trình ý nghĩa này.</p>
            </div>

            <!-- Article Body -->
            <div class="article-body">
                <section class="article-section">
                    <h2>Khởi nguồn từ ước mơ</h2>
                    <p>"Vì một Việt Nam đẹp hơn" là chương trình thiện nguyện toàn quốc khởi động từ tháng 5/2023, nhằm hỗ trợ học sinh có hoàn cảnh khó khăn trên khắp Việt Nam. Với sự góp sức của hơn 5,000 nhà hảo tâm, chương trình đã quyên góp được hơn 10 tỷ đồng để mang sách vở, học bổng và cơ sở vật chất đến các em.</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/91/5f/7b/915f7b98f94e532c5b41d61afdeae978.jpg" alt="Tình nguyện viên giao lưu với học sinh tại một trường tiểu học ở miền Trung">
                        <p class="image-caption">Tình nguyện viên giao lưu với học sinh tại một trường tiểu học ở miền Trung</p>
                    </div>
                    <p>Chương trình được khởi xướng bởi anh Nguyễn Văn Minh, một doanh nhân trẻ tại TP. Hồ Chí Minh. Sau nhiều chuyến đi thực tế đến các vùng sâu, vùng xa trên cả nước, anh nhận thấy những khó khăn chung của học sinh: thiếu sách vở, quần áo ấm, và cơ sở học tập xuống cấp. Điều này thôi thúc anh phát động một phong trào thiện nguyện quy mô lớn.</p>
                </section>

                <section class="article-section">
                    <h2>Các hoạt động nổi bật</h2>
                    <p>Trong 10 ngày hoạt động liên tục từ 10-20/8/2023, đoàn thiện nguyện với 200 tình nguyện viên đã triển khai nhiều hoạt động ý nghĩa tại 20 tỉnh thành từ Bắc vào Nam:</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/89/35/d1/8935d1fdd4b2512bef5e5ff249063956.jpg" alt="Trao học bổng" class="article-image">
                        <p class="image-caption">Lễ trao học bổng cho học sinh xuất sắc tại miền Nam</p>
                    </div>
                    <ul>
                        <li>Trao tặng 10,000 suất quà (sách vở, đồ dùng học tập, quần áo ấm) cho học sinh tại 100 trường học ở các vùng khó khăn.</li>
                        <li>Trao 500 suất học bổng (mỗi suất trị giá 5 triệu đồng) cho học sinh có thành tích học tập tốt nhưng hoàn cảnh đặc biệt khó khăn.</li>
                        <li>Khởi công xây dựng 50 phòng học mới tại các điểm trường ở các tỉnh như Lai Châu, Quảng Nam, và Cà Mau với tổng kinh phí 5 tỷ đồng.</li>
                        <li>Tổ chức khám sức khỏe và phát thuốc miễn phí cho hơn 5,000 người dân tại các vùng sâu, vùng xa.</li>
                        <li>Tổ chức các buổi giao lưu văn nghệ, trò chơi giáo dục để mang niềm vui đến học sinh địa phương.</li>
                    </ul>
                </section>

                <section class="article-section">
                    <h2>Những nụ cười lan tỏa</h2>
                    <p>Thành công lớn nhất của chương trình là mang lại niềm vui và hy vọng cho hàng ngàn học sinh trên khắp đất nước. Nhiều em lần đầu tiên nhận được sách giáo khoa mới, áo ấm cho mùa đông, hay những món quà nhỏ nhưng đầy ý nghĩa từ các tình nguyện viên.</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/9b/0d/9a/9b0d9a2fa3802080fdfa48850f3307aa.jpg" alt="Niềm vui trẻ em" class="article-image">
                        <p class="image-caption">Niềm vui của học sinh khi nhận quà tại một trường ở miền Bắc</p>
                    </div>
                    <p>Em Nguyễn Văn Hùng, học sinh lớp 5 tại một trường tiểu học ở Quảng Ngãi, chia sẻ: "Cháu rất vui khi được nhận sách mới và cặp sách. Cháu sẽ cố gắng học giỏi để cảm ơn các cô chú."</p>
                    <p>Cô Trần Thị Lan, Hiệu trưởng một trường tiểu học ở An Giang, xúc động nói: "Sự hỗ trợ của chương trình không chỉ giúp các em có điều kiện học tập tốt hơn mà còn tiếp thêm động lực cho giáo viên chúng tôi. Những phòng học mới đã giảm tình trạng học ca ba, tạo môi trường học tập khang trang hơn."</p>
                </section>

                <section class="article-section">
                    <h2>Tầm nhìn tương lai</h2>
                    <p>"Hành Trình Tri Thức" đặt mục tiêu mở rộng quy mô trong 5 năm tới, tiếp tục hỗ trợ giáo dục tại các vùng khó khăn trên cả nước. Các kế hoạch cụ thể bao gồm:</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/d5/35/88/d535889eaf6ffb7d468cdb66f8b6360b.jpg" alt="Kế hoạch tương lai" class="article-image">
                        <p class="image-caption">Ban tổ chức họp bàn kế hoạch mở rộng chương trình toàn quốc</p>
                    </div>
                    <ul>
                        <li>Xây dựng thêm 100 phòng học tại các điểm trường khó khăn trên cả nước.</li>
                        <li>Trao học bổng dài hạn (5 năm) cho 1,000 học sinh có hoàn cảnh đặc biệt khó khăn.</li>
                        <li>Phát triển thư viện số và hệ thống học trực tuyến cho 50 trường học ở vùng sâu, vùng xa.</li>
                        <li>Tổ chức các chương trình đào tạo kỹ năng sống và định hướng nghề nghiệp cho học sinh THCS và THPT.</li>
                    </ul>
                </section>


                <section class="article-section">
                    <h2>Kết luận</h2>
                    <p>"Hành Trình Tri Thức" không chỉ là một chương trình từ thiện mà còn là cầu nối yêu thương, gắn kết cộng đồng để mang lại cơ hội học tập bình đẳng cho trẻ em trên khắp Việt Nam. Mỗi nụ cười của các em là lời cảm ơn chân thành nhất đến những tấm lòng nhân ái.</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/10/a6/07/10a607eb8a0c07db7f20824aa8d40d7d.jpg" 
                            alt="Cùng nhau xây dựng tương lai tươi sáng cho trẻ em Việt Nam" 
                            class="article-image-full">
                        <p class="image-caption">Cùng nhau xây dựng tương lai tươi sáng cho trẻ em Việt Nam</p>
                    </div>
                    <p>Chúng tôi tin rằng, với sự đồng hành của mọi người, giáo dục Việt Nam sẽ ngày càng phát triển, không để bất kỳ học sinh nào bị bỏ lại phía sau.</p>
                </section>
            </div>

            <!-- Tags -->
            <div class="article-tags">
                <span>Thẻ:</span>
                <a href="#" class="tag">Từ thiện</a>
                <a href="#" class="tag">Học bổng</a>
                <a href="#" class="tag">Giáo dục</a>
                <a href="#" class="tag">Trẻ em</a>
                <a href="#" class="tag">Việt Nam</a>
            </div>

            <!-- Author Bio -->
            <div class="author-bio">
                <img src="https://i.pravatar.cc/80" alt="Avatar tác giả" class="author-avatar-large">
                <div class="author-bio-content">
                    <h3>Về tác giả</h3>
                    <h4>Nguyễn Văn Anh</h4>
                    <p>Tình nguyện viên với hơn 5 năm kinh nghiệm trong các chương trình từ thiện và giáo dục. Anh đã tham gia nhiều dự án hỗ trợ trẻ em khó khăn trên khắp Việt Nam và là một trong những người sáng lập "Hành Trình Tri Thức".</p>
                    <div class="author-social">
                        <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                        <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" title="Website cá nhân"><i class="fas fa-globe"></i></a>
                    </div>
                </div>
            </div>

            <!-- Related Articles -->
            <div class="related-articles">
                <h3>Bài viết liên quan</h3>
                <div class="related-grid">
                    <div class="related-article">
                        <img src="https://i.pinimg.com/736x/ef/19/a7/ef19a749a361337fae3cc0b3872e432b.jpg" alt="Bài viết liên quan 1">
                        <h4>Xây dựng trường học cho trẻ em vùng khó khăn</h4>
                        <p class="related-date">05/06/2023</p>
                    </div>
                    <div class="related-article">
                        <img src="https://i.pinimg.com/736x/cf/1a/f7/cf1af7359da657f4fe1d3999a2c05498.jpg" alt="Bài viết liên quan 2">
                        <h4>Học bổng "Chắp cánh ước mơ" cho học sinh nghèo</h4>
                        <p class="related-date">15/07/2023</p>
                    </div>
                    <div class="related-article">
                        <img src="https://i.pinimg.com/736x/a4/77/f1/a477f1953b54dffd8961bb9fd9264c51.jpg" alt="Bài viết liên quan 3">
                        <h4>Chương trình thư viện lưu động cho trẻ em vùng sâu</h4>
                        <p class="related-date">20/08/2023</p>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="comments-section">
                <h3>Bình luận (3)</h3>
                <div class="comment">
                    <img src="https://i.pravatar.cc/50?img=1" alt="Avatar người bình luận" class="comment-avatar">
                    <div class="comment-content">
                        <div class="comment-header">
                            <h4>Trần Thanh Tùng</h4>
                            <span class="comment-date">01/10/2023</span>
                        </div>
                        <p>Bài viết rất cảm động! Tôi rất ấn tượng với quy mô của chương trình này. Sẽ ủng hộ để các em học sinh khắp cả nước có cơ hội học tập tốt hơn.</p>
                        <div class="comment-actions">
                            <a href="#"><i class="far fa-thumbs-up"></i> Thích (15)</a>
                            <a href="#"><i class="far fa-comment"></i> Phản hồi</a>
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <img src="https://i.pravatar.cc/50?img=2" alt="Avatar người bình luận" class="comment-avatar">
                    <div class="comment-content">
                        <div class="comment-header">
                            <h4>Lê Minh Hiếu</h4>
                            <span class="comment-date">30/09/2023</span>
                        </div>
                        <p>Chương trình quá ý nghĩa! Tôi đã đóng góp 1 triệu đồng và hy vọng sẽ có thêm nhiều người cùng tham gia để hỗ trợ các em.</p>
                        <div class="comment-actions">
                            <a href="#"><i class="far fa-thumbs-up"></i> Thích (10)</a>
                            <a href="#"><i class="far fa-comment"></i> Phản hồi</a>
                        </div>
                    </div>
                </div>
                <div class="comment">
                    <img src="https://i.pravatar.cc/50?img=3" alt="Avatar người bình luận" class="comment-avatar">
                    <div class="comment-content">
                        <div class="comment-header">
                            <h4>Nguyễn Thị Hoa</h4>
                            <span class="comment-date">29/09/2023</span>
                        </div>
                        <p>Tôi là giáo viên tại Đà Nẵng và rất muốn tham gia tình nguyện cho chương trình. Làm sao để tôi có thể đăng ký làm tình nguyện viên?</p>
                        <div class="comment-actions">
                            <a href="#"><i class="far fa-thumbs-up"></i> Thích (7)</a>
                            <a href="#"><i class="far fa-comment"></i> Phản hồi</a>
                        </div>
                    </div>
                </div>

                <div class="load-more-comments">
                    <button class="load-more-btn">Xem thêm bình luận</button>
                </div>

                <div class="add-comment">
                    <h4>Thêm bình luận</h4>
                    <form id="comment-form">
                        <div class="form-group">
                            <label for="comment-name">Họ tên</label>
                            <input type="text" id="comment-name" required>
                        </div>
                        <div class="form-group">
                            <label for="comment-email">Email</label>
                            <input type="email" id="comment-email" required>
                        </div>
                        <div class="form-group">
                            <label for="comment-text">Bình luận</label>
                            <textarea id="comment-text" required></textarea>
                        </div>
                        <button type="submit" class="submit-comment">Gửi bình luận</button>
                    </form>
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
    <!-- AOS Animation JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript -->
    <script src="postnguyen.js"></script>
     <script src="hoatdong.js"></script>
</body>
</html>