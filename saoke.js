// Initialize when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
  // Initialize AOS animations
  AOS.init({
    duration: 800,
    easing: "ease-in-out",
    once: true,
    offset: 100,
  });

  // Setup all functionality
  setPublishDate();
  setupRatingSystem();
  setupCommentForm();
  setupLoadMoreComments();
  setupMobileMenu();
  setupScrollEffects();
  setupDonationSystem();
  setupScrollToTop();
  setupImageLazyLoading();
  setupShareLinks();
  setupDonationCardNavigation();
});

// Set publish date for article
function setPublishDate() {
  const publishDateElement = document.getElementById("publish-date");
  if (publishDateElement) {
    const publishDate = new Date();
    publishDate.setDate(publishDate.getDate() - 3);

    const options = {
      year: "numeric",
      month: "long",
      day: "numeric",
      hour: "2-digit",
      minute: "2-digit",
    };

    publishDateElement.textContent = publishDate.toLocaleDateString(
      "vi-VN",
      options
    );
  }
}

// Setup star rating system
function setupRatingSystem() {
  const stars = document.querySelectorAll(".star-rating i");
  const ratingCount = document.querySelector(".rating-count");

  if (!stars.length || !ratingCount) return;

  let currentRating = 0;
  let totalRatings = 0;

  // Load rating from localStorage
  const savedRating = localStorage.getItem("articleRating");
  const savedCount = localStorage.getItem("ratingCount");

  if (savedRating) {
    currentRating = parseInt(savedRating);
    totalRatings = savedCount ? parseInt(savedCount) : 1;
    updateStars(currentRating);
    updateRatingCount(totalRatings);
  }

  // Handle star interactions
  stars.forEach((star) => {
    star.addEventListener("mouseenter", function () {
      const rating = parseInt(this.getAttribute("data-rating"));
      highlightStars(rating);
    });

    star.addEventListener("mouseleave", function () {
      highlightStars(currentRating);
    });

    star.addEventListener("click", function () {
      const rating = parseInt(this.getAttribute("data-rating"));

      if (rating === currentRating) {
        currentRating = 0;
        totalRatings = Math.max(0, totalRatings - 1);
      } else {
        if (currentRating === 0) totalRatings++;
        currentRating = rating;
      }

      highlightStars(currentRating);
      updateRatingCount(totalRatings);

      // Save to localStorage
      if (currentRating > 0) {
        localStorage.setItem("articleRating", currentRating);
        localStorage.setItem("ratingCount", totalRatings);
      } else {
        localStorage.removeItem("articleRating");
        localStorage.removeItem("ratingCount");
      }

      // Add pulse animation
      this.classList.add("pulse");
      setTimeout(() => {
        this.classList.remove("pulse");
      }, 300);

      // Show thank you message
      showNotification("Cảm ơn bạn đã đánh giá!", "success");
    });
  });
}

// Highlight stars based on rating
function highlightStars(rating) {
  const stars = document.querySelectorAll(".star-rating i");
  stars.forEach((star) => {
    const starRating = parseInt(star.getAttribute("data-rating"));
    if (starRating <= rating) {
      star.classList.add("fas");
      star.classList.remove("far");
    } else {
      star.classList.add("far");
      star.classList.remove("fas");
    }
  });
}

// Update star display
function updateStars(rating) {
  highlightStars(rating);
}

// Update rating count display
function updateRatingCount(count) {
  const ratingCount = document.querySelector(".rating-count");
  if (ratingCount) {
    ratingCount.textContent = `(${count} đánh giá)`;
  }
}

