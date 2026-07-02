// Initialize AOS (Animate On Scroll)
AOS.init({
  duration: 800,
  once: true,
  offset: 100,
  easing: "ease-out-cubic",
});

// Mobile menu toggle
function toggleMenu() {
  const menu = document.querySelector(".navbar_menu");
  const menuToggle = document.querySelector(".menu-toggle");

  if (!menu || !menuToggle) return;

  menu.classList.toggle("active");

  // Animate hamburger menu
  const spans = menuToggle.querySelectorAll("span");
  if (menu.classList.contains("active")) {
    spans[0].style.transform = "rotate(45deg) translate(5px, 5px)";
    spans[1].style.opacity = "0";
    spans[2].style.transform = "rotate(-45deg) translate(7px, -6px)";
  } else {
    spans.forEach((span) => {
      span.style.transform = "";
      span.style.opacity = "";
    });
  }
}

// Enhanced scroll to top functionality
const scrollToTopBtn = document.getElementById("scrollToTop");

function updateScrollToTopButton() {
  if (!scrollToTopBtn) return;
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  if (scrollTop > 300) {
    scrollToTopBtn.classList.add("visible");
  } else {
    scrollToTopBtn.classList.remove("visible");
  }
}

if (scrollToTopBtn) {
  scrollToTopBtn.addEventListener("click", function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  scrollToTopBtn.addEventListener("keydown", function (e) {
    if (e.key === "Enter" || e.key === " ") {
      e.preventDefault();
      this.click();
    }
  });
}

// Animate counting numbers
function animateValue(elementId, start, end, duration) {
  const obj = document.getElementById(elementId);
  if (!obj) return;

  let startTimestamp = null;
  const step = (timestamp) => {
    if (!startTimestamp) startTimestamp = timestamp;
    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
    const easeOutQuart = 1 - Math.pow(1 - progress, 4);
    const value = Math.floor(easeOutQuart * (end - start) + start);
    obj.textContent = value.toLocaleString("vi-VN");
    if (progress < 1) {
      window.requestAnimationFrame(step);
    }
  };
  window.requestAnimationFrame(step);
}

// Intersection Observer for counting animation
const observerOptions = {
  threshold: 0.5,
  rootMargin: "0px 0px -100px 0px",
};

const statsObserver = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      animateValue("ProjectCount", 0, 564, 2000);
      animateValue("MemJoin", 0, 3256, 2000);
      animateValue("totalFund", 0, 543500000, 2500);
      statsObserver.unobserve(entry.target);
    }
  });
}, observerOptions);

// Enhanced Donation Slider Class
class EnhancedDonationSlider {
  constructor(sliderId, prevBtnId, nextBtnId, dotsId) {
    this.slider = document.getElementById(sliderId);
    this.prevBtn = document.getElementById(prevBtnId);
    this.nextBtn = document.getElementById(nextBtnId);
    this.dotsContainer = document.getElementById(dotsId);
    this.slides = this.slider?.querySelectorAll(".slide-page");
    this.dots = this.dotsContainer?.querySelectorAll(".slider-dot");
    this.currentSlide = 0;
    this.totalSlides = this.slides?.length || 0;
    this.autoSlideInterval = null;
    this.autoSlideDelay = 8000; // 8 seconds
    this.isTransitioning = false;

    this.init();
  }

  init() {
    if (!this.slider || this.totalSlides === 0) return;

    this.updateSlider();
    this.bindEvents();
    this.startAutoSlide();
    this.addTouchSupport();
  }

  bindEvents() {
    if (this.prevBtn) {
      this.prevBtn.addEventListener("click", () => this.prevSlide());
    }
    if (this.nextBtn) {
      this.nextBtn.addEventListener("click", () => this.nextSlide());
    }
    if (this.dots) {
      this.dots.forEach((dot, index) => {
        dot.addEventListener("click", () => this.goToSlide(index));
      });
    }

    if (this.slider) {
      this.slider.addEventListener("mouseenter", () => this.stopAutoSlide());
      this.slider.addEventListener("mouseleave", () => this.startAutoSlide());
    }

    document.addEventListener("keydown", (e) => {
      if (e.key === "ArrowLeft") this.prevSlide();
      if (e.key === "ArrowRight") this.nextSlide();
    });
  }

  addTouchSupport() {
    let startX = 0;
    let currentX = 0;
    let isDragging = false;

    if (!this.slider) return;

    this.slider.addEventListener("touchstart", (e) => {
      startX = e.touches[0].clientX;
      isDragging = true;
      this.stopAutoSlide();
    });

    this.slider.addEventListener("touchmove", (e) => {
      if (!isDragging) return;
      currentX = e.touches[0].clientX;
    });

    this.slider.addEventListener("touchend", () => {
      if (!isDragging) return;
      const diffX = startX - currentX;
      const threshold = 50;
      if (Math.abs(diffX) > threshold) {
        if (diffX > 0) this.nextSlide();
        else this.prevSlide();
      }
      isDragging = false;
      this.startAutoSlide();
    });
  }

