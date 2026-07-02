<?php

session_start();

$errors = [
    'login' => $_SESSION['login_error'] ?? '',
    'register' => $_SESSION['register_error'] ?? ''
];
$activeForm = $_SESSION['active_form'] ?? 'login';

session_unset();

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

function isActiveForm($formName, $activeForm) {
    return $formName === $activeForm ? 'active' : '';
}

?>


<!DOCTYPE html>
<html lang="vi">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập/Đăng ký</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      integrity="sha512-...tự động sinh ra..."
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="stylesheet" href="Login.css" />
  </head>
  <body>
   
 <!-- Navbar -->
    <nav class="navbar">
      <ul class="navbar_menu">
        <li>
          <a href="trangchu.php"><i class="fa fa-home"></i>&nbsp;TRANG CHỦ</a>
        </li>
        <li>
          <a href="taichinh.php"><i class="fa fa-flag"></i>&nbsp;TÀI CHÍNH</a>
        </li>
        <li>
          <a href="congdong.php"
            ><i class="fa fa-users"></i>&nbsp;CỘNG ĐỒNG</a
          >
        </li>
        <li>
          <a href="hoatdong.php"
            ><i class="fas fa-newspaper"></i>&nbsp;HOẠT ĐỘNG</a
          >
        </li>
        <li>
          <a href="lienhe.php"><i class="fa fa-phone"></i>&nbsp;LIÊN HỆ</a>
        </li>
      </ul>
    </nav>

    <script>
        // Toggle Menu
        function toggleMenu() {
            const menu = document.querySelector('.navbar_menu');
            console.log('Toggle clicked', menu); // Debug
            menu.classList.toggle('active');
        }
</script>
    
  <div class="container" id="container">
  <!-- Form Đăng Ký -->
  <div class="form-container sign-up">
    <form action="login_register.php" method="post">
      <?php if (!empty($register_error)) : ?>
        <p style="color: red;"><?= $register_error ?></p>
      <?php endif; ?>
      <div class="social-icons">
        <a href="#" class="icon"><i class="fab fa-google-plus-g"></i></a>
        <a href="#" class="icon"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="icon"><i class="fab fa-github"></i></a>
        <a href="#" class="icon"><i class="fab fa-linkedin-in"></i></a>
      </div>
      <span>Hoặc đăng ký bằng email của bạn</span>
      <input type="text" name="name" placeholder="Tên của bạn" required />
      <input type="email" name="email" placeholder="Email của bạn" required />
      <input type="password" name="password" placeholder="Mật khẩu" required />
      <select name="role" required>
        <option value=""> Chọn vai trò </option>
        <option value="user">Người dùng</option>
        <option value="admin">Quản trị viên</option>
      </select>
      <button type="submit" name="register">Đăng Ký</button>
    </form>
  </div>

  <!-- Form Đăng Nhập -->
  <div class="form-container sign-in">
    <form action="login_register.php" method="post">
      <h1>Đăng nhập</h1>
      <?php if (!empty($login_error)) : ?>
        <p style="color: red;"><?= $login_error ?></p>
      <?php endif; ?>
      <div class="social-icons">
        <a href="#" class="icon"><i class="fab fa-google-plus-g"></i></a>
        <a href="#" class="icon"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="icon"><i class="fab fa-github"></i></a>
        <a href="#" class="icon"><i class="fab fa-linkedin-in"></i></a>
      </div>
      <span>Hoặc đăng nhập bằng tài khoản của bạn</span>
      <input type="email" name="email" placeholder="Email của bạn" required />
      <input type="password" name="password" placeholder="Mật khẩu" required />
      <a href="#" class="forgot-password">Quên mật khẩu?</a>
      <button type="submit" name="login">Đăng Nhập</button>
    </form>
  </div>

  <!-- Panel Chuyển Đổi -->
  <div class="toggle-container">
    <div class="toggle">
      <div class="toggle-panel toggle-left">
        <p>
          Chúng tôi rất vui khi bạn đã trở lại để tiếp tục hành trình chia
          sẻ yêu thương và giúp đỡ cộng đồng. Đăng nhập ngay để tham gia các
          hoạt động từ thiện, cùng nhau làm nên những điều kỳ diệu!
        </p>
        <button class="hidden" id="login">Đăng Nhập</button>
      </div>
      <div class="toggle-panel toggle-right">
        <p>
          Hãy gia nhập cộng đồng tình nguyện của chúng tôi, nơi bạn có thể
          kết nối, chia sẻ và đóng góp sức mình cho những hoàn cảnh khó
          khăn. Đăng ký ngay hôm nay để bắt đầu hành trình của bạn!
        </p>
        <button class="hidden" id="register">Đăng Ký</button>
      </div>
    </div>
  </div>
</div>

    <script src="Login.js"></script>
    <script src="utils.js"></script>

  </body>
</html>