// Setup comment form
function setupCommentForm() {
  const commentForm = document.getElementById("comment-form");

  if (commentForm) {
    commentForm.addEventListener("submit", function (event) {
      event.preventDefault();

      const name = document.getElementById("comment-name").value.trim();
      const email = document.getElementById("comment-email").value.trim();
      const commentText = document.getElementById("comment-text").value.trim();

      if (!name || !email || !commentText) {
        showNotification("Vui lòng điền đầy đủ thông tin!", "error");
        return;
      }

      if (!isValidEmail(email)) {
        showNotification("Email không hợp lệ!", "error");
        return;
      }

      // Add new comment
      const commentList = document.getElementById("comment-list");
      const newComment = document.createElement("div");
      newComment.className = "comment-item fade-in";
      newComment.innerHTML = `
        <img src="https://i.pravatar.cc/50?img=${Math.floor(
          Math.random() * 70
        )}" alt="Avatar" class="comment-avatar">
        <div class="comment-content">
          <div class="comment-header">
            <span class="comment-author">${escapeHtml(name)}</span>
            <span class="comment-date">Vừa xong</span>
          </div>
          <div class="comment-text">
            ${escapeHtml(commentText)}
          </div>
        </div>
      `;

      commentList.prepend(newComment);

      // Update comment count
      const commentCount = document.getElementById("comment-count");
      if (commentCount) {
        const currentCount = parseInt(commentCount.textContent);
        commentCount.textContent = currentCount + 1;
      }

      // Success notification
      showNotification("Cảm ơn bạn đã bình luận!", "success");

      // Reset form
      commentForm.reset();
    });
  }
}

// Setup load more comments
function setupLoadMoreComments() {
  const loadMoreBtn = document.querySelector("#load-more-comments");

  if (loadMoreBtn) {
    loadMoreBtn.addEventListener("click", function () {
      this.textContent = "Đang tải...";
      this.disabled = true;
      this.classList.add("loading");

      setTimeout(() => {
        const commentList = document.getElementById("comment-list");
        const commentData = [
          {
            name: "Trần Thanh Bình",
            date: "1 tuần trước",
            text: "Tôi rất xúc động khi đọc bài viết này. Những hoạt động thiện nguyện như vậy thực sự có ý nghĩa và mang lại giá trị lớn cho cộng đồng. Cảm ơn SUNFLAMECARE vì những việc làm ý nghĩa!",
            avatar: "https://i.pravatar.cc/50?img=31",
          },
          {
            name: "Lê Minh Tâm",
            date: "2 tuần trước",
            text: "Rất ấn tượng với cách báo cáo tài chính minh bạch của tổ chức. Điều này tạo niềm tin cho người đóng góp. Tôi sẽ tiếp tục ủng hộ các hoạt động sắp tới.",
            avatar: "https://i.pravatar.cc/50?img=45",
          },
        ];

        commentData.forEach((comment, index) => {
          setTimeout(() => {
            const newComment = document.createElement("div");
            newComment.className = "comment-item slide-up";
            newComment.innerHTML = `
              <img src="${comment.avatar}" alt="Avatar" class="comment-avatar">
              <div class="comment-content">
                <div class="comment-header">
                  <span class="comment-author">${comment.name}</span>
                  <span class="comment-date">${comment.date}</span>
                </div>
                <div class="comment-text">
                  ${comment.text}
                </div>
              </div>
            `;
            commentList.appendChild(newComment);
          }, index * 200);
        });

        this.classList.remove("loading");
        this.textContent = "Đã tải tất cả bình luận";
        this.style.opacity = "0.7";
        this.style.cursor = "not-allowed";
      }, 1500);
    });
  }
}

// Setup mobile menu
function setupMobileMenu() {
  const menuToggle = document.querySelector(".menu-toggle");
  const menu = document.querySelector(".navbar_menu");

  if (menuToggle && menu) {
    menuToggle.addEventListener("click", function (e) {
      e.stopPropagation();
      toggleMenu();
    });

    // Close menu when clicking outside
    document.addEventListener("click", function (event) {
      if (!menu.contains(event.target) && !menuToggle.contains(event.target)) {
        closeMenu();
      }
    });

    // Close menu when clicking menu items
    const menuItems = document.querySelectorAll(".navbar_menu li a");
    menuItems.forEach((item) => {
      item.addEventListener("click", function () {
        closeMenu();
      });
    });
  }
}

// Toggle mobile menu
function toggleMenu() {
  const menu = document.querySelector(".navbar_menu");
  const menuToggle = document.querySelector(".menu-toggle");

  menu.classList.toggle("active");
  menuToggle.classList.toggle("active");
  document.body.classList.toggle("menu-open");
}

// Close mobile menu
function closeMenu() {
  const menu = document.querySelector(".navbar_menu");
  const menuToggle = document.querySelector(".menu-toggle");

  menu.classList.remove("active");
  menuToggle.classList.remove("active");
  document.body.classList.remove("menu-open");
}

