// Khởi tạo khi trang được tải
document.addEventListener("DOMContentLoaded", function () {
  // Thiết lập các tab tài chính
  setupFinancialTabs();

  // Tạo dữ liệu thu nhập
  generateIncomeData();

  // Tạo dữ liệu chi tiêu
  generateExpenseData();

  // Tạo biểu đồ phân bổ chi phí
  generateExpenseChart();

  // Tạo danh sách nhà hảo tâm
  generateDonorsList();

  // Thiết lập nút tải thêm nhà hảo tâm
  setupLoadMoreDonors();

  // Thiết lập nút tải báo cáo
  setupDownloadButtons();
});

// Thiết lập các tab tài chính
function setupFinancialTabs() {
  const tabButtons = document.querySelectorAll(".tab-btn");
  const tabPanes = document.querySelectorAll(".tab-pane");

  if (tabButtons.length && tabPanes.length) {
    tabButtons.forEach((button) => {
      button.addEventListener("click", function () {
        // Xóa active từ tất cả buttons
        tabButtons.forEach((btn) => btn.classList.remove("active"));

        // Thêm active cho button được click
        this.classList.add("active");

        // Hiển thị tab tương ứng
        const tabId = this.getAttribute("data-tab");
        tabPanes.forEach((pane) => {
          pane.classList.remove("active");
          if (pane.id === tabId) {
            pane.classList.add("active");
          }
        });
      });
    });
  }
}

// Tạo dữ liệu thu nhập
function generateIncomeData() {
  const incomeTableBody = document.getElementById("income-table-body");

  if (incomeTableBody) {
    const incomeData = [
      {
        id: 1,
        date: "01/05/2023",
        source: "Quỹ Cá Nhân",
        description: "Quyên góp từ Ông Nguyễn Văn A",
        amount: "100,000,000",
      },
      {
        id: 2,
        date: "05/05/2023",
        source: "Doanh Nghiệp",
        description: "Tài trợ từ Công ty TNHH ABC",
        amount: "150,000,000",
      },
      {
        id: 3,
        date: "10/05/2023",
        source: "Quỹ Cá Nhân",
        description: "Quyên góp từ chương trình gây quỹ trực tuyến",
        amount: "85,000,000",
      },
      {
        id: 4,
        date: "15/05/2023",
        source: "Doanh Nghiệp",
        description: "Tài trợ từ Tập đoàn XYZ",
        amount: "100,000,000",
      },
      {
        id: 5,
        date: "20/05/2023",
        source: "Quỹ Cá Nhân",
        description: "Quyên góp từ các nhà hảo tâm cá nhân",
        amount: "120,000,000",
      },
      {
        id: 6,
        date: "25/05/2023",
        source: "Doanh Nghiệp",
        description: "Tài trợ từ Công ty Cổ phần DEF",
        amount: "50,000,000",
      },
      {
        id: 7,
        date: "30/05/2023",
        source: "Quỹ Cá Nhân",
        description: "Quyên góp từ hội cựu học sinh VN-US",
        amount: "145,000,000",
      },
    ];

    incomeData.forEach((item) => {
      const row = document.createElement("tr");
      row.innerHTML = `
                <td>${item.id}</td>
                <td>${item.date}</td>
                <td>${item.source}</td>
                <td>${item.description}</td>
                <td>${item.amount}</td>
            `;
      incomeTableBody.appendChild(row);
    });
  }
}

