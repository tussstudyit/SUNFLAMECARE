<?php
session_start();
require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Kết nối database
$conn = new mysqli('localhost', 'root', '', 'users_db', '3306');

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Biến để kiểm tra trạng thái gửi form
$success_message = '';
$error_message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['sodienthoai']);
    $message = trim($_POST['message']);

    // Kiểm tra email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Email không hợp lệ!";
    } else {
        // Lưu vào database
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $name, $email, $phone, $message);
        
        if ($stmt->execute()) {
            $stmt->close();
            
            // Gửi email
            $mail = new PHPMailer(true);
            try {
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'tuanloanaa1234@gmail.com';
                $mail->Password = 'ldrv zcaj mfhs nfql';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('tuanloanaa1234@gmail.com', 'SUNFLAMECARE');
                $mail->addAddress('tuanloanaa1234@gmail.com');
                $mail->addReplyTo($email, $name);
                
                $mail->isHTML(false);
                $mail->Subject = "Góp ý từ $name - SUNFLAMECARE";
                $mail->Body = "Tên: $name\nEmail: $email\nSố điện thoại: $phone\nTin nhắn: $message\nGửi vào: " . date('d/m/Y H:i:s');
                $mail->CharSet = 'UTF-8';

                $mail->send();
                $success_message = "Cảm ơn! Góp ý của bạn đã được gửi.";
            } catch (Exception $e) {
                $error_message = "Lưu thành công, nhưng gửi email thất bại. Lỗi: " . $mail->ErrorInfo;
            }
        } else {
            $error_message = "Lỗi lưu database: " . $conn->error;
        }
        
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Liên hệ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@300;400;600&family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="lienhe.css" />
</head>
<body>
    <!-- Header -->
    <nav class="navbar">
        <div class="navbar-logo">
            <a class="logo" href="/">
                <img src="img/snapedit_1746947524060.png" alt="Logo SUNFLAMECARE Vietnam" />
            </a>
            <div class="text-container">
                <span class="text-main">SUNFLAMECARE</span>
                <span class="text-sub">Thắp sáng hy vọng - Trao gửi yêu thương</span>
            </div>
        </div>
        <ul class="navbar-menu">
            <li><a href="trangchu.php"><i class="fa fa-home"></i> TRANG CHỦ</a></li>
            <li><a href="taichinh.php"><i class="fa fa-flag"></i> TÀI CHÍNH</a></li>
            <li><a href="congdong.php"><i class="fa fa-users"></i> CỘNG ĐỒNG</a></li>
            <li><a href="hoatdong.php"><i class="fas fa-newspaper"></i> HOẠT ĐỘNG</a></li>
            <li><a href="lienhe.php"><i class="fa fa-phone"></i> LIÊN HỆ</a></li> 
        </ul>
        <div class="navbar-actions">
            <?php if (isset($_SESSION['name'])): ?>
                <div class="user-info" onclick="toggleDropdown(event)">
                    <img src="<?= $_SESSION['avatar'] ?? 'img/default_avatar.jpg' ?>" alt="avatar">
                    <span><?= $_SESSION['name'] ?></span>
                </div>
                <ul class="dropdown-menu" id="dropdownMenu">
                    <li><a href="Home.php">Trang cá nhân</a></li>
                    <li><a href="hoatdong.php">Chiến dịch của tôi</a></li>
                    <li><a href="logout.php">Đăng xuất</a></li>
                </ul>
            <?php else: ?>
                <a href="Login.php" class="nav-login"><i class="fa fa-user"></i> ĐĂNG NHẬP</a>
            <?php endif; ?>
            <div class="menu-toggle" onclick="toggleMenu()">☰</div>
        </div>
    </nav>

    <main>
        <div class="theme-toggle">
            <div class="toggle-theme-wrapper">
                <label class="theme-label" for="toggle-theme">Chế độ tối</label>
            </div>
            <label class="theme-switch">
                <input type="checkbox" id="toggle-theme" />
                <span class="slider"></span>
            </label>
        </div>

        <div class="super_container">
            <div class="map_container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15343.007782460872!2d108.2426005!3d15.9743252!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3142108997dc971f%3A0x1295cb3d313469c9!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBDw7RuZyBuZ2jhu4cgVGjDtG5nIHRpbiB2w6AgVHJ1eeG7gW4gdGjDtG5nIFZp4buHdCAtIEjDoG4!5e0!3m2!1svi!2s!4v1686813718637!5m2!1svi!2s" width="600" height="400" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="contact_content">
                <div class="contact_info">
                    <h2>Liên hệ</h2>
                    <p>Có nhiều cách để liên hệ với chúng tôi. Bạn có thể gửi cho chúng tôi một dòng, gọi cho chúng tôi, gửi thư qua email hoặc đến tại trụ sở SUNFLAMCARE.</p>
                    <div class="contact-details">
                        <div class="contact-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <div>
                                <h4>VĂN PHÒNG</h4>
                                <p>470 Trần Đại Nghĩa, Ngũ Hành Sơn, Đà Nẵng</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-phone-alt"></i>
                            <div>
                                <h4>ĐIỆN THOẠI</h4>
                                <p>(+84) 0979 727 604</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="fas fa-envelope"></i>
                            <div>
                                <h4>EMAIL</h4>
                                <p>sunflamcare@vku.udn.vn</p>
                            </div>
                        </div>
                    </div>
                    <br />
                    <p><strong>Mở cửa tất cả các ngày trong tuần</strong><br />8AM – 09PM</p>
                    <h3>Theo dõi</h3>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>

                <div class="contact_form">
                    <h2>Liên hệ</h2>
                    <p>Điền thông tin góp ý</p>
                    <?php if ($success_message): ?>
                        <div class="success-message" style="text-align: center; padding: 20px; border: 2px solid #28a745; border-radius: 5px;">
                            <h3><?php echo htmlspecialchars($success_message); ?></h3>
                        </div>
                    <?php elseif ($error_message): ?>
                        <div class="error-message" style="text-align: center; padding: 20px; border: 2px solid #dc3545; border-radius: 5px;">
                            <h3><?php echo htmlspecialchars($error_message); ?></h3>
                        </div>
                    <?php else: ?>
                        <form method="POST" action="">
                            <input type="text" name="name" placeholder="Tên của bạn" required />
                            <input type="email" name="email" placeholder="Email của bạn" required />
                            <input type="tel" name="sodienthoai" placeholder="Số điện thoại" />
                            <textarea name="message" rows="5" placeholder="Nội dung góp ý" required></textarea>
                            <button type="submit">GỬI</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="hoatdong.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toggle = document.getElementById("toggle-theme");
            if (toggle) {
                toggle.addEventListener("change", () => {
                    document.body.classList.toggle("dark-mode");
                    localStorage.setItem(
                        "theme",
                        document.body.classList.contains("dark-mode") ? "dark" : "light"
                    );
                });

                if (localStorage.getItem("theme") === "dark") {
                    document.body.classList.add("dark-mode");
                    toggle.checked = true;
                }
            }
        });

        function toggleMenu() {
            const menu = document.querySelector(".navbar-menu"); // Sửa từ .navbar_menu thành .navbar-menu
            menu.classList.toggle("active");
        }

        function toggleDropdown(event) {
            event.preventDefault(); // Ngăn hành vi mặc định
            const dropdown = document.getElementById("dropdownMenu");
            dropdown.classList.toggle("show");
        }

        // Đóng dropdown khi click ra ngoài
        document.addEventListener("click", function (event) {
            const dropdown = document.getElementById("dropdownMenu");
            const userInfo = document.querySelector(".user-info");
            if (!userInfo || !dropdown.contains(event.target) && !userInfo.contains(event.target)) {
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

        AOS.init(); // Khởi tạo AOS
    </script>
</body>
</html>