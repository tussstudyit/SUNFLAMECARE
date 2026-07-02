<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Trang chủ</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      integrity="sha512-...tự động sinh ra..."
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="trangchu.css" />
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
    <link rel="stylesheet" href="congdong.css" />
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
<script src="congdong.js"></script>



 
   <!-- Main Slider Container -->
  <section id="home" class="main-slider-container">
    <div id="main-slide">
      <!-- Slide 1 -->
      <div
        class="main-slide-item"
        style="
          background-image: url(img/tc1.webp);
        "
      >
        <div class="content">
          <div class="name">Nâng Bước Em Đến Trường</div>
          <div class="des">
            Hàng ngàn em nhỏ nơi non cao đang chờ đợi những tấm lòng hảo tâm.
            Đóng góp của bạn, dù là hiện vật, tiền bạc hay sức lực, sẽ mở ra
            cánh cửa tri thức, mang đến một ngày mai tươi sáng hơn cho các em.
          </div>
          <button onclick="scrollToSection('mission')">Xem thêm</button>
        </div>
      </div>

      <!-- Slide 2 -->
      <div
        class="main-slide-item"
        style="
          background-image: url(img/tc2.jpg);
        "
      >
        <div class="content">
          <div class="name">Chắp Cánh Ước Mơ Thiên Thần</div>
          <div class="des">
            Sự quan tâm của bạn là món quà vô giá với những thiên thần nhỏ
            đang thiếu thốn tình thân. Cùng chúng tôi kiến tạo môi trường sống
            an toàn, đủ đầy, giúp các em tự tin vươn lên trong cuộc sống.
          </div>
          <button onclick="scrollToSection('mission')">Xem thêm</button>
        </div>
      </div>

      <!-- Slide 3 -->
      <div
        class="main-slide-item"
        style="
          background-image: url(img/tc3.jpg);
        "
      >
        <div class="content">
          <div class="name">Lan Tỏa Hơi Ấm Cho Cộng Đồng</div>
          <div class="des">
            Đừng để ai phải ngủ ngoài đường trong giá lạnh. Hãy cùng chúng tôi
            sẻ chia bằng hiện vật, tiền bạc hoặc thời gian tình nguyện để mang
            lại bữa ăn "0 đồng", quần áo ấm và sự an ủi cho những hoàn cảnh
            khó khăn nhất.
          </div>
          <button onclick="scrollToSection('mission')">Xem thêm</button>
        </div>
      </div>

      <!-- Slide 4 -->
      <div
        class="main-slide-item"
        style="
          background-image: url(img/tc2.webp);
        "
      >
        <div class="content">
          <div class="name">Khơi Dậy Tiềm Năng <br> Kiến Tạo Tương Lai</div>
          <div class="des">
            Tiềm năng của mỗi em nhỏ là vô hạn. Với sự đóng góp về tiền, hiện
            vật hoặc sức lực của bạn, chúng tôi có thể cung cấp các chương
            trình giáo dục, y tế và dinh dưỡng cần thiết, giúp các em phát
            triển toàn diện, vượt qua khó khăn và trở thành những công dân có
            ích cho xã hội.
          </div>
          <button onclick="scrollToSection('mission')">Xem thêm</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Mission Section -->
  <section id="mission" class="mission-section">
    <div class="container">
      <div class="mission-grid">
        <div class="mission-left" data-aos="fade-right">
          <img src="img/danvannamtramy.jpg" alt="Volunteers helping children" />
        </div>
        <div class="mission-right" data-aos="fade-left">
          <h2 style="color:rgb(13, 80, 116);font-weight: bold;">Sứ mệnh của SUNFLAMECARE</h2>
          <h3>
            Ươm mầm tri thức, thắp sáng tương lai
          </h3>

          <p>
            Với niềm tin "Sẻ chia là để yêu thương", SUNFLAMECARE ra đời để kết nối những tấm lòng nhân ái, cùng nhau thắp sáng tương lai cho trẻ em miền núi. Chúng tôi tập trung vào việc giúp các em đến trường, tiếp cận tri thức, xây dựng một ngày mai tươi sáng hơn. Hãy cùng chúng tôi mang yêu thương và hy vọng đến với các em nhỏ!
          </p>

          <!-- Statistics -->
          <div class="stats-grid">
            <div class="stat-item" data-aos="zoom-in" data-aos-delay="100">
              <div class="stat-number" id="projectCount">0</div>
              <div class="stat-label">Dự án</div>
            </div>
            <div class="stat-item" data-aos="zoom-in" data-aos-delay="200">
              <div class="stat-number" id="memberCount">0</div>
              <div class="stat-label">Thành viên</div>
            </div>
            <div class="stat-item" data-aos="zoom-in" data-aos-delay="300">
              <div class="stat-number" id="fundAmount">0</div>
              <div class="stat-label">Tổng quỹ (VNĐ)</div>
            </div>
          </div>

          <div class="mission-buttons">
          <a href="#dreams-section" class="btn-secondary">Tìm hiểu thêm về chúng tôi</a>
            <a href="volunteer1.php" class="btn-secondary">Trở thành tình nguyện viên</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Quick Links Section -->
