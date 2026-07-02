// Khởi tạo AOS animation
AOS.init();

// Trình chiếu carousel
const images = document.querySelectorAll(".carousel-img");
let current = 0;

function updateCarousel() {
  images.forEach((img, i) => {
    img.classList.remove("active", "prev", "next");

    if (i === current) {
      img.classList.add("active");
    } else if (i === (current - 1 + images.length) % images.length) {
      img.classList.add("prev");
    } else if (i === (current + 1) % images.length) {
      img.classList.add("next");
    }
  });
}

function nextSlide() {
  current = (current + 1) % images.length;
  updateCarousel();
}

// Tự động chuyển ảnh mỗi 3 giây
setInterval(nextSlide, 3000);

// Thiết lập ban đầu
updateCarousel();

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

// Donation Carousel Functionality
document.addEventListener("DOMContentLoaded", () => {
  const carousel = document.querySelector(".donation-carousel");
  const cards = document.querySelectorAll(".donation-card");
  const prevButton = document.querySelector(".carousel-arrow-prev");
  const nextButton = document.querySelector(".carousel-arrow-next");

  if (carousel && cards.length > 0 && prevButton && nextButton) {
    let currentIndex = 0;
    const totalCards = cards.length;
    let cardsPerView = 3; // Default for desktop

    // Function to update cards per view based on screen size
    const updateCardsPerView = () => {
      if (window.innerWidth <= 768) {
        cardsPerView = 1;
      } else if (window.innerWidth <= 1024) {
        cardsPerView = 2;
      } else {
        cardsPerView = 3;
      }
    };

    // Function to update carousel position
    const updateCarouselPosition = () => {
      const cardWidth = cards[0].offsetWidth + 30; // Including gap
      const offset = -currentIndex * cardWidth;
      carousel.style.transform = `translateX(${offset}px)`;
    };

    // Next button handler
    nextButton.addEventListener("click", () => {
      updateCardsPerView();
      if (currentIndex < totalCards - cardsPerView) {
        currentIndex++;
      } else {
        currentIndex = 0; // Loop back to start
      }
      updateCarouselPosition();
    });

    // Previous button handler
    prevButton.addEventListener("click", () => {
      updateCardsPerView();
      if (currentIndex > 0) {
        currentIndex--;
      } else {
        currentIndex = totalCards - cardsPerView; // Loop to end
      }
      updateCarouselPosition();
    });

    // Update on window resize
    window.addEventListener("resize", () => {
      updateCardsPerView();
      updateCarouselPosition();
    });

    // Initial setup
    updateCardsPerView();
    updateCarouselPosition();
  }
});

// Hàm cập nhật chiều cao header động với giá trị dự phòng
function updateHeaderHeight() {
  const header = document.querySelector("#site-header");
  if (header) {
    const headerHeight =
      header.offsetHeight || (window.innerWidth <= 768 ? 60 : 110); // Giá trị dự phòng: 60px cho mobile, 110px cho desktop
    document.documentElement.style.setProperty(
      "--header-height",
      `${headerHeight}px`
    );
  }
}

window.addEventListener("scroll", function () {
  const navbar = document.querySelector(".navbar");
  const header = document.querySelector("#site-header");
  if (navbar && header) {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
      header.classList.add("scrolled");
      updateHeaderHeight(); // Cập nhật chiều cao khi header hiện
    } else {
      navbar.classList.remove("scrolled");
      header.classList.remove("scrolled");
    }
  }
});

// Gọi hàm updateHeaderHeight khi trang tải và khi thay đổi kích thước cửa sổ
window.addEventListener("resize", updateHeaderHeight);
window.addEventListener("load", updateHeaderHeight);

document.addEventListener("DOMContentLoaded", function () {
  // Lấy tất cả các thẻ donation-card
  const donationCards = document.querySelectorAll(".donation-card");

  donationCards.forEach((card) => {
    // Lấy số tiền đã quyên góp, mục tiêu và trạng thái
    const donatedElement = card.querySelector(
      ".donation-stats .stat:first-child .value"
    );
    const goalElement = card.querySelector(
      ".donation-stats .stat:last-child .value"
    );
    const statusElement = card.querySelector(".donation-status");

    if (donatedElement && goalElement && statusElement) {
      // Lấy giá trị số từ chuỗi (loại bỏ "VND" và dấu chấm)
      const donatedText = donatedElement.textContent.replace(/[^\d]/g, "");
      const goalText = goalElement.textContent.replace(/[^\d]/g, "");

      const donated = parseInt(donatedText, 10);
      const goal = parseInt(goalText, 10);

      // Tính tỷ lệ phần trăm
      let percentage = (donated / goal) * 100;

      // Giới hạn tối đa 100% nếu vượt mục tiêu
      if (percentage > 100) {
        percentage = 100;
      }

      // Lấy thẻ progress
      const progressBar = card.querySelector(".progress");

      if (progressBar) {
        // Cập nhật chiều rộng thanh tiến độ
        progressBar.style.width = percentage + "%";

        // Nếu đạt hoặc vượt mục tiêu, thêm lớp full và cập nhật trạng thái
        if (donated >= goal) {
          progressBar.classList.add("full");
          statusElement.textContent = "Đã hoàn thành";
          statusElement.classList.remove("ongoing");
          statusElement.classList.add("completed");
        } else {
          statusElement.textContent = "Đang diễn ra";
          statusElement.classList.add("ongoing");
          statusElement.classList.remove("completed");
        }
      }
    }
  });
});
