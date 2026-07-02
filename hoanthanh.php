<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hành Trình Yêu Thương - Giúp Đỡ Trẻ Em Khó Khăn | SUNFLAMECARE</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&family=Open+Sans:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <!-- Swiper JS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <!-- Main CSS -->
    <link rel="stylesheet" href="hoanthanh.css">
</head>
<body>
    <!-- Header -->
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

    <!-- Article Content -->
    <main class="article-content">
        <div class="article-container">
            <!-- Article Header -->
            <div class="article-header">
                <h1 class="article-title">Hành Trình Yêu Thương - Mang Ánh Sáng Đến Trẻ Em Vùng Cao Tháng 3/2025</h1>
                <div class="article-meta">
                    <div class="article-author">
                        <img src="https://i.pravatar.cc/40?img=3" alt="Avatar tác giả" class="author-avatar">
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
                <p>Chiến dịch "Hành Trình Yêu Thương" đã hoàn thành chuyến đi thiện nguyện tại các huyện vùng cao tỉnh Hà Giang với tổng giá trị hơn 60 triệu đồng, mang lại niềm vui và cơ hội học tập cho hơn 500 trẻ em. Bài viết dưới đây bao gồm thông tin chi tiết về hoạt động và báo cáo tài chính minh bạch.</p>
            </div>

            <!-- Article Body -->
            <div class="article-body">
                <section class="article-section">
                    <h2>Mục tiêu và ý nghĩa</h2>
                    <p>Chiến dịch "Hành Trình Yêu Thương" được SUNFLAMECARE phát động từ tháng 2/2025, nhằm hỗ trợ trẻ em có hoàn cảnh khó khăn tại các vùng cao phía Bắc Việt Nam. Với sự đóng góp của hơn 4,000 nhà hảo tâm từ khắp cả nước, chiến dịch đã gây quỹ thành công với tổng số tiền 750 triệu đồng.</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/91/5f/7b/915f7b98f94e532c5b41d61afdeae978.jpg" alt="Đoàn thiện nguyện chụp ảnh lưu niệm với trẻ em và người dân địa phương">
                        <p class="image-caption">Đoàn thiện nguyện chụp ảnh lưu niệm với trẻ em và người dân địa phương</p>
                    </div>
                    <p>Hoạt động chính của chiến dịch tập trung vào ba mục tiêu: (1) Xây dựng và sửa chữa cơ sở vật chất trường học, (2) Trao tặng học bổng và nhu yếu phẩm cho học sinh khó khăn, và (3) Tổ chức các hoạt động vui chơi, giao lưu văn hóa để nâng cao tinh thần cho trẻ em vùng cao.</p>
                </section>

                <section class="article-section">
                    <h2>Hành trình thiện nguyện</h2>
                    <p>Đoàn thiện nguyện của SUNFLAMECARE bao gồm 35 tình nguyện viên đã có chuyến đi kéo dài 7 ngày (từ 10-16/3/2025) đến các xã vùng cao của huyện Mèo Vạc và Đồng Văn, tỉnh Hà Giang. Hành trình trải qua nhiều thử thách với đường đèo dốc, thời tiết khắc nghiệt, nhưng tất cả đều được đền đáp bằng những nụ cười rạng rỡ của trẻ em nơi đây.</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/89/35/d1/8935d1fdd4b2512bef5e5ff249063956.jpg" alt="Trao học bổng cho học sinh xuất sắc">
                        <p class="image-caption">Lễ trao học bổng cho học sinh xuất sắc tại xã Trà Tập, tỉnh Quảng Nam.</p>
                    </div>
                    <p>Trong suốt hành trình, đoàn đã đến thăm và tổ chức hoạt động tại 5 điểm trường với các hoạt động cụ thể:</p>
                    <ul>
                        <li>Khánh thành 2 phòng học mới tại điểm trường thôn Tả Lủng, xã Pả Vi</li>
                        <li>Trao tặng 50 suất học bổng (mỗi suất 500 nghìn đồng) cho học sinh nghèo hiếu học</li>
                        <li>Trao 500 suất quà gồm sách vở, đồ dùng học tập, quần áo, và nhu yếu phẩm</li>
                        <li>Tổ chức khám sức khỏe và phát thuốc miễn phí cho 300 người dân địa phương</li>
                        <li>Tổ chức các hoạt động văn nghệ, trò chơi giáo dục và giao lưu văn hóa</li>
                    </ul>
                </section>

                <section class="article-section">
                    <h2>Những câu chuyện xúc động</h2>
                    <p>Trong chuyến đi, đoàn thiện nguyện đã gặp gỡ và lắng nghe nhiều câu chuyện cảm động từ trẻ em và người dân địa phương. Câu chuyện của em Giàng Thị Mỷ, học sinh lớp 4 tại Trường Tiểu học Pả Vi A, đã để lại ấn tượng sâu sắc với cả đoàn.</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/9b/0d/9a/9b0d9a2fa3802080fdfa48850f3307aa.jpg" alt="Niềm vui của trẻ em khi nhận quà">
                        <p class="image-caption">Niềm vui của các em học sinh khi nhận quà từ đoàn thiện nguyện</p>
                    </div>
                    <p>"Em phải đi bộ hơn 5km đường núi mỗi ngày đến trường, dù nắng hay mưa. Bố mẹ em làm nông, nên em phải dậy từ 4 giờ sáng để phụ giúp việc nhà trước khi đi học. Ước mơ của em là được trở thành cô giáo, để giúp các em nhỏ ở bản em có cơ hội học tập tốt hơn."</p>
                    <p>Câu chuyện của Mỷ là một trong nhiều hoàn cảnh khó khăn mà đoàn thiện nguyện gặp phải. Đó là lý do vì sao SUNFLAMECARE không chỉ tập trung vào việc trao quà mà còn hướng đến các giải pháp bền vững như xây dựng cơ sở vật chất và trao học bổng dài hạn.</p>
                </section>

                <section class="article-section">
                    <h2>Kết quả đạt được</h2>
                    <p>Sau 7 ngày hoạt động tích cực, chiến dịch "Hành Trình Yêu Thương" đã đạt được những kết quả ấn tượng:</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/d5/35/88/d535889eaf6ffb7d468cdb66f8b6360b.jpg" alt="Đoàn thiện nguyện và ban giám hiệu nhà trường">
                        <p class="image-caption">Đoàn thiện nguyện và ban giám hiệu nhà trường trong buổi lễ khánh thành phòng học mới</p>
                    </div>
                    <ul>
                        <li>Hoàn thành xây dựng và khánh thành 2 phòng học kiên cố với đầy đủ bàn ghế, bảng và trang thiết bị học tập</li>
                        <li>Trao tặng thành công 50 suất học bổng và 500 suất quà tới học sinh và người dân địa phương</li>
                        <li>Tổ chức thành công 5 buổi giao lưu văn hóa, giáo dục và 3 buổi khám chữa bệnh miễn phí</li>
                        <li>Kết nối và xây dựng mối quan hệ bền vững với chính quyền và nhà trường địa phương, tạo tiền đề cho các hoạt động hỗ trợ trong tương lai</li>
                        <li>Nâng cao nhận thức của cộng đồng về tầm quan trọng của giáo dục và sức khỏe cho trẻ em vùng cao</li>
                    </ul>
                </section>

                <section class="article-section">
                    <h2>Kế hoạch tiếp theo</h2>
                    <p>Không dừng lại ở thành công của chuyến đi tháng 3/2025, SUNFLAMECARE đang lên kế hoạch cho các hoạt động tiếp theo trong năm 2025-2026:</p>
                    <div class="article-image-container">
                        <img src="https://i.pinimg.com/736x/10/a6/07/10a607eb8a0c07db7f20824aa8d40d7d.jpg" 
                            alt="Các tình nguyện viên SUNFLAMECARE trong buổi họp lập kế hoạch" 
                            class="article-image-full">
                        <p class="image-caption">Các tình nguyện viên SUNFLAMECARE trong buổi họp lập kế hoạch cho chiến dịch tiếp theo</p>
                    </div>
                    <ul>
                        <li>Mở rộng phạm vi hoạt động đến các tỉnh Cao Bằng, Lào Cai và Sơn La</li>
                        <li>Phát triển mô hình "Thư viện thông minh" tại 10 trường học vùng cao</li>
                        <li>Triển khai chương trình "Đỡ đầu học sinh" với cam kết hỗ trợ học sinh khó khăn đến hết bậc THPT</li>
                        <li>Tổ chức các khóa tập huấn kỹ năng sống và định hướng nghề nghiệp cho học sinh THCS và THPT</li>
                        <li>Phát động chiến dịch gây quỹ lớn hơn, với mục tiêu 1,5 tỷ đồng cho các hoạt động năm 2024</li>
                    </ul>
                </section>

                <!-- Financial Statement Section -->
                <section class="article-section financial-statement-section" id="financial-section">
                    <h2>Báo Cáo Tài Chính Minh Bạch</h2>
                    <p>SUNFLAMECARE cam kết minh bạch trong mọi hoạt động tài chính. Dưới đây là báo cáo chi tiết thu - chi của chiến dịch "Hành Trình Yêu Thương" tháng 6/2023:</p>
                    
                    <div class="financial-container">
                        <div class="financial-summary">
                            <div class="finance-card">
                                <h4>Tổng thu</h4>
                            <div class="amount income">60,031,000 VNĐ</div>
                            <div class="finance-details">
                                <div>Quyên góp cá nhân: <span>55,031,000 VNĐ</span></div>
                                <div>Tài trợ doanh nghiệp: <span>5,000,000 VNĐ</span></div>
                            </div>
                            </div>
                            <div class="finance-card">
                                <h4>Tổng chi</h4>
                                <div class="amount expense">60,031,000 VNĐ</div>
                                <div class="finance-details">
                                    <div>Xây dựng cơ sở vật chất: <span>30,000,000 VNĐ</span></div>
                                    <div>Học bổng và quà tặng: <span>20,000,000 VNĐ</span></div>
                                    <div>Chi phí vận chuyển và tổ chức: <span>10,031,000 VNĐ</span></div>
                                </div>
                            </div>
                            <div class="finance-card">
                                <h4>Số dư</h4>
                                <div class="amount balance">0 VNĐ</div>
                                <div class="finance-details">
                                    <div>Được chuyển vào quỹ hoạt động tiếp theo</div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Detailed Financial Table -->
                        <div class="financial-details-section">
                            <h3>Chi tiết thu - chi</h3>
                            <div class="financial-tabs">
                                <button class="tab-btn active" data-tab="income-tab">Thu nhập</button>
                                <button class="tab-btn" data-tab="expense-tab">Chi tiêu</button>
                            </div>

                            <!-- Income Tab -->
                            <div id="income-tab" class="tab-pane active">
                                <div class="table-responsive">
                                    <table class="financial-table">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Ngày</th>
                                                <th>Nguồn thu</th>
                                                <th>Mô tả</th>
                                                <th>Số tiền (VNĐ)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>01/03/2025</td>
                                                <td>Quyên góp cá nhân</td>
                                                <td>Đóng góp từ các nhà hảo tâm</td>
                                                <td>55,031,000</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>05/03/2025</td>
                                                <td>Tài trợ doanh nghiệp</td>
                                                <td>Công ty TNHH ABC tài trợ</td>
                                                <td>5,000,000</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                                                <td class="fw-bold">60,031,000</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>

                            <!-- Expense Tab -->
                            <div id="expense-tab" class="tab-pane">
                                <div class="table-responsive">
                                    <table class="financial-table">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Ngày</th>
                                                <th>Mục đích</th>
                                                <th>Mô tả</th>
                                                <th>Số tiền (VNĐ)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>12/03/2025</td>
                                                <td>Xây dựng cơ sở vật chất</td>
                                                <td>Mua vật liệu xây dựng phòng học mới</td>
                                                <td>20,000,000</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>13/03/2025</td>
                                                <td>Xây dựng cơ sở vật chất</td>
                                                <td>Thuê nhân công xây dựng</td>
                                                <td>10,000,000</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>14/03/2025</td>
                                                <td>Học bổng và quà tặng</td>
                                                <td>Trao học bổng cho học sinh nghèo</td>
                                                <td>10,000,000</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>15/03/2025</td>
                                                <td>Học bổng và quà tặng</td>
                                                <td>Mua sách vở, đồ dùng học tập, quần áo</td>
                                                <td>10,000,000</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>16/03/2025</td>
                                                <td>Chi phí vận chuyển và tổ chức</td>
                                                <td>Thuê xe, ăn ở, tổ chức sự kiện</td>
                                                <td>10,031,000</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                                                <td class="fw-bold">60,031,000</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Financial Chart -->
                        <div class="financial-chart-section">
                            <h3>Phân bổ chi phí</h3>
                            <div class="chart-container">
                                <canvas id="expense-chart"></canvas>
                            </div>
                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    var ctx = document.getElementById('expense-chart').getContext('2d');
                                    var expenseChart = new Chart(ctx, {
                                        type: 'doughnut',
                                        data: {
                                            labels: [
                                                'Xây dựng cơ sở vật chất',
                                                'Học bổng và quà tặng',
                                                'Chi phí vận chuyển và tổ chức'
                                            ],
                                            datasets: [{
                                                data: [
                                                    30000000, // Xây dựng cơ sở vật chất (20tr + 10tr)
                                                    20000000, // Học bổng và quà tặng (10tr + 10tr)
                                                    10031000  // Chi phí vận chuyển và tổ chức
                                                ],
                                                backgroundColor: [
                                                    '#4e73df',
                                                    '#1cc88a',
                                                    '#f6c23e'
                                                ],
                                                borderWidth: 1
                                            }]
                                        },
                                        options: {
                                            responsive: true,
                                            plugins: {
                                                legend: {
                                                    position: 'bottom'
                                                },
                                                tooltip: {
                                                    callbacks: {
                                                        label: function(context) {
                                                            let value = context.parsed;
                                                            return context.label + ': ' + value.toLocaleString('vi-VN') + ' VNĐ';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                        </div>
                        
                    
                        
                        <!-- Download Section -->
                        <div class="download-section">
                            <h3>Tải báo cáo tài chính</h3>
                            <p>Bạn có thể tải báo cáo tài chính chi tiết dưới các định dạng sau:</p>
                            <div class="download-buttons">
                                <a href="#" class="download-btn">
                                    <i class="far fa-file-pdf"></i> Báo cáo PDF
                                </a>
                                <a href="#" class="download-btn">
                                    <i class="far fa-file-excel"></i> Báo cáo Excel
                                </a>
                                <a href="https://docs.google.com/spreadsheets/d/1594bFw8FCx25hGrIUJXNhM_bgQ4XJY2nJP5G0yHKo0g/edit?gid=1711500859#gid=1711500859" class="download-btn">
                                    <i class="far fa-file-archive"></i> Tất cả hóa đơn và chứng từ
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                
                <!-- Comment Section -->
                <section class="comment-section">
                    <h2>Bình luận và chia sẻ</h2>
                    <div class="comment-container">
                        <div class="comment-form-container">
                            <h3>Để lại bình luận của bạn</h3>
                            <form id="comment-form">
                                <div class="form-group">
                                    <label for="comment-name">Họ tên <span class="required">*</span></label>
                                    <input type="text" id="comment-name" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="comment-email">Email <span class="required">*</span></label>
                                    <input type="email" id="comment-email" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="comment-text">Nội dung bình luận <span class="required">*</span></label>
                                    <textarea id="comment-text" class="form-control" rows="4" required></textarea>
                                </div>
                                <button type="submit" class="submit-btn">Gửi bình luận</button>
                            </form>
                        </div>
                        
                        <h3>Bình luận (3)</h3>
                        <div class="comment-list" id="comment-list">
                            <div class="comment-item">
                                <img src="https://i.pravatar.cc/40?img=12" alt="Avatar" class="comment-avatar">
                                <div class="comment-content">
                                    <div class="comment-header">
                                        <span class="comment-author">Nguyễn Thị Hương</span>
                                        <span class="comment-date">2 ngày trước</span>
                                    </div>
                                    <div class="comment-text">
                                        Tôi rất xúc động khi đọc bài viết này. Thật tuyệt vời khi thấy có nhiều người trẻ cùng chung tay giúp đỡ trẻ em vùng cao. Mong rằng các em sẽ có cơ hội học tập tốt hơn và có tương lai tươi sáng!
                                    </div>
                                </div>
                            </div>
                            <div class="comment-item">
                                <img src="https://i.pravatar.cc/40?img=23" alt="Avatar" class="comment-avatar">
                                <div class="comment-content">
                                    <div class="comment-header">
                                        <span class="comment-author">Đinh Văn Tùng</span>
                                        <span class="comment-date">1 tuần trước</span>
                                    </div>
                                    <div class="comment-text">
                                        Rất ấn tượng với cách báo cáo tài chính minh bạch của chiến dịch. Tôi sẽ tham gia đóng góp cho các hoạt động sắp tới. Làm thế nào để tôi có thể đóng góp ngay từ bây giờ?
                                    </div>
                                </div>
                            </div>
                            <div class="comment-item">
                                <img src="https://i.pravatar.cc/40?img=33" alt="Avatar" class="comment-avatar">
                                <div class="comment-content">
                                    <div class="comment-header">
                                        <span class="comment-author">Trần Anh Dũng</span>
                                        <span class="comment-date">2 tuần trước</span>
                                    </div>
                                    <div class="comment-text">
                                        Tôi đã tham gia chiến dịch này với vai trò tình nguyện viên. Đây thực sự là một trải nghiệm đáng nhớ và ý nghĩa. Những nụ cười của các em học sinh là phần thưởng vô giá cho tất cả những nỗ lực của đoàn.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button class="load-more-btn" id="load-more-comments">Xem thêm bình luận</button>
                    </div>
                </section>
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
                    <a href="#">Chínsh sách bảo mật</a>
                    <a href="#">Chính sách cookie</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- AOS JS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <!-- Main JS -->
    <script src="post.js"></script>
    <script src="financial.js"></script>
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    <script src="hoatdong.js"></script>
    <script>
      // Khởi tạo AOS animation
      AOS.init();

      
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

// === HIỆU ỨNG CUỘN CHO NAVBAR ===
// Navbar scroll effect
function handleNavbarScroll() {
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled");
  } else {
    navbar.classList.remove("scrolled");
  }
}

// Smooth scrolling for navigation links
function initSmoothScrolling() {
  const navLinks = document.querySelectorAll('.navbar-menu a[href^="#"]');
  navLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href");
      const targetSection = document.querySelector(targetId);
      if (targetSection) {
        const offsetTop = targetSection.offsetTop - 80;
        window.scrollTo({
          top: offsetTop,
          behavior: "smooth",
        });
      }
    });
  });
}
    </script>
</body>
</html>