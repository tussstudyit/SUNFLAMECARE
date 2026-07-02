AOS.init();

function toggleMenu() {
  const menu = document.querySelector(".navbar_menu");
  console.log("Toggle clicked", menu);
  menu.classList.toggle("active");
}

// Hàm cập nhật chiều cao header động với giá trị dự phòng
function updateHeaderHeight() {
  const header = document.querySelector("#site-header");
  const headerHeight =
    header.offsetHeight || (window.innerWidth <= 768 ? 60 : 110); // Giá trị dự phòng: 60px cho mobile, 110px cho desktop
  document.documentElement.style.setProperty(
    "--header-height",
    `${headerHeight}px`
  );
}

window.addEventListener("scroll", function () {
  const navbar = document.querySelector(".navbar");
  const header = document.querySelector("#site-header");
  if (window.scrollY > 50) {
    navbar.classList.add("scrolled");
    header.classList.add("scrolled");
    updateHeaderHeight(); // Cập nhật chiều cao khi header hiện
  } else {
    navbar.classList.remove("scrolled");
    header.classList.remove("scrolled");
  }
});

// Gọi hàm updateHeaderHeight khi trang tải và khi thay đổi kích thước cửa sổ
window.addEventListener("resize", updateHeaderHeight);
window.addEventListener("load", updateHeaderHeight);
