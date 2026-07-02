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

