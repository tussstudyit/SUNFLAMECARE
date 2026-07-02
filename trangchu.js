// Main JavaScript for SUNFLAMECARE Website

document.addEventListener("DOMContentLoaded", function () {
  // Initialize AOS
  AOS.init({
    duration: 1000,
    once: true,
    offset: 100,
  });

  // Initialize all features
  initSlider();
  initNavigation();
  initScrollAnimations();
  initCounters();
  initDonationForm();
  initProgressBars();
  initNewsletterForm();
  initSponsorsSlider();
  initAchievementsSlider();
});

// Slider functionality
function initSlider() {
  const sliderInterval = setInterval(() => {
    const lists = document.querySelectorAll(".main-slide-item");
    const mainSlide = document.getElementById("main-slide");
    if (lists.length > 0 && mainSlide) {
      mainSlide.appendChild(lists[0]);
    }
  }, 4000);

  // Store interval reference for cleanup if needed
  window.sliderInterval = sliderInterval;
}

// Navigation functionality
function initNavigation() {
  // Header scroll effect
  const updateHeaderHeight = () => {
    const header = document.querySelector("#site-header");
    if (!header) return;

    const headerHeight =
      header.offsetHeight || (window.innerWidth <= 768 ? 70 : 110);
    document.documentElement.style.setProperty(
      "--header-height",
      `${headerHeight}px`
    );
  };

  const handleScroll = () => {
    const navbar = document.querySelector(".navbar");
    const header = document.querySelector("#site-header");

    if (navbar && header) {
      if (window.scrollY > 100) {
        navbar.classList.add("scrolled");
        header.classList.add("scrolled");
        updateHeaderHeight();
      } else {
        navbar.classList.remove("scrolled");
        header.classList.remove("scrolled");
      }
    }
  };

  window.addEventListener("scroll", handleScroll);
  window.addEventListener("resize", updateHeaderHeight);
  updateHeaderHeight();

  // Smooth scrolling for navigation links
  const navLinks = document.querySelectorAll('.navbar_menu a[href^="#"]');
  navLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("href");
      const targetElement = document.querySelector(targetId);

      if (targetElement) {
        const offsetTop = targetElement.offsetTop - 120;
        window.scrollTo({
          top: offsetTop,
          behavior: "smooth",
        });
      }

      // Close mobile menu if open
      const menu = document.querySelector(".navbar_menu");
      if (menu) {
        menu.classList.remove("active");
      }
    });
  });
}

// Mobile menu toggle
function toggleMenu() {
  const menu = document.querySelector(".navbar_menu");
  if (menu) {
    menu.classList.toggle("active");
  }
}

// Scroll to section function
function scrollToSection(sectionId) {
  const element = document.getElementById(sectionId);
  if (element) {
    const offsetTop = element.offsetTop - 120;
    window.scrollTo({
      top: offsetTop,
      behavior: "smooth",
    });
  }
}

// Scroll animations
function initScrollAnimations() {
  const observerOptions = {
    threshold: 0.1,
    rootMargin: "0px 0px -50px 0px",
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        const element = entry.target;

        // Add appropriate animation class
        if (element.classList.contains("fade-in")) {
          element.classList.add("visible");
        } else if (element.classList.contains("slide-in-left")) {
          element.classList.add("visible");
        } else if (element.classList.contains("slide-in-right")) {
          element.classList.add("visible");
        } else if (element.classList.contains("scale-in")) {
          element.classList.add("visible");
        }

        // Trigger counters
        if (element.id === "mission") {
          startCounters();
        }

        // Trigger progress bars
        if (element.classList.contains("impact-section")) {
          animateProgressBars();
        }
      }
    });
  }, observerOptions);

  // Observe elements for animation
  const animatedElements = document.querySelectorAll(
    ".fade-in, .slide-in-left, .slide-in-right, .scale-in, #mission, .impact-section"
  );
  animatedElements.forEach((el) => observer.observe(el));
}

// Counter animations
function initCounters() {
  window.countersStarted = false;
}

function startCounters() {
  if (window.countersStarted) return;
  window.countersStarted = true;

  animateCounter("projectCount", 0, 564, 2000);
  animateCounter("memberCount", 0, 3256, 2000);
  animateCounter("fundAmount", 0, 34567456, 2000, true);
}

function animateCounter(id, start, end, duration, isCurrency = false) {
  const element = document.getElementById(id);
  if (!element) return;

  let startTimestamp = null;

  const step = (timestamp) => {
    if (!startTimestamp) startTimestamp = timestamp;
    const progress = Math.min((timestamp - startTimestamp) / duration, 1);

    const value = Math.floor(progress * (end - start) + start);

    if (isCurrency) {
      element.textContent = value.toLocaleString("vi-VN") + " VNĐ";
    } else {
      element.textContent = value.toLocaleString("vi-VN");
    }

    if (progress < 1) {
      requestAnimationFrame(step);
    }
  };

  requestAnimationFrame(step);
}

