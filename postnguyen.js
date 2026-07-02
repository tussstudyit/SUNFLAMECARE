// Khởi tạo khi trang được tải
document.addEventListener('DOMContentLoaded', function() {
    // Thiết lập ngày giờ đăng bài
    setPublishDate();
    
    // Thiết lập hệ thống đánh giá sao
    setupRatingSystem();
    
    // Xử lý form bình luận
    setupCommentForm();
    
    // Xử lý nút "Xem thêm bình luận"
    setupLoadMoreComments();
    
    // Xử lý menu mobile
    setupMobileMenu();
});

// Thiết lập ngày giờ đăng bài viết
function setPublishDate() {
    const publishDateElement = document.getElementById('publish-date');
    if (publishDateElement) {
        // Tạo ngày giờ (ví dụ: bài đăng 3 ngày trước)
        const publishDate = new Date();
        publishDate.setDate(publishDate.getDate() - 3);
        
        // Định dạng ngày giờ theo kiểu Việt Nam
        const options = { 
            year: 'numeric', 
            month: 'long', 
            day: 'numeric', 
            hour: '2-digit', 
            minute: '2-digit' 
        };
        
        publishDateElement.textContent = publishDate.toLocaleDateString('vi-VN', options);
    }
}

// Thiết lập hệ thống đánh giá sao
function setupRatingSystem() {
    const stars = document.querySelectorAll('.star-rating i');
    const ratingCount = document.querySelector('.rating-count');
    
    if (!stars.length || !ratingCount) return;
    
    let currentRating = 0;
    let totalRatings = 0;
    
    // Tải đánh giá từ localStorage nếu có
    const savedRating = localStorage.getItem('articleRating');
    if (savedRating) {
        currentRating = parseInt(savedRating);
        totalRatings = 1;
        updateStars(currentRating);
        updateRatingCount(totalRatings);
    }
    
    // Xử lý sự kiện hover
    stars.forEach(star => {
        star.addEventListener('mouseenter', function() {
            const rating = parseInt(this.getAttribute('data-rating'));
            highlightStars(rating);
        });
        
        star.addEventListener('mouseleave', function() {
            highlightStars(currentRating);
        });
        
        // Xử lý sự kiện click
        star.addEventListener('click', function() {
            const rating = parseInt(this.getAttribute('data-rating'));
            
            // Nếu người dùng click vào rating hiện tại, hủy đánh giá
            if (rating === currentRating) {
                currentRating = 0;
                totalRatings = Math.max(0, totalRatings - 1);
            } else {
                // Nếu là đánh giá mới hoặc thay đổi đánh giá
                if (currentRating === 0) totalRatings++;
                currentRating = rating;
            }
            
            // Cập nhật giao diện
            highlightStars(currentRating);
            updateRatingCount(totalRatings);
            
            // Lưu vào localStorage
            if (currentRating > 0) {
                localStorage.setItem('articleRating', currentRating);
            } else {
                localStorage.removeItem('articleRating');
            }
            
            // Hiệu ứng animation
            this.classList.add('pulse');
            setTimeout(() => {
                this.classList.remove('pulse');
            }, 300);
        });
    });
}

// Hàm highlight các sao dựa trên rating
function highlightStars(rating) {
    const stars = document.querySelectorAll('.star-rating i');
    
    stars.forEach(star => {
        const starRating = parseInt(star.getAttribute('data-rating'));
        if (starRating <= rating) {
            star.classList.add('fas');
            star.classList.remove('far');
        } else {
            star.classList.add('far');
            star.classList.remove('fas');
        }
    });
}

// Hàm cập nhật số lượng đánh giá hiển thị
function updateStars(rating) {
    highlightStars(rating);
}

// Hàm cập nhật số lượng đánh giá hiển thị
function updateRatingCount(count) {
    const ratingCount = document.querySelector('.rating-count');
    if (ratingCount) {
        ratingCount.textContent = `(${count} đánh giá)`;
    }
}

// Thiết lập xử lý form bình luận
function setupCommentForm() {
    const commentForm = document.getElementById('comment-form');
    
    if (commentForm) {
        commentForm.addEventListener('submit', function(event) {
            event.preventDefault();
            
            // Lấy giá trị các trường nhập liệu
            const name = document.getElementById('comment-name').value.trim();
            const email = document.getElementById('comment-email').value.trim();
            const commentText = document.getElementById('comment-text').value.trim();
            
            // Kiểm tra dữ liệu
            if (!name || !email || !commentText) {
                alert('Vui lòng điền đầy đủ thông tin!');
                return;
            }
            
            // Xử lý gửi bình luận (giả lập)
            // Trong thực tế, bạn sẽ gửi dữ liệu đến server
            alert('Cảm ơn bạn đã bình luận. Bình luận của bạn đang được xét duyệt!');
            
            // Reset form
            commentForm.reset();
        });
    }
}

// Thiết lập nút "Xem thêm bình luận"
function setupLoadMoreComments() {
    const loadMoreBtn = document.querySelector('.load-more-btn');
    
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // Hiển thị trạng thái đang tải
            this.textContent = 'Đang tải...';
            this.disabled = true;
            
            // Giả lập thời gian tải dữ liệu (trong thực tế sẽ gọi API)
            setTimeout(() => {
                // Sau khi tải xong, cập nhật nút
                this.textContent = 'Đã tải tất cả bình luận';
                this.style.opacity = '0.7';
                this.style.cursor = 'not-allowed';
            }, 1500);
        });
    }
}

// Thiết lập menu mobile
function setupMobileMenu() {
    const menuToggle = document.querySelector('.menu-toggle');
    const menu = document.querySelector('.navbar_menu');
    
    if (menuToggle && menu) {
        // Xử lý sự kiện click vào nút toggle
        menuToggle.addEventListener('click', function() {
            toggleMenu();
        });
        
        // Đóng menu khi click ra ngoài
        document.addEventListener('click', function(event) {
            if (!menu.contains(event.target) && !menuToggle.contains(event.target)) {
                menu.classList.remove('active');
            }
        });
        
        // Đóng menu khi click vào một mục menu
        const menuItems = document.querySelectorAll('.navbar_menu li a');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
                menu.classList.remove('active');
            });
        });
    }
}

// Bật/tắt menu trên thiết bị di động
document.querySelector('.menu-toggle').addEventListener('click', function (event) {
    const menu = document.querySelector('.navbar_menu');
    menu.classList.toggle('active');
    this.classList.toggle('active');
    document.body.classList.toggle('menu-open');
    event.stopPropagation();
});

// Đóng menu khi nhấn ra ngoài
document.addEventListener('click', function (event) {
    const menu = document.querySelector('.navbar_menu');
    const menuToggle = document.querySelector('.menu-toggle');
    if (!menu.contains(event.target) && !menuToggle.contains(event.target)) {
        menu.classList.remove('active');
        menuToggle.classList.remove('active');
        document.body.classList.remove('menu-open');
    }
});

// Đóng menu khi nhấn vào một mục menu
document.querySelectorAll('.navbar_menu li a').forEach(item => {
    item.addEventListener('click', () => {
        document.querySelector('.navbar_menu').classList.remove('active');
        document.querySelector('.menu-toggle').classList.remove('active');
        document.body.classList.remove('menu-open');
    });
});