// Setup scroll effects
function setupScrollEffects() {
  const header = document.getElementById("site-header");
  const navbar = document.querySelector(".navbar");

  window.addEventListener("scroll", function () {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

    // Header scroll effect
    if (scrollTop > 100) {
      header.classList.add("scrolled");
      navbar.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
      navbar.classList.remove("scrolled");
    }
  });
}

// Setup donation system
function setupDonationSystem() {
  const donateBtn = document.getElementById("donate-btn");
  const donationHistoryBtn = document.getElementById("donation-history-btn");
  const donationModal = document.getElementById("donation-modal");
  const donationHistoryModal = document.getElementById(
    "donation-history-modal"
  );

  // Donate button
  if (donateBtn && donationModal) {
    donateBtn.addEventListener("click", function () {
      showModal(donationModal);
    });
  }

  // Donation history button
  if (donationHistoryBtn && donationHistoryModal) {
    donationHistoryBtn.addEventListener("click", function () {
      showModal(donationHistoryModal);
    });
  }

  // Setup modal close functionality
  setupModalClose();

  // Setup donation form
  setupDonationForm();
}


// Show modal
function showModal(modal) {
  modal.classList.add("active");
  document.body.style.overflow = "hidden";
}

// Hide modal
function hideModal(modal) {
  modal.classList.remove("active");
  document.body.style.overflow = "";
}

// Setup modal close functionality
function setupModalClose() {
  const modals = document.querySelectorAll(".modal");

  modals.forEach((modal) => {
    const closeBtn = modal.querySelector(".close");

    if (closeBtn) {
      closeBtn.addEventListener("click", () => hideModal(modal));
    }

    modal.addEventListener("click", function (e) {
      if (e.target === modal) {
        hideModal(modal);
      }
    });
  });

  // Close modals with Escape key
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      modals.forEach((modal) => {
        if (modal.classList.contains("active")) {
          hideModal(modal);
        }
      });
    }
  });
}

// Setup donation form
function setupDonationForm() {
  const amountBtns = document.querySelectorAll(".amount-btn");
  const customAmountInput = document.getElementById("custom-amount");
  const proceedBtn = document.querySelector(".proceed-donation-btn");

  let selectedAmount = 0;

  // Amount button selection
  amountBtns.forEach((btn) => {
    btn.addEventListener("click", function () {
      amountBtns.forEach((b) => b.classList.remove("selected"));
      this.classList.add("selected");
      selectedAmount = parseInt(this.dataset.amount);
      customAmountInput.value = "";
    });
  });

  // Custom amount input
  if (customAmountInput) {
    customAmountInput.addEventListener("input", function () {
      amountBtns.forEach((b) => b.classList.remove("selected"));
      selectedAmount = parseInt(this.value) || 0;
    });
  }

  // Proceed donation
  if (proceedBtn) {
    proceedBtn.addEventListener("click", function () {
      const donorName = document.getElementById("donor-name").value.trim();
      const donorEmail = document.getElementById("donor-email").value.trim();
      const donorPhone = document.getElementById("donor-phone").value.trim();

      if (selectedAmount < 10000) {
        showNotification("Số tiền tối thiểu là 10.000 VNĐ!", "error");
        return;
      }

      if (!donorName || !donorEmail) {
        showNotification("Vui lòng điền đầy đủ thông tin bắt buộc!", "error");
        return;
      }

      if (!isValidEmail(donorEmail)) {
        showNotification("Email không hợp lệ!", "error");
        return;
      }

      // Simulate payment processing
      this.textContent = "Đang xử lý...";
      this.disabled = true;
      this.classList.add("loading");

      setTimeout(() => {
        showNotification(
          `Cảm ơn bạn đã đóng góp ${formatCurrency(selectedAmount)}!`,
          "success"
        );
        hideModal(document.getElementById("donation-modal"));

        // Reset form
        document.getElementById("donor-name").value = "";
        document.getElementById("donor-email").value = "";
        document.getElementById("donor-phone").value = "";
        document.getElementById("donor-message").value = "";
        document.getElementById("custom-amount").value = "";
        amountBtns.forEach((b) => b.classList.remove("selected"));

        this.textContent = "Tiến hành thanh toán";
        this.disabled = false;
        this.classList.remove("loading");
      }, 2000);
    });
  }
}