// Progress bars animation
function initProgressBars() {
  window.progressAnimated = false;
}

function animateProgressBars() {
  if (window.progressAnimated) return;
  window.progressAnimated = true;

  const progressBars = document.querySelectorAll(".progress-fill");
  progressBars.forEach((bar, index) => {
    const progress = parseInt(bar.getAttribute("data-progress"));
    setTimeout(() => {
      bar.style.width = progress + "%";
    }, index * 200);
  });
}

// Donation form functionality
function initDonationForm() {
  const amountButtons = document.querySelectorAll(".amount-btn");
  const customAmountInput = document.getElementById("customAmount");
  const impactText = document.getElementById("impactText");

  const impactMessages = {
    50000: "Cung cấp 5 bữa ăn đầy đủ cho trẻ em vùng khó khăn",
    100000: "Mua sách vở cho 3 em học sinh nghèo cả năm học",
    200000: "Hỗ trợ khám bệnh miễn phí cho 2 người cao tuổi",
    500000: "Xây dựng 1 nhà vệ sinh sạch cho trường học vùng cao",
  };

  function updateImpactText(amount) {
    if (!impactText) return;

    if (amount >= 500000) {
      impactText.textContent = impactMessages[500000];
    } else if (amount >= 200000) {
      impactText.textContent = impactMessages[200000];
    } else if (amount >= 100000) {
      impactText.textContent = impactMessages[100000];
    } else if (amount >= 50000) {
      impactText.textContent = impactMessages[50000];
    } else if (amount > 0) {
      impactText.textContent =
        "Mọi đóng góp đều có ý nghĩa và tạo ra tác động tích cực";
    } else {
      impactText.textContent = "Chọn mức đóng góp để xem tác động cụ thể";
    }
  }

  // Handle amount button clicks
  amountButtons.forEach((button) => {
    button.addEventListener("click", function () {
      // Remove active class from all buttons
      amountButtons.forEach((btn) => btn.classList.remove("active"));

      // Add active class to clicked button
      this.classList.add("active");

      // Clear custom amount input
      if (customAmountInput) {
        customAmountInput.value = "";
      }

      // Update impact text
      const amount = parseInt(this.getAttribute("data-amount"));
      updateImpactText(amount);
    });
  });

  // Handle custom amount input
  if (customAmountInput) {
    customAmountInput.addEventListener("input", function () {
      // Remove active class from all buttons
      amountButtons.forEach((btn) => btn.classList.remove("active"));

      // Update impact text
      const amount = parseInt(this.value) || 0;
      updateImpactText(amount);
    });
  }

  // Handle donate button click
  const donateButton = document.querySelector(".btn-donate");
  if (donateButton) {
    donateButton.addEventListener("click", function () {
      const activeButton = document.querySelector(".amount-btn.active");
      const customAmount = customAmountInput ? customAmountInput.value : "";

      let selectedAmount = 0;
      if (activeButton) {
        selectedAmount = parseInt(activeButton.getAttribute("data-amount"));
      } else if (customAmount) {
        selectedAmount = parseInt(customAmount);
      }

      if (selectedAmount > 0) {
        alert(
          `Cảm ơn bạn đã quyên góp ${selectedAmount.toLocaleString(
            "vi-VN"
          )} VNĐ! Chúng tôi sẽ liên hệ với bạn để hoàn tất thủ tục.`
        );
      } else {
        alert("Vui lòng chọn hoặc nhập số tiền quyên góp.");
      }
    });
  }
}

// Newsletter form
function initNewsletterForm() {
  const form = document.querySelector(".newsletter-form");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();

      const email = this.querySelector('input[type="email"]').value;
      const name = this.querySelector('input[type="text"]').value;

      if (email && name) {
        alert(
          `Cảm ơn ${name}! Chúng tôi đã ghi nhận đăng ký nhận tin của bạn tại email: ${email}`
        );
        this.reset();
      }
    });
  }
}

// Video play button functionality
document.addEventListener("click", function (e) {
  if (e.target.closest(".play-button")) {
    alert("Chức năng xem video sẽ được phát triển trong tương lai!");
  }
});