<div id="quick-links" class="quick-links-section">
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
                        <a href="hoatdong.php" class="btn btn-outline-primary btn-sm">Quyên góp ngay</a>
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


<section class="donate-section">
    <div class="container">
      <div class="section-header" data-aos="fade-up">
        <h2 style="color:rgb(13, 80, 116);font-weight: bold;">Quy Trình Donate</h2>
        <p>
          Hướng dẫn chi tiết để bạn tham gia quyên góp và mang lại hy vọng cho
          các em nhỏ
        </p>
      </div>

      <div class="timeline">
        <div class="timeline-step" data-aos="fade-up" data-aos-delay="100">
          <div class="step-content">
            <div class="step-number">1</div>
            <h3 style="font-weight: bold;">TÌM HIỂU THÔNG TIN</h3>
            <p>
              Các bạn tìm hiểu thông tin qua website và fanpage, cách hoạt động của tổ chức SUNFLAMECARE
            </p>
            <a href="https://www.facebook.com/Tuthien.HandInHandVietHan" class="step-button">Link fanpage</a>
          </div>
          <div class="step-image">
            <img
              src="img/timhieupage.jpg"
              alt="Tìm hiểu thông tin"
            />
          </div>
        </div>

        <div class="timeline-step" data-aos="fade-up" data-aos-delay="150">
          <div class="step-content">
            <div class="step-number">2</div>
            <h3 style="font-weight: bold;">TÌM HIỂU VỀ DỰ ÁN MUỐN QUYÊN GÓP </h3>
            <p>
              Các bạn đến trang HOẠT ĐỘNG, để xem thêm các thông tin, các hoạt động và dự án đang cần hỗ trợ.
            </p>
            <a href="hoatdong.php" class="step-button">Tìm hiểu ngay</a>
          </div>
          <div class="step-image">
            <img src="img/step2.png" alt="HÀNH ĐỘNG" />
          </div>
        </div>

        <div class="timeline-step" data-aos="fade-up" data-aos-delay="200">
          <div class="step-content">
            <div class="step-number">3</div>
            <h3 style="font-weight: bold;">HÀNH ĐỘNG QUYÊN GÓP QUẦN ÁO HOẶC THANH TOÁN PHIÊN GIAO DỊCH </h3>
            <p>
              Các bạn thực hiện QUYÊN GÓP HIỆN KIM mong muốn hỗ trợ theo các bước hướng dẫn. Hoặc điền form nếu tham gia QUYÊN GÓP HIỆN VẬT.
            </p>
            <a href="#quick-links" class="step-button">Đóng góp ngay</a>
          </div>
          <div class="step-image">
            <img src="img/step3.png" alt="QUYÊN GÓP" />
          </div>
        </div>

        <div class="timeline-step" data-aos="fade-up" data-aos-delay="250">
          <div class="step-content">
            <div class="step-number">4</div>
            <h3 style="font-weight: bold;">TRA CỨU THÔNG TIN SAO KÊ GIAO DỊCH</h3>
            <p>
              Sau khi thanh toán các bạn vào trang TÀI CHÍNH , truy cập vào đúng trang dự án của mình để xem thông tin sao kê hỗ trợ của mình đã được duyệt chưa. <br>Trang SAO KÊ sẽ hỗ trợ sao kê số quỹ, tổng kết sao kê các hoạt động đang, đã diễn ra một cách MINH BẠCH
            </p>
            <a href="taichinh.php" class="step-button">TRA CỨU NGAY</a>
          </div>
          <div class="step-image">
            <img src="img/step4.png" alt="TRA CỨU" />
          </div>
        </div>

        <div class="timeline-step" data-aos="fade-up" data-aos-delay="300">
          <div class="step-content">
            <div class="step-number">5</div>
            <h3 style="font-weight: bold;">VÀO GROUP VÀ THEO DÕI TIẾN TRÌNH THỰC HIỆN DỰ ÁN </h3>
            <p>Thực hiện tham gia group của dự án, để theo dõi dự án, cũng như hỗ trợ nếu tổ chức cần thiết. GROUP sẽ cập nhật tiến trình chuẩn bị, các hoạt động của dự án sẽ được đăng lên cho mạnh thường quân có thể theo dõi </p>
          </div>
          <div class="step-image">
            <img src="img/step5.png" alt="THAM GIA GROUP" />
          </div>
        </div>

      </div>
    </div>
  </section>


  <section id="dreams-section" class="dreams-section">
    <div class="container">
      <div class="section-header" data-aos="fade-up">
        <h2 style="color:rgb(13, 80, 116);font-weight: bold;">Nụ cười hồn nhiên nơi rẻo cao</h2>
        <p>
          Ánh mắt trẻ thơ miền núi, trong veo tựa sương mai, là lời thỉnh cầu thầm lặng về một tương lai tươi sáng hơn.
        </p>
      </div>
  
      <div class="dreams-grid">
        <div class="dream-item" data-aos="fade-up" data-aos-delay="100">
          <img src="img/hih10.webp" alt="h1" />
        </div>
  
        <div class="dream-item" data-aos="fade-up" data-aos-delay="150">
          <img src="img/hih2.jpg" alt="h2" />
        </div>
  
        <div class="dream-item" data-aos="fade-up" data-aos-delay="300">
          <img src="img/hih3.jpg" alt="h3" />
        </div>
  
        <div class="dream-item" data-aos="fade-up" data-aos-delay="200">
          <img src="img/hih4.jpg" alt="h4" />
        </div>
  
        <div class="dream-item" data-aos="fade-up" data-aos-delay="250">
          <img src="img/hih5.jpg" alt="h5" />
        </div>
  
        <div class="dream-item" data-aos="fade-up" data-aos-delay="350">
          <img src="img/hih6.jpg" alt="h6" />
        </div>
  
        <div class="dream-item" data-aos="fade-up" data-aos-delay="400">
          <img src="img/hih7.jpg" alt="h7" />
        </div>
  
        <div class="dream-item" data-aos="fade-up" data-aos-delay="450">
          <img src="img/hih8.jpg" alt="h8" />
        </div>
  
        <div class="dream-item" data-aos="fade-up" data-aos-delay="500">
          <img src="img/hih9.jpg" alt="h9" />
        </div>
       
      </div>
      <p style="text-align: center; font-size: 20px; font-weight: bold">
        Nhìn những ánh mắt trong veo, nụ cười hồn nhiên của trẻ thơ vùng cao, liệu trái tim bạn có rung động? Các em, với tuổi thơ mộc mạc giữa núi rừng, đang thắp lên tia hy vọng về một tương lai tươi sáng hơn. Mỗi tấm lòng sẻ chia hôm nay sẽ là ánh sáng dẫn lối cho những ước mơ mai sau. Hãy cùng chúng tôi mang yêu thương đến với các em! </BR>

      </p>
    </div>
  </section>
  <section class="dreams-section">
    <div class="container">
      <div class="section-header" data-aos="fade-up">
        <h2 style="color:rgb(13, 80, 116);font-weight: bold;" >HÀNH TRÌNH CỦA SUNFLAMECARE</h2>
        <p>
          SUNFLAMECARE không chỉ là một cái tên, mà là một ngọn lửa hy vọng
          thắp sáng những ước mơ giản dị của trẻ em vùng khó khăn. Chúng tôi
          tự hào biến những khát khao về bữa cơm no đủ và ngày đến trường
          thành hiện thực, bắt đầu từ những hành động nhỏ nhưng đầy ý nghĩa và
          thiết thực
        </p>
      </div>

      <div class="dreams-grid">
        <div class="dream-item" data-aos="fade-up" data-aos-delay="100">
          <img src="img/vechai.jpg" alt="thu gom ve chai" />
          <div class="dream-caption">
            <p>
              "Thu gom ve chai, SUNFLAMECARE gây quỹ, thắp sáng ước mơ cho
              em."
            </p>
          </div>
        </div>

        <div class="dream-item" data-aos="fade-up" data-aos-delay="150">
          <img
            src="img/quyengopdocu.jpg"
            alt="Thu gom các đồ dùng học tập cũ, đồ cũ"
          />
          <div class="dream-caption">
            <p>"Gom đồ cũ, trao cơ hội học tập cho em."</p>
          </div>
        </div>
        <div class="dream-item" data-aos="fade-up" data-aos-delay="300">
          <img
            src="img/banhanggayquy.jpg"
            alt="Tổ chức các cuộc đua bán hàng gây quỹ"
          />
          <div class="dream-caption">
            <p>
              "Cuộc đua bán hàng, gây quỹ giúp em được tổ chức thường xuyên ."
            </p>
          </div>
        </div>

        <div class="dream-item" data-aos="fade-up" data-aos-delay="200">
          <img src="img/comhih.jpg" alt="Thực hiện tổ chức dân vận" />
          <div class="dream-caption">
            <p>"Bữa ăn ngon, sân chơi vui cho em."</p>
          </div>
        </div>

        <div class="dream-item" data-aos="fade-up" data-aos-delay="250">
          <img src="img/trochuyentamsuhih.jpg" alt="Trò chuyện tâm sự" />
          <div class="dream-caption">
            <p>"Lắng nghe, động viên, đồng hành cùng gia đình."</p>
          </div>
        </div>

        <div class="dream-item" data-aos="fade-up" data-aos-delay="350">
          <img src="img/vannghe.jpg" alt="Giao lưu văn nghệ" />
          <div class="dream-caption">
            <p>"Văn nghệ rộn ràng, niềm vui bên em."</p>
          </div>
        </div>

        <div class="dream-item" data-aos="fade-up" data-aos-delay="400">
          <img src="img/thietbi.jpg" alt="Hỗ trợ csvc gia đình khó khăn" />
          <div class="dream-caption">
            <p>
              "Hỗ trợ lắp đặt, sửa chữa csvc cho những gia đình khó khăn."
            </p>
          </div>
        </div>

        <div class="dream-item" data-aos="fade-up" data-aos-delay="450">
          <img
            src="img/quathietthuc.jpg"
            alt="Trao tặng các phần quà thiết thực vào mùa xuân"
          />
          <div class="dream-caption">
            <p>"Quà Tết ấm áp, mang xuân đến bên em."</p>
          </div>
        </div>

        <div class="dream-item" data-aos="fade-up" data-aos-delay="500">
          <img
            src="img/hocbong.jpg"
            alt="Trao các suất học bổng cho các em"
          />
          <div class="dream-caption">
            <p>"Trao học bổng, khích lệ em vươn xa."</p>
          </div>
        </div>
      </div>
      <p style="text-align: center; font-size: 20px; font-weight: bold">
        Vượt xa những hành động đơn lẻ, SUNFLAMECARE không ngừng sáng tạo, kết
        nối cộng đồng để mang đến sự hỗ trợ toàn diện, từ bữa ăn, sách vở, đến
        những sân chơi rộn rã tiếng cười. Chúng tôi tin rằng, mỗi nỗ lực nhỏ
        hôm nay sẽ gieo mầm hy vọng, giúp các em nhỏ khó khăn vươn lên, chạm
        đến giấc mơ, và xây dựng một cuộc sống tốt đẹp hơn, nơi tương lai rộng
        mở, tràn đầy ánh sáng. </BR>

      </p>
      <p style="font-size:25px ;text-align: center;color: rgb(26, 124, 209);font-weight: bold;">
        DẪU ĐÔI CHÂN CÓ MỎI, NHƯNG NHÌN THẤY NỤ CƯỜI RẠNG RỠ CỦA CÁC EM <br> SUNFLAMECARE LUÔN SẴN SÀNG BƯỚC TIẾP !!!.
      </p>
    </div>
  </section>

  <!-- Volunteer Section -->
  <section class="volunteer-section">
    <div class="container">
      <div class="volunteer-grid">
        <div class="volunteer-left" data-aos="fade-right">
          <h2>Tham Gia Đội Ngũ Tình Nguyện Viên</h2>
          <p>
            Không chỉ đóng góp tiền bạc, bạn có thể tham gia trực tiếp vào các
            hoạt động thiện nguyện và tạo nên những thay đổi tích cực với
            chính đôi tay của mình.
          </p>

          <div class="benefits-list">
            <div class="benefit-item">
              <i class="fas fa-check-circle"></i>
              <span>Được đào tạo kỹ năng tình nguyện chuyên nghiệp</span>
            </div>
            <div class="benefit-item">
              <i class="fas fa-check-circle"></i>
              <span>Tham gia các chuyến đi thiện nguyện ý nghĩa</span>
            </div>
            <div class="benefit-item">
              <i class="fas fa-check-circle"></i>
              <span>Kết nối với cộng đồng người có cùng chí hướng</span>
            </div>
          </div>

          <a href="volunteer1.php" class="btn-volunteer" style="text-decoration: none;">
            <i class="fas fa-hands-helping"></i>
            ĐĂNG KÝ TÌNH NGUYỆN NGAY
    </a>
        </div>

        <div class="volunteer-right" data-aos="fade-left">
          <img
            src="img/đkitnv.jpg"
            alt="Volunteers"
          />
        </div>
      </div>
    </div>
  </section>

  <section id="news" class="containertintuc">
    <div class="container">
      <div class="news-activities-grid">
        <!-- Tin tức -->
        <section
          class="news-section"
          data-aos="fade-right"
          data-aos-duration="1000"
        >
          <h2 class="section-title" style="color:rgb(13, 80, 116);font-weight: bold;">TIN TỨC</h2>
          <div class="news-list">
            <div class="news-item" data-aos="fade-up" data-aos-delay="100">
              <div class="news-date">11/03/2025</div>
              <h3 class="news-title">
                <a href="#" class="news-link">
                  SUNFLAMECARE đã nâng cấp trạm y tế xã Kim Long, huyện Tam
                  Dương, tỉnh Hà Giang. Cải thiện cơ sở vật chất và trang
                  thiết bị y tế để phục vụ tốt hơn người dân địa phương.
                </a>
              </h3>
              <div class="news-excerpt">
                <p>
                  Chúng tôi đã hoàn thành nâng cấp cơ sở vật chất, cung cấp
                  thiết bị hiện đại cho trạm y tế, mang lại dịch vụ tốt hơn
                  cho cộng đồng.
                </p>
              </div>
              <a href="#" class="read-more"
                >Đọc thêm <i class="fas fa-arrow-right"></i
              ></a>
            </div>
            <div class="news-item" data-aos="fade-up" data-aos-delay="200">
              <div class="news-date">07/03/2025</div>
              <h3 class="news-title">
                <a href="#" class="news-link">
                  SUNFLAMECARE - VKU đã tổ chức trao tặng học bổng khuyến
                  khích học tập đến các em ở huyện Kprong, Đak Lak. Tạo động
                  lực cho các em phấn đấu hơn trong tương lai...
                </a>
              </h3>
              <div class="news-excerpt">
                <p>
                  Học bổng được trao nhằm khích lệ tinh thần học tập, mở ra cơ
                  hội cho các em học sinh nghèo vươn tới ước mơ.
                </p>
              </div>
              <a href="#" class="read-more"
                >Đọc thêm <i class="fas fa-arrow-right"></i
              ></a>
            </div>
            
          </div>
          <a href="hoatdong.php" class="view-more"
            >Xem tất cả tin tức <i class="fas fa-chevron-right"></i
          ></a>
        </section>
        <!-- Hoạt động -->
        <section
          class="hoatdong-section"
          data-aos="fade-left"
          data-aos-duration="1000"
        >
          <h2 style="color:rgb(13, 80, 116);font-weight: bold; " class="hoatdong-title">HOẠT ĐỘNG</h2>
          <div class="hoatdong-item" data-aos="zoom-in" data-aos-delay="100">
            <div class="hoatdong-card">
              <div class="hoatdong-image">
                <img src="img/tratap.jpg" alt="Trà Tập 2024" title="Trà Tập 2024" />
                <span class="hoatdong-badge">Hoạt động nổi bật</span>
              </div>
              <div class="hoatdong-content">
                <h3 class="content-title">DẤU ẤN SUNFLAMECARE</h3>
                <p style="font-weight: bold">
                  "TRÀ TẬP 2024 - ĐÔNG ẤM ĐẠI NGÀN"
                </p>
                <p>
                  Chương trình dân vận "Trà Tập 2024 - Đông Ấm Đại Ngàn" của
                  Nhóm từ thiện SUNFLAMECARE đã diễn ra thành công tốt đẹp từ
                  ngày 1/11 đến 3/11 tại nóc Răng Chuỗi, thôn 1, xã Trà Tập,
                  huyện Nam Trà My, Quảng Nam. Nhiều hoạt động ý nghĩa được tổ
                  chức nhằm cải thiện đời sống, mang lại niềm vui và hy vọng
                  cho bà con, đặc biệt là các em nhỏ. Những kỷ niệm và nụ cười
                  rạng rỡ từ những món quà ấm áp sẽ là động lực để chúng ta
                  tiếp tục hành trình sẻ chia. SUNFLAMECARE xin gửi lời cảm ơn
                  chân thành đến các nhà tài trợ, mạnh thường quân, cùng toàn
                  thể thành viên đã đồng hành, góp phần tạo nên thành công của
                  chương trình. <br />
                  Nguồn: Nhóm từ thiện HIH - Việt Hàn
                </p>
              </div>
            </div>
          </div>
          <a href="hoatdong.php" class="view-more"
            >Khám phá thêm hoạt động <i class="fas fa-chevron-right"></i
          ></a>
        </section>
      </div>
    </div>
  </section>
  

  <!-- Sponsors Section -->
  <section class="sponsors-section">
    <div class="container">
      <h2 data-aos="fade-up" style="color:rgb(13, 80, 116);font-weight: bold;">ĐƠN VỊ ĐỒNG HÀNH</h2>
      <p class="section-description" data-aos="fade-up" data-aos-delay="100">
        Sau những nỗ lực không ngừng nghỉ trong việc mang lại giá trị cho cộng
        đồng, chúng tôi tự hào nhận được sự đồng hành từ các nhà tài trợ tận
        tâm. Sự hỗ trợ của họ là nguồn động lực lớn, giúp chúng tôi tiếp tục
        các dự án thiện nguyện ý nghĩa trên khắp Việt Nam.
      </p>
      <div class="sponsors-slider" data-aos="fade-up" data-aos-delay="200">
        <div class="sponsors-track" id="sponsorsTrack">
          <div class="sponsor-item">
            <img src="img/logonuoiem.jpg" alt="Nhà tài trợ 1" />
          </div>
          <div class="sponsor-item">
            <img src="img/logosucmanh2000.png" alt="Nhà tài trợ 2" />
          </div>
          <div class="sponsor-item">
            <img src="img/vclogo.png" alt="Nhà tài trợ 3" />
          </div>
          <div class="sponsor-item">
            <img src="img/logotaitro4.webp" alt="Nhà tài trợ 4" />
          </div>
          <div class="sponsor-item">
            <img src="img/logotaitro5.png" alt="Nhà tài trợ 5" />
          </div>
          <div class="sponsor-item">
            <img src="img/logotaitro6.webp" alt="Nhà tài trợ 6" />
          </div>
          <div class="sponsor-item">
            <img src="img/logotaitro7.webp" alt="Nhà tài trợ 7" />
          </div>
          <div class="sponsor-item">
            <img src="img/logotaitro8.webp" alt="Nhà tài trợ 8" />
          </div>
        </div>
        <div class="sponsors-controls">
          <button class="sponsor-btn" id="prevSponsor">‹</button>
          <button class="sponsor-btn" id="nextSponsor">›</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Achievements Section -->
  <section class="achievements-section">
    <div class="container">
      <h2 data-aos="fade-up" style="color:rgb(13, 80, 116);font-weight: bold;">THAM KHẢO</h2>
      <p class="section-description" data-aos="fade-up" data-aos-delay="100">
        Những thành tựu này là minh chứng cho sự nỗ lực không ngừng của đội
        ngũ SUNFLAMECARE và sự hỗ trợ quý báu từ cộng đồng. Chúng tôi đã đạt
        được nhiều giấy khen và danh hiệu nhờ các dự án mang lại giá trị bền
        vững cho xã hội.
      </p>
      <div
        class="achievements-slider"
        data-aos="fade-up"
        data-aos-delay="200"
      >
        <div class="achievements-track" id="achievementsTrack">
          <div class="achievement-item">
            <img src="img/gk1.jpg" alt="Giấy khen 1" />
          </div>
          <div class="achievement-item">
            <img src="img/gk2.jpg" alt="Giấy khen 2" />
          </div>
          <div class="achievement-item">
            <img src="img/gk3.jpg" alt="Giấy khen 3" />
          </div>
          <div class="achievement-item">
            <img src="img/gk4.jpeg" alt="Giấy khen 4" />
          </div>
          <div class="achievement-item">
            <img src="img/gk5.png" alt="Giấy khen 5" />
          </div>
          <div class="achievement-item">
            <img src="img/gk6.jpg" alt="Giấy khen 6" />
          </div>
          <div class="achievement-item">
            <img src="img/gk7.jpg" alt="Giấy khen 7" />
          </div>
          <div class="achievement-item">
            <img src="img/gk8.jpg" alt="Giấy khen 8" />
          </div>
          <div class="achievement-item">
            <img src="img/gk9.jpg" alt="Giấy khen 9" />
          </div>
          <div class="achievement-item">
            <img src="img/gk10.jpg" alt="Giấy khen 10" />
          </div>
        </div>
        <div class="achievements-controls">
          <button class="achievement-btn" id="prevAchievement">‹</button>
          <button class="achievement-btn" id="nextAchievement">›</button>
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section class="testimonials-section">
    <div class="container">
      <div class="section-header" data-aos="fade-up">
        <h2 style="color:rgb(13, 80, 116);font-weight: bold;">CHIA SẺ TỪ NHỮNG NGƯỜI ĐỒNG HÀNH</h2>
        <p>Những lời cảm ơn chân thành và sâu từ những người đã được giúp đỡ, và các nhà hảo tâm, những người đã từng được tham gia dự án cùng tổ chức</p>
      </div>

      <div class="testimonials-grid">
        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
          <div class="testimonial-header">
            <img
              src="img/phuhuynh.webp"
              alt="Chị H'Prong Thian"
            />
            <div>
              <h4>Chị H'Prong Thian</h4>
              <p>Phụ huynh học sinh</p>
            </div>
          </div>
          <p>
            "Nhờ có SUNFLAMECARE, con tôi đã có được ngôi trường mới với đầy
            đủ trang thiết bị. Giờ đây, con có thể học tập trong môi trường
            tốt hơn và có ước mơ trở thành cô giáo."
          </p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
        </div>

        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
          <div class="testimonial-header">
            <img
              src="img/tnv.webp"
              alt="Trần Văn Hùng"
            />
            <div>
              <h4>Trần Văn Hùng</h4>
              <p>Tình nguyện viên</p>
            </div>
          </div>
          <p>
            "Tham gia hoạt động với SUNFLAMECARE đã giúp tôi hiểu thêm ý nghĩa
            của việc cho đi. Mỗi chuyến đi thiện nguyện đều mang lại cảm xúc
            và trải nghiệm tuyệt vời."
          </p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
        </div>

        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
          <div class="testimonial-header">
            <img
              src="img/nht.jpg"
              alt="Nguyễn Đông Tâm"
            />
            <div>
              <h4>Nguyễn Đông Tâm</h4>
              <p>Nhà hảo tâm</p>
            </div>
          </div>
          <p>
            "Tôi tin tưởng vào sự minh bạch và hiệu quả của SUNFLAMECARE. Mỗi
            đồng tiền đóng góp đều được sử dụng đúng mục đích và tạo ra tác
            động thực sự."
          </p>
          <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
          </div>
        </div>
      </div>
    </div>
  </section>

  

  <!-- AOS JS -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <!-- Donation Section -->
  <section class="donation-section">
    <div class="donation-background">
      <div class="container">
        <div class="donation-content" data-aos="fade-up">
          <h2>Hành động nhỏ, ý nghĩa lớn</h2>
          <p>
            Chỉ cần một hành động nhỏ, bạn có thể mang đến hy vọng và nụ cười
            cho những trẻ em vùng khó khăn, những người vô gia cư và những
            hoàn cảnh cần sự sẻ chia.
          </p>
          <div class="donation-form">
            <div class="impact-text" id="impactText">
              Mỗi đóng góp của bạn là một tia sáng, thắp lên tình yêu thương
              và sự sống cho những mảnh đời bất hạnh.
            </div>
            <a href="hoatdong.php" class="btn-donate" style="text-decoration: none;">
              <i class="fas fa-heart"></i>
              QUYÊN GÓP NGAY
            </a>
          </div>
        </div>
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
    <script src="slideshow.js"></script>
    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://vjs.zencdn.net/8.3.0/video.min.js"></script>
    <!-- Main JavaScript -->
    <script src="trangchu.js"></script>

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
  </body>
</html>