  nextSlide() {
    if (this.isTransitioning) return;
    this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
    this.updateSlider();
  }

  prevSlide() {
    if (this.isTransitioning) return;
    this.currentSlide =
      (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
    this.updateSlider();
  }

  goToSlide(index) {
    if (this.isTransitioning || index === this.currentSlide) return;
    this.currentSlide = index;
    this.updateSlider();
  }

  updateSlider() {
    this.isTransitioning = true;
    const translateX = -this.currentSlide * 100;
    this.slider.style.transform = `translateX(${translateX}%)`;
    this.dots.forEach((dot, index) => {
      dot.classList.toggle("active", index === this.currentSlide);
    });
    this.updateButtonStates();
    setTimeout(() => {
      this.isTransitioning = false;
    }, 500);
  }

  updateButtonStates() {
    if (this.prevBtn) this.prevBtn.disabled = false;
    if (this.nextBtn) this.nextBtn.disabled = false;
  }

  startAutoSlide() {
    this.stopAutoSlide();
    this.autoSlideInterval = setInterval(() => {
      this.nextSlide();
    }, this.autoSlideDelay);
  }

  stopAutoSlide() {
    if (this.autoSlideInterval) {
      clearInterval(this.autoSlideInterval);
      this.autoSlideInterval = null;
    }
  }

  destroy() {
    this.stopAutoSlide();
  }
}

// Progress bar animation
const observeProgressBars = () => {
  const progressBars = document.querySelectorAll(".progress-fill");
  const progressObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const progressBar = entry.target;
          const width = progressBar.style.width;
          progressBar.style.width = "0%";
          progressBar.style.transition =
            "width 1.5s cubic-bezier(0.4, 0, 0.2, 1)";
          setTimeout(() => {
            progressBar.style.width = width;
          }, 100);
          progressObserver.unobserve(progressBar);
        }
      });
    },
    { threshold: 0.3 }
  );
  progressBars.forEach((bar) => {
    progressObserver.observe(bar);
  });
};

// Enhanced smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      const headerOffset = 80;
      const elementPosition = target.offsetTop;
      const offsetPosition = elementPosition - headerOffset;
      window.scrollTo({
        top: offsetPosition,
        behavior: "smooth",
      });
    }
  });
});

// Enhanced navbar scroll effect
let lastScrollTop = 0;
const navbar = document.querySelector(".navbar");
const header = document.querySelector("#site-header");

function handleNavbarScroll() {
  const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
  if (scrollTop > 50) {
    navbar?.classList.add("scrolled");
    header?.classList.add("scrolled");
  } else {
    navbar?.classList.remove("scrolled");
    header?.classList.remove("scrolled");
  }
  if (scrollTop > lastScrollTop && scrollTop > 100) {
    navbar.style.transform = "translateY(-100%)";
  } else {
    navbar.style.transform = "translateY(0)";
  }
  lastScrollTop = scrollTop;
}

// Enhanced donation card hover effects
const observeDonationCards = () => {
  const donationCards = document.querySelectorAll(".donation-card");
  donationCards.forEach((card) => {
    card.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-8px) scale(1.02)";
    });
    card.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0) scale(1)";
    });
  });
};

// Close mobile menu when clicking outside
document.addEventListener("click", function (e) {
  const menu = document.querySelector(".navbar_menu");
  const menuToggle = document.querySelector(".menu-toggle");
  if (
    menu?.classList.contains("active") &&
    !menu.contains(e.target) &&
    !menuToggle?.contains(e.target)
  ) {
    toggleMenu();
  }
});

// Enhanced image loading with intersection observer
const observeImages = () => {
  const images = document.querySelectorAll(".card-image img");
  const imageObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.style.opacity = "0";
          img.style.transform = "scale(1.1)";
          img.onload = function () {
            img.style.transition =
              "opacity 0.5s ease-out, transform 0.5s ease-out";
            img.style.opacity = "1";
            img.style.transform = "scale(1)";
          };
          if (img.complete) {
            img.onload();
          }
          imageObserver.unobserve(img);
        }
      });
    },
    { threshold: 0.1 }
  );
  images.forEach((img) => {
    imageObserver.observe(img);
  });
};

// Enhanced ripple effect for buttons
const createRipple = (event) => {
  const button = event.currentTarget;
  const circle = document.createElement("span");
  const diameter = Math.max(button.clientWidth, button.clientHeight);
  const radius = diameter / 2;
  circle.style.width = circle.style.height = `${diameter}px`;
  circle.style.left = `${event.clientX - button.offsetLeft - radius}px`;
  circle.style.top = `${event.clientY - button.offsetTop - radius}px`;
  circle.classList.add("ripple");
  const ripple = button.getElementsByClassName("ripple")[0];
  if (ripple) {
    ripple.remove();
  }
  button.appendChild(circle);
  setTimeout(() => {
    circle.remove();
  }, 600);
};