// Smooth scrolling for all internal links
document.addEventListener("click", function (e) {
  const link = e.target.closest('a[href^="#"]');
  if (link) {
    e.preventDefault();
    const targetId = link.getAttribute("href");
    const targetElement = document.querySelector(targetId);

    if (targetElement) {
      const offsetTop = targetElement.offsetTop - 120;
      window.scrollTo({
        top: offsetTop,
        behavior: "smooth",
      });
    }
  }
});

// Add scroll-triggered animations for better UX
function addScrollAnimations() {
  const elements = document.querySelectorAll(
    ".impact-card, .testimonial-card, .news-item, .stat-item"
  );

  elements.forEach((element, index) => {
    element.classList.add("fade-in");
    element.style.animationDelay = `${index * 0.1}s`;
  });
}

// Initialize additional animations after DOM is loaded
window.addEventListener("load", function () {
  addScrollAnimations();

  // Add loading animation completion
  document.body.classList.add("loaded");
});

// Handle form submissions with better UX
function handleFormSubmission(form, successMessage) {
  const button = form.querySelector('button[type="submit"]');
  const originalText = button.textContent;

  button.textContent = "Đang xử lý...";
  button.disabled = true;

  setTimeout(() => {
    button.textContent = originalText;
    button.disabled = false;
    alert(successMessage);
    form.reset();
  }, 1500);
}

// Add entrance animations for key sections
function addEntranceAnimations() {
  const sections = document.querySelectorAll("section");

  sections.forEach((section) => {
    section.style.opacity = "0";
    section.style.transform = "translateY(30px)";
    section.style.transition = "all 0.6s ease";
  });
}

// Intersection Observer for section animations
function initSectionAnimations() {
  const sections = document.querySelectorAll("section");

  const sectionObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.style.opacity = "1";
          entry.target.style.transform = "translateY(0)";
        }
      });
    },
    {
      threshold: 0.1,
      rootMargin: "0px 0px -100px 0px",
    }
  );

  sections.forEach((section) => {
    sectionObserver.observe(section);
  });
}

// Initialize section animations when page loads
window.addEventListener("load", function () {
  setTimeout(() => {
    addEntranceAnimations();
    initSectionAnimations();
  }, 100);
});

// Sponsors Slider
function initSponsorsSlider() {
  const track = document.getElementById("sponsorsTrack");
  const prevBtn = document.getElementById("prevSponsor");
  const nextBtn = document.getElementById("nextSponsor");

  if (!track || !prevBtn || !nextBtn) return;

  let currentIndex = 0;
  const itemWidth = 230; // 200px width + 30px gap
  const visibleItems = 4;
  const totalItems = track.children.length;
  const maxIndex = Math.max(0, totalItems - visibleItems);

  function updateSlider() {
    const offset = -currentIndex * itemWidth;
    track.style.transform = `translateX(${offset}px)`;

    // Update button states
    prevBtn.disabled = currentIndex === 0;
    nextBtn.disabled = currentIndex >= maxIndex;
  }

  prevBtn.addEventListener("click", () => {
    if (currentIndex > 0) {
      currentIndex--;
      updateSlider();
    }
  });

  nextBtn.addEventListener("click", () => {
    if (currentIndex < maxIndex) {
      currentIndex++;
      updateSlider();
    }
  });

  // Auto-slide
  setInterval(() => {
    if (currentIndex >= maxIndex) {
      currentIndex = 0;
    } else {
      currentIndex++;
    }
    updateSlider();
  }, 3000);

  // Initial update
  updateSlider();
}

// Achievements Slider
function initAchievementsSlider() {
  const track = document.getElementById("achievementsTrack");
  const prevBtn = document.getElementById("prevAchievement");
  const nextBtn = document.getElementById("nextAchievement");

  if (!track || !prevBtn || !nextBtn) return;

  let currentIndex = 0;
  const itemWidth = 330; // 300px width + 30px gap
  const visibleItems = 3;
  const totalItems = track.children.length;
  const maxIndex = Math.max(0, totalItems - visibleItems);

  function updateSlider() {
    const offset = -currentIndex * itemWidth;
    track.style.transform = `translateX(${offset}px)`;

    // Update button states
    prevBtn.disabled = currentIndex === 0;
    nextBtn.disabled = currentIndex >= maxIndex;
  }

  prevBtn.addEventListener("click", () => {
    if (currentIndex > 0) {
      currentIndex--;
      updateSlider();
    }
  });

  nextBtn.addEventListener("click", () => {
    if (currentIndex < maxIndex) {
      currentIndex++;
      updateSlider();
    }
  });

  // Auto-slide
  setInterval(() => {
    if (currentIndex >= maxIndex) {
      currentIndex = 0;
    } else {
      currentIndex++;
    }
    updateSlider();
  }, 4000);

  // Initial update
  updateSlider();
}
