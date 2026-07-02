// DOM Elements
const navbar = document.querySelector(".navbar");
const volunteerForm = document.getElementById("volunteerForm");
const notificationContainer = document.getElementById("notificationContainer");

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

// Toggle mobile menu
function toggleMenu() {
  const navbarMenu = document.querySelector(".navbar-menu");
  navbarMenu.classList.toggle("active");
}

// Form validation and submission
function handleVolunteerForm() {
  if (!volunteerForm) return;

  volunteerForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const data = Object.fromEntries(formData);

    // Basic validation
    if (!validateVolunteerForm(data)) {
      return;
    }

    // Show loading state
    const submitButton = e.target.querySelector(".btn-submit");
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML =
      '<i class="fas fa-spinner fa-spin"></i> Đang gửi...';
    submitButton.disabled = true;

    try {
      const response = await fetch(e.target.action, {
        method: "POST",
        body: formData,
      });
      const result = await response.json();

      if (result.success) {
        showAlert(
          "success",
          result.message ||
            "Đăng ký thành công! Chúng tôi sẽ liên hệ với bạn trong 24 giờ tới."
        );
        e.target.reset();
        e.target.scrollIntoView({ behavior: "smooth", block: "start" });
      } else {
        showAlert(
          "danger",
          result.message || "Có lỗi xảy ra. Vui lòng thử lại."
        );
      }
    } catch (error) {
      console.error("Form submission error:", error);
      showAlert("danger", "Có lỗi xảy ra. Vui lòng thử lại.");
    } finally {
      submitButton.innerHTML = originalText;
      submitButton.disabled = false;
    }
  });
}

// Form validation
function validateVolunteerForm(data) {
  const errors = [];

  if (!data.full_name?.trim()) {
    errors.push("Vui lòng nhập họ và tên");
  }

  if (!data.phone?.trim()) {
    errors.push("Vui lòng nhập số điện thoại");
  } else if (!isValidPhone(data.phone)) {
    errors.push("Số điện thoại không hợp lệ");
  }

  if (!data.email?.trim()) {
    errors.push("Vui lòng nhập email");
  } else if (!isValidEmail(data.email)) {
    errors.push("Email không hợp lệ");
  }

  if (!data.address?.trim()) {
    errors.push("Vui lòng nhập địa chỉ");
  }

  if (!data.activity_type) {
    errors.push("Vui lòng chọn loại hoạt động");
  }

  if (errors.length > 0) {
    showAlert("danger", errors.join("<br>"));
    return false;
  }

  return true;
}

// Validation helpers
function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isValidPhone(phone) {
  const phoneRegex = /^[\d\s\-\+\(\)]+$/;
  return phoneRegex.test(phone) && phone.replace(/\D/g, "").length >= 10;
}

// Alert system
function showAlert(type, message, duration = 5000) {
  const existingAlerts = notificationContainer.querySelectorAll(".alert");
  existingAlerts.forEach((alert) => alert.remove());

  const alertHtml = `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            <i class="fas fa-${
              type === "success" ? "check-circle" : "exclamation-triangle"
            }"></i> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;

  notificationContainer.insertAdjacentHTML("afterbegin", alertHtml);

  if (duration > 0) {
    setTimeout(() => {
      const alert = notificationContainer.querySelector(".alert");
      if (alert) {
        const bsAlert = new bootstrap.Alert(alert);
        bsAlert.close();
      }
    }, duration);
  }

  const alert = notificationContainer.querySelector(".alert");
  if (alert) {
    alert.scrollIntoView({ behavior: "smooth", block: "center" });
  }
}

// Initialize AOS
function initAOS() {
  if (typeof AOS !== "undefined") {
    AOS.init({
      duration: 800,
      easing: "ease-in-out",
      once: true,
      mirror: false,
      offset: 50,
    });
  }
}

// Newsletter form functionality
function initNewsletterForm() {
  const newsletterForm = document.querySelector(".newsletter-form");
  if (!newsletterForm) return;

  newsletterForm.addEventListener("submit", function (e) {
    e.preventDefault();

    const emailInput = this.querySelector('input[type="email"]');
    const email = emailInput.value.trim();

    if (!email) {
      showAlert("warning", "Vui lòng nhập email");
      return;
    }

    if (!isValidEmail(email)) {
      showAlert("danger", "Email không hợp lệ");
      return;
    }

    const submitButton = this.querySelector("button");
    const originalText = submitButton.innerHTML;
    submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
    submitButton.disabled = true;

    setTimeout(() => {
      showAlert("success", "Đăng ký nhận tin thành công!");
      emailInput.value = "";
      submitButton.innerHTML = originalText;
      submitButton.disabled = false;
    }, 1000);
  });
}

// Initialize all functionality
document.addEventListener("DOMContentLoaded", function () {
  initSmoothScrolling();
  handleVolunteerForm();
  initNewsletterForm();
  initAOS();

  window.addEventListener("scroll", handleNavbarScroll);
  handleNavbarScroll();

  window.addEventListener("resize", function () {
    if (typeof AOS !== "undefined") {
      AOS.refresh();
    }
  });

  document.body.classList.add("loaded");
});