// Tạo dữ liệu chi tiêu
function generateExpenseData() {
  const expenseTableBody = document.getElementById("expense-table-body");

  if (expenseTableBody) {
    const expenseData = [
      {
        id: 1,
        date: "08/06/2023",
        purpose: "Xây dựng",
        description: "Xây dựng 2 phòng học tại điểm trường thôn Tả Lủng",
        amount: "250,000,000",
      },
      {
        id: 2,
        date: "10/06/2023",
        purpose: "Xây dựng",
        description: "Mua sắm bàn ghế và trang thiết bị học tập",
        amount: "100,000,000",
      },
      {
        id: 3,
        date: "12/06/2023",
        purpose: "Học bổng",
        description: "Học bổng cho 50 học sinh (2 triệu đồng/suất)",
        amount: "100,000,000",
      },
      {
        id: 4,
        date: "13/06/2023",
        purpose: "Quà tặng",
        description: "500 suất quà gồm sách vở và đồ dùng học tập",
        amount: "100,000,000",
      },
      {
        id: 5,
        date: "14/06/2023",
        purpose: "Quà tặng",
        description: "Quần áo và nhu yếu phẩm cho người dân địa phương",
        amount: "50,000,000",
      },
      {
        id: 6,
        date: "15/06/2023",
        purpose: "Y tế",
        description: "Khám sức khỏe và phát thuốc miễn phí",
        amount: "30,000,000",
      },
      {
        id: 7,
        date: "10-16/06/2023",
        purpose: "Vận chuyển",
        description: "Chi phí vận chuyển đoàn thiện nguyện",
        amount: "45,450,000",
      },
      {
        id: 8,
        date: "10-16/06/2023",
        purpose: "Tổ chức",
        description: "Chi phí tổ chức sự kiện giao lưu văn hóa",
        amount: "27,000,000",
      },
    ];

    expenseData.forEach((item) => {
      const row = document.createElement("tr");
      row.innerHTML = `
                <td>${item.id}</td>
                <td>${item.date}</td>
                <td>${item.purpose}</td>
                <td>${item.description}</td>
                <td>${item.amount}</td>
            `;
      expenseTableBody.appendChild(row);
    });
  }
}