// Performance optimization: Debounce scroll events
const debounce = (func, wait) => {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
};

// Preload critical images
const preloadImages = () => {
  const criticalImages = [
    "img/traohocbonghagiang.webp",
    "img/xaynhatinhthuong.jpg",
    "img/chamsocnguoigia.jpg",
  ];
  criticalImages.forEach((src) => {
    const img = new Image();
    img.src = src;
  });
};

// Enhanced keyboard navigation support
document.addEventListener("keydown", function (e) {
  if (e.key === "Escape") {
    const menu = document.querySelector(".navbar_menu");
    if (menu?.classList.contains("active")) {
      toggleMenu();
    }
  }
});

// Add focus styles for accessibility
const addFocusStyles = () => {
  const focusableElements = document.querySelectorAll(
    'a, button, [tabindex]:not([tabindex="-1"])'
  );
  focusableElements.forEach((element) => {
    element.addEventListener("focus", function () {
      this.style.outline = "2px solid var(--primary)";
      this.style.outlineOffset = "2px";
    });
    element.addEventListener("blur", function () {
      this.style.outline = "";
      this.style.outlineOffset = "";
    });
  });
};

// Contact form enhancement
const enhanceContactForm = () => {
  const form = document.querySelector(".newsletter-form");
  const submitBtn = form?.querySelector("button[type='submit']");
  if (!form || !submitBtn) return;

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    submitBtn.innerHTML =
      '<i class="fas fa-spinner fa-spin"></i> <span>Đang gửi...</span>';
    submitBtn.disabled = true;
    setTimeout(() => {
      submitBtn.innerHTML =
        '<i class="fas fa-check"></i> <span>Đã gửi thành công!</span>';
      setTimeout(() => {
        submitBtn.innerHTML = '<i class="far fa-paper-plane"></i>';
        submitBtn.disabled = false;
        form.reset();
      }, 2000);
    }, 1500);
  });
};

// Donation button click handler
const handleDonationButtons = () => {
  const donationBtns = document.querySelectorAll(
    ".donation-btn, .volunteer-btn"
  );
  donationBtns.forEach((btn) => {
    btn.addEventListener("click", createRipple);
    btn.addEventListener("click", function () {
      this.style.transform = "scale(0.95)";
      setTimeout(() => {
        this.style.transform = "";
      }, 150);
    });
  });
};

// Initialize everything when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
  new EnhancedDonationSlider(
    "ongoingSlider",
    "prevOngoingSlide",
    "nextOngoingSlide",
    "ongoingDots"
  );
  new EnhancedDonationSlider(
    "completedSlider",
    "prevCompletedSlide",
    "nextCompletedSlide",
    "completedDots"
  );
  observeProgressBars();
  observeDonationCards();
  observeImages();
  addFocusStyles();
  enhanceContactForm();
  handleDonationButtons();

  const statsSection = document.querySelector(".stats-section");
  if (statsSection) {
    statsObserver.observe(statsSection);
  }

  updateScrollToTopButton();
});

// Add scroll event listener
window.addEventListener(
  "scroll",
  debounce(() => {
    updateScrollToTopButton();
    handleNavbarScroll();
  }, 16)
);

// Preload images when page loads
window.addEventListener("load", preloadImages);

// Add ripple CSS
const rippleCSS = `
.donation-btn, .volunteer-btn, .submit-btn {
  position: relative;
  overflow: hidden;
}
.ripple {
  position: absolute;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.6);
  transform: scale(0);
  animation: ripple-animation 0.6s linear;
  pointer-events: none;
}
@keyframes ripple-animation {
  to {
    transform: scale(4);
    opacity: 0;
  }
}
`;
const style = document.createElement("style");
style.textContent = rippleCSS;
document.head.appendChild(style);

// Performance monitoring
const performanceMonitor = {
  measurePageLoad: () => {
    window.addEventListener("load", () => {
      const perfData = performance.getEntriesByType("navigation")[0];
      console.log(
        `Page load time: ${perfData.loadEventEnd - perfData.loadEventStart}ms`
      );
    });
  },
  measureScrollPerformance: () => {
    let scrollCount = 0;
    window.addEventListener("scroll", () => {
      scrollCount++;
      if (scrollCount % 100 === 0) {
        console.log(`Scroll events processed: ${scrollCount}`);
      }
    });
  },
};

if (
  window.location.hostname === "localhost" ||
  window.location.hostname === "127.0.0.1"
) {
  performanceMonitor.measurePageLoad();
  performanceMonitor.measureScrollPerformance();
}

console.log("SUNFLAMECARE website loaded successfully! 🔥❤️");
console.log("Enhanced features initialized:");
console.log("✅ Improved scroll-to-top with flame animation");
console.log("✅ Fixed slideshow with 6 items per slide");
console.log("✅ Enhanced UI/UX design");
console.log("✅ Better mobile responsiveness");
console.log("✅ Improved accessibility features");