// Setup scroll to top button
function setupScrollToTop() {
  const scrollToTopBtn = document.getElementById("scroll-to-top");

  if (scrollToTopBtn) {
    // Show/hide button based on scroll position
    window.addEventListener("scroll", function () {
      const scrollTop =
        window.pageYOffset || document.documentElement.scrollTop;

      if (scrollTop > 500) {
        scrollToTopBtn.classList.add("visible");
      } else {
        scrollToTopBtn.classList.remove("visible");
      }
    });

    // Smooth scroll to top
    scrollToTopBtn.addEventListener("click", function () {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    });
  }
}

// Setup image lazy loading
function setupImageLazyLoading() {
  const images = document.querySelectorAll("img[loading='lazy']");

  if ("IntersectionObserver" in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          const img = entry.target;
          img.classList.add("fade-in");
          observer.unobserve(img);
        }
      });
    });

    images.forEach((img) => imageObserver.observe(img));
  }
}

// Setup share links
function setupShareLinks() {
  const shareLinks = document.querySelectorAll(".share-link");

  shareLinks.forEach((link) => {
    link.addEventListener("click", function (e) {
      e.preventDefault();

      const url = encodeURIComponent(window.location.href);
      const title = encodeURIComponent(document.title);
      let shareUrl = "";

      if (this.classList.contains("facebook")) {
        shareUrl = `https://www.facebook.com/sharer/sharer.php?u=${url}`;
      } else if (this.classList.contains("twitter")) {
        shareUrl = `https://twitter.com/intent/tweet?url=${url}&text=${title}`;
      } else if (this.classList.contains("linkedin")) {
        shareUrl = `https://www.linkedin.com/sharing/share-offsite/?url=${url}`;
      } else if (this.classList.contains("email")) {
        shareUrl = `mailto:?subject=${title}&body=Tôi muốn chia sẻ bài viết này với bạn: ${url}`;
      }

      if (shareUrl) {
        if (this.classList.contains("email")) {
          window.location.href = shareUrl;
        } else {
          window.open(shareUrl, "_blank", "width=600,height=400");
        }
      }
    });
  });
}

// Utility functions
function showNotification(message, type = "info") {
  // Create notification element
  const notification = document.createElement("div");
  notification.className = `notification ${type}`;
  notification.style.cssText = `
    position: fixed;
    top: 20px;
    right: 20px;
    padding: 16px 20px;
    background: ${
      type === "success"
        ? "hsl(142 71% 45%)"
        : type === "error"
        ? "hsl(0 84% 60%)"
        : "hsl(199 89% 48%)"
    };
    color: white;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    z-index: 10001;
    transform: translateX(400px);
    transition: transform 0.3s ease;
    max-width: 300px;
    font-weight: 500;
  `;
  notification.textContent = message;

  document.body.appendChild(notification);

  // Show notification
  setTimeout(() => {
    notification.style.transform = "translateX(0)";
  }, 100);

  // Hide notification
  setTimeout(() => {
    notification.style.transform = "translateX(400px)";
    setTimeout(() => {
      document.body.removeChild(notification);
    }, 300);
  }, 3000);
}

function isValidEmail(email) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function escapeHtml(text) {
  const div = document.createElement("div");
  div.textContent = text;
  return div.innerHTML;
}

function formatCurrency(amount) {
  return new Intl.NumberFormat("vi-VN", {
    style: "currency",
    currency: "VND",
  }).format(amount);
}

// Handle page visibility changes
document.addEventListener("visibilitychange", function () {
  if (document.hidden) {
    document.title = "💝 Quay lại để tiếp tục đọc!";
  } else {
    document.title =
      "Hành Trình Yêu Thương - Giúp Đỡ Trẻ Em Khó Khăn | SUNFLAMECARE";
  }
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    const target = document.querySelector(this.getAttribute("href"));
    if (target) {
      target.scrollIntoView({
        behavior: "smooth",
        block: "start",
      });
    }
  });
});

// Add loading animation to images
document.querySelectorAll("img").forEach((img) => {
  img.addEventListener("load", function () {
    this.classList.add("fade-in");
  });
});

// Performance optimization: Debounce scroll events
function debounce(func, wait) {
  let timeout;
  return function executedFunction(...args) {
    const later = () => {
      clearTimeout(timeout);
      func(...args);
    };
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
  };
}

// Apply debounce to scroll events
const debouncedScrollHandler = debounce(() => {
  // Any heavy scroll operations can go here
}, 10);

window.addEventListener("scroll", debouncedScrollHandler);