// Tạo biểu đồ phân bổ chi phí
function generateExpenseChart() {
  const ctx = document.getElementById("expense-chart");

  if (ctx) {
    new Chart(ctx, {
      type: "doughnut",
      data: {
        labels: [
          "Xây dựng cơ sở vật chất",
          "Học bổng",
          "Quà tặng đồ dùng học tập",
          "Quà tặng nhu yếu phẩm",
          "Y tế",
          "Vận chuyển",
          "Tổ chức sự kiện",
        ],
        datasets: [
          {
            data: [350, 100, 100, 50, 30, 45.45, 27],
            backgroundColor: [
              "#4e73df",
              "#1cc88a",
              "#36b9cc",
              "#f6c23e",
              "#e74a3b",
              "#858796",
              "#f8f9fa",
            ],
            hoverBackgroundColor: [
              "#2e59d9",
              "#17a673",
              "#2c9faf",
              "#f4b619",
              "#e02d1b",
              "#717384",
              "#e6e8ed",
            ],
            hoverBorderColor: "rgba(234, 236, 244, 1)",
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          callbacks: {
            label: function (tooltipItem, data) {
              var dataset = data.datasets[tooltipItem.datasetIndex];
              var currentValue = dataset.data[tooltipItem.index];
              return (
                data.labels[tooltipItem.index] +
                ": " +
                currentValue +
                " triệu VNĐ"
              );
            },
          },
        },
        legend: {
          position: "right",
          labels: {
            fontColor: "#333",
            fontSize: 12,
            padding: 20,
          },
        },
        cutoutPercentage: 70,
      },
    });
  }
}

// Tạo danh sách nhà hảo tâm
function generateDonorsList() {
  const donorsList = document.getElementById("donors-list");

  if (donorsList) {
    const donorsData = [
      {
        name: "Nguyễn Văn A",
        amount: "100,000,000 VNĐ",
        avatar: "https://i.pravatar.cc/40?img=1",
      },
      {
        name: "Công ty TNHH ABC",
        amount: "150,000,000 VNĐ",
        avatar: "https://via.placeholder.com/40/4e73df/ffffff?text=ABC",
      },
      {
        name: "Tập đoàn XYZ",
        amount: "100,000,000 VNĐ",
        avatar: "https://via.placeholder.com/40/1cc88a/ffffff?text=XYZ",
      },
      {
        name: "Hội cựu học sinh VN-US",
        amount: "145,000,000 VNĐ",
        avatar: "https://via.placeholder.com/40/36b9cc/ffffff?text=VN",
      },
    ];

    donorsData.forEach((donor) => {
      const donorItem = document.createElement("div");
      donorItem.className = "donor-item";
      donorItem.innerHTML = `
                <img src="${donor.avatar}" alt="Avatar" class="donor-avatar">
                <div class="donor-info">
                    <span class="donor-name">${donor.name}</span>
                    <span class="donor-amount">${donor.amount}</span>
                </div>
            `;
      donorsList.appendChild(donorItem);
    });
  }
}

// Thiết lập nút tải thêm nhà hảo tâm
function setupLoadMoreDonors() {
  const loadMoreBtn = document.getElementById("load-more-donors");

  if (loadMoreBtn) {
    loadMoreBtn.addEventListener("click", function () {
      // Hiển thị trạng thái đang tải
      this.textContent = "Đang tải...";
      this.disabled = true;

      // Giả lập thời gian tải dữ liệu (trong thực tế sẽ gọi API)
      setTimeout(() => {
        // Tạo thêm nhà hảo tâm mới
        const donorsList = document.getElementById("donors-list");
        const moreData = [
          {
            name: "Trần Thị B",
            amount: "50,000,000 VNĐ",
            avatar: "https://i.pravatar.cc/40?img=5",
          },
          {
            name: "Lê Văn C",
            amount: "30,000,000 VNĐ",
            avatar: "https://i.pravatar.cc/40?img=15",
          },
          {
            name: "Phạm Thị D",
            amount: "25,000,000 VNĐ",
            avatar: "https://i.pravatar.cc/40?img=25",
          },
          {
            name: "Công ty cổ phần DEF",
            amount: "50,000,000 VNĐ",
            avatar: "https://via.placeholder.com/40/f6c23e/ffffff?text=DEF",
          },
          {
            name: "Vũ Văn E",
            amount: "20,000,000 VNĐ",
            avatar: "https://i.pravatar.cc/40?img=35",
          },
          {
            name: "Hoàng Thị F",
            amount: "15,000,000 VNĐ",
            avatar: "https://i.pravatar.cc/40?img=45",
          },
          {
            name: "Đặng Văn G",
            amount: "10,000,000 VNĐ",
            avatar: "https://i.pravatar.cc/40?img=55",
          },
          {
            name: "Phan Thị H",
            amount: "10,000,000 VNĐ",
            avatar: "https://i.pravatar.cc/40?img=65",
          },
        ];

        moreData.forEach((donor) => {
          const donorItem = document.createElement("div");
          donorItem.className = "donor-item";
          donorItem.innerHTML = `
                        <img src="${donor.avatar}" alt="Avatar" class="donor-avatar">
                        <div class="donor-info">
                            <span class="donor-name">${donor.name}</span>
                            <span class="donor-amount">${donor.amount}</span>
                        </div>
                    `;
          donorsList.appendChild(donorItem);
        });

        // Sau khi tải xong, cập nhật nút
        this.textContent = "Đã tải tất cả nhà hảo tâm";
        this.style.opacity = "0.7";
        this.style.cursor = "not-allowed";
      }, 1500);
    });
  }
}

// Thiết lập nút tải báo cáo
function setupDownloadButtons() {
  const downloadButtons = document.querySelectorAll(".download-btn");

  if (downloadButtons.length) {
    downloadButtons.forEach((button) => {
      button.addEventListener("click", function (e) {
        e.preventDefault();

        const fileType = this.textContent.includes("PDF")
          ? "PDF"
          : this.textContent.includes("Excel")
          ? "Excel"
          : "ZIP";

        alert(
          `Chức năng tải về tệp ${fileType} đang được phát triển. Vui lòng quay lại sau!`
        );
      });
    });
  }
}
