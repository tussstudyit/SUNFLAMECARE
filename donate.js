console.log("donate.js loaded");

var DonationApp = {
  config: {
    currency: "VND",
    defaultAmount: 500000,
    backendEndpoint: "http://localhost:3000/donate.php",
    qrImage: "imgthuyennguyen/qr.jpg", // Ảnh QR tĩnh
  },
  donation: {
    amount: 500000,
    activityCode:
      new URLSearchParams(window.location.search).get("activity_code") ||
      "UNKNOWN",
    fullName: "",
    email: "",
    phone: "",
    address: "",
    message: "",
  },
};

$(document).ready(function () {
  console.log(
    "Donation form initialized, activity_code:",
    DonationApp.donation.activityCode
  );

  if (DonationApp.donation.activityCode === "UNKNOWN") {
    showError(
      "Không tìm thấy mã hoạt động. Vui lòng thêm ?activity_code=XXX vào URL.",
      ".form-errors"
    );
    $(".btn-donate").prop("disabled", true);
  }

  initializeForm();
  setupEventListeners();
  showStage(1);
  updateDonationAmountDisplay();
});

function initializeForm() {
  $("#donation_amount_other_input").val(
    formatCurrency(DonationApp.config.defaultAmount)
  );
  $('input[name="donation_amount"][value="500000"]').prop("checked", true);
  $("#activity_code").val(DonationApp.donation.activityCode);
  $("#activity_code_note").text(DonationApp.donation.activityCode);
  $("#summary_activity_code").text(DonationApp.donation.activityCode);
  $("#qr_code_image").attr("src", DonationApp.config.qrImage);
  $("#transfer_content").val("");
  clearFormErrors();
}

function setupEventListeners() {
  $('input[name="donation_amount"]').on("change", handleAmountSelection);
  $("#donation_amount_other_input").on("input", handleCustomAmountInput);
  $("#donation_amount_other_input").on("blur", formatAmountInput);
  $(".progress-stage-button-next").on("click", handleNextButton);
  $(".progress-stage-button-prev").on("click", handlePrevButton);
  $("#donation_form").on("submit", function (e) {
    console.log("Form submit event triggered in donate.js");
    handleFormSubmission(e);
  });
  $(
    "#donation_full_name, #donation_email, #donation_phone, #donation_address"
  ).on("blur", updateSummary);
  $("#copy_transfer_content").on("click", handleCopyTransferContent);
}

function handleAmountSelection() {
  var selectedValue = $(this).val();
  if (selectedValue === "other") {
    $("#donation_amount_other_input").focus();
  } else {
    var amount = parseInt(selectedValue);
    $("#donation_amount_other_input").val(formatCurrency(amount));
    DonationApp.donation.amount = amount;
  }
  updateDonationAmountDisplay();
}

function handleCustomAmountInput() {
  $('input[name="donation_amount"][value="other"]').prop("checked", true);
  var rawValue = $(this)
    .val()
    .replace(/[^0-9]/g, "");
  var amount = parseInt(rawValue) || 0;
  DonationApp.donation.amount = amount;
  updateDonationAmountDisplay();
}

function formatAmountInput() {
  var rawValue = $(this)
    .val()
    .replace(/[^0-9]/g, "");
  var amount = parseInt(rawValue) || DonationApp.config.defaultAmount;
  $(this).val(formatCurrency(amount));
  DonationApp.donation.amount = amount;
  updateDonationAmountDisplay();
}

function updateDonationAmountDisplay() {
  var amount = DonationApp.donation.amount || DonationApp.config.defaultAmount;
  $(".nb_donation_v2_amount").text(formatCurrency(amount));
}

function formatCurrency(amount) {
  return new Intl.NumberFormat("vi-VN").format(amount);
}

function validateStage(stageId) {
  clearFormErrors();
  var isValid = true;

  if (stageId === 1) {
    if (!DonationApp.donation.amount || DonationApp.donation.amount <= 0) {
      showError(
        "Vui lòng nhập số tiền hợp lệ (tối thiểu 1.000 VND).",
        ".form-errors"
      );
      isValid = false;
    } else if (DonationApp.donation.amount < 1000) {
      showError("Số tiền quyên góp tối thiểu là 1.000 VND.", ".form-errors");
      isValid = false;
    }
  } else if (stageId === 2) {
    if (DonationApp.donation.activityCode === "UNKNOWN") {
      showError(
        "Mã hoạt động không hợp lệ. Vui lòng chọn một chương trình quyên góp.",
        ".alert-info"
      );
      isValid = false;
    }
    var requiredFields = [
      {
        id: "#donation_full_name",
        message: "Vui lòng nhập họ và tên.",
        minLength: 2,
      },
      {
        id: "#donation_email",
        message: "Vui lòng nhập email hợp lệ.",
        type: "email",
      },
      {
        id: "#donation_phone",
        message: "Vui lòng nhập số điện thoại.",
        type: "phone",
      },
      {
        id: "#donation_address",
        message: "Vui lòng nhập địa chỉ.",
        minLength: 10,
      },
    ];

    requiredFields.forEach(function (field) {
      var $input = $(field.id);
      var value = $input.val().trim();

      if (!value) {
        $input.addClass("error");
        showError(field.message, field.id);
        isValid = false;
      } else {
        if (field.type === "email" && !isValidEmail(value)) {
          $input.addClass("error");
          showError("Định dạng email không hợp lệ.", field.id);
          isValid = false;
        } else if (field.type === "phone" && !isValidPhone(value)) {
          $input.addClass("error");
          showError("Số điện thoại không hợp lệ (10-11 số).", field.id);
          isValid = false;
        } else if (field.minLength && value.length < field.minLength) {
          $input.addClass("error");
          showError(
            `${field.message.replace(".", "")} (tối thiểu ${
              field.minLength
            } ký tự).`,
            field.id
          );
          isValid = false;
        } else {
          $input.removeClass("error");
        }
      }
    });

    if (isValid) {
      DonationApp.donation.fullName = $("#donation_full_name").val().trim();
      DonationApp.donation.email = $("#donation_email").val().trim();
      DonationApp.donation.phone = $("#donation_phone").val().trim();
      DonationApp.donation.address = $("#donation_address").val().trim();
      DonationApp.donation.message = $("#donation_message").val().trim();
    }
  }

  return isValid;
}

function isValidEmail(email) {
  var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(email);
}

function isValidPhone(phone) {
  var phoneRegex = /^[0-9]{10,11}$/;
  var cleanPhone = phone.replace(/[\s\-\(\)]/g, "");
  return phoneRegex.test(cleanPhone);
}

function showError(message, targetSelector) {
  var $target = $(targetSelector);
  var errorHtml = `<div class="form-error alert alert-danger mt-2">${message}</div>`;
  if (targetSelector.startsWith("#")) {
    $target.after(errorHtml);
  } else {
    $target.append(errorHtml);
  }
}

function clearFormErrors() {
  $(".form-error").remove();
  $(".form-control").removeClass("error");
  $(".form-errors").empty();
  $(".payment-error-container").empty();
}

function handleNextButton(e) {
  e.preventDefault();
  var $currentStage = $(this).closest(".progress-stage");
  var currentStageId = parseInt($currentStage.data("stageid"));
  var nextStageId = currentStageId + 1;

  if (validateStage(currentStageId)) {
    if (nextStageId <= 3) {
      showStage(nextStageId);
      updateSummary();
    }
  }
}

function handlePrevButton(e) {
  e.preventDefault();
  var $currentStage = $(this).closest(".progress-stage");
  var currentStageId = parseInt($currentStage.data("stageid"));
  var prevStageId = currentStageId - 1;
  if (prevStageId >= 1) {
    showStage(prevStageId);
  }
}

function showStage(stageId) {
  $(".progress-stage").removeClass("active").hide();
  $(`.progress-stage[data-stageid="${stageId}"]`).addClass("active").show();
  $(".progress-indicator-stage").removeClass("active");
  $(`.progress-indicator-stage.stage-${stageId}`).addClass("active");
  for (let i = 1; i < stageId; i++) {
    $(`.progress-indicator-stage.stage-${i}`).addClass("completed");
  }
  $(".donation-wrapper")[0].scrollIntoView({
    behavior: "smooth",
    block: "start",
  });
}

function updateSummary() {
  $("#summary_name").text(DonationApp.donation.fullName || "-");
  updateDonationAmountDisplay();
}

function handleCopyTransferContent() {
  var $input = $("#transfer_content");
  $input[0].select();
  try {
    document.execCommand("copy");
    alert("Đã sao chép nội dung chuyển khoản!");
  } catch (err) {
    console.error("Lỗi khi sao chép:", err);
    alert("Không thể sao chép. Vui lòng chọn và sao chép thủ công.");
  }
}

function handleFormSubmission(e) {
  e.preventDefault();
  console.log("handleFormSubmission called");
  var $submitBtn = $(".btn-donate");
  $submitBtn.addClass("loading").prop("disabled", true);
  clearFormErrors();

  if (!validateStage(2)) {
    console.log("Validation failed for stage 2");
    $submitBtn.removeClass("loading").prop("disabled", false);
    return;
  }

  if (DonationApp.donation.activityCode === "UNKNOWN") {
    console.log("Invalid activity_code:", DonationApp.donation.activityCode);
    showError("Mã hoạt động không hợp lệ.", ".payment-error-container");
    $submitBtn.removeClass("loading").prop("disabled", false);
    return;
  }

  var formData = {
    activity_code: DonationApp.donation.activityCode,
    donation_amount: DonationApp.donation.amount,
    full_name: DonationApp.donation.fullName,
    email: DonationApp.donation.email,
    phone: DonationApp.donation.phone,
    address: DonationApp.donation.address,
    message: DonationApp.donation.message,
    // Tạm bỏ CSRF token để test
  };

  console.log("Sending POST request to:", DonationApp.config.backendEndpoint);
  console.log("Form data:", formData);

  $.ajax({
    url: DonationApp.config.backendEndpoint,
    type: "POST",
    contentType: "application/x-www-form-urlencoded; charset=UTF-8",
    data: $.param(formData),
    success: function (response) {
      console.log("Server response:", response);
      $submitBtn.removeClass("loading").prop("disabled", false);
      if (response.success) {
        $("#transfer_content").val(
          response.data.transfer_content || "QUYENGOP_UNKNOWN"
        );
        if (response.data.qr_image) {
          $("#qr_code_image").attr("src", response.data.qr_image);
        }
        $("#successModal .modal-body #transferContent").val(
          response.data.transfer_content
        );
        $("#successModal .modal-body p").html(
          `Thông tin quyên góp đã được ghi nhận! \n Vui lòng quét mã QR bên dưới để chuyển khoản số tiền <strong>${formatCurrency(
            formData.donation_amount
          )} VND</strong> hoặc chuyển khoản trực tiếp đến tài khoản sau và nhập nội dung:`
        );
        showSuccessModal();
        resetForm();
      } else {
        console.log("Server error:", response.message);
        showError(
          response.message || "Lỗi không xác định từ server.",
          ".payment-error-container"
        );
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX error:", {
        status: status,
        error: error,
        responseText: xhr.responseText,
        statusCode: xhr.status,
      });
      $submitBtn.removeClass("loading").prop("disabled", false);
      let errorMsg = xhr.responseText;
      try {
        const jsonError = JSON.parse(xhr.responseText);
        errorMsg = jsonError.message || errorMsg;
      } catch (e) {}
      showError(
        `Lỗi kết nối server: ${errorMsg || "Vui lòng thử lại."}`,
        ".payment-error-container"
      );
    },
  });
}

function copyToClipboard() {
  const transferContent = document.getElementById("transferContent");
  transferContent.select();
  try {
    document.execCommand("copy");
    alert("Đã sao chép nội dung: " + transferContent.value);
  } catch (err) {
    console.error("Lỗi khi sao chép: ", err);
    alert("Không thể sao chép, vui lòng thử lại.");
  }
}

function showSuccessModal() {
  $("#successModal").modal("show");
}

function resetForm() {
  $("#donation_form")[0].reset();
  DonationApp.donation = {
    amount: DonationApp.config.defaultAmount,
    activityCode: DonationApp.donation.activityCode,
    fullName: "",
    email: "",
    phone: "",
    address: "",
    message: "",
  };
  $(".btn-donate").removeClass("loading").prop("disabled", false);
  $(".form-control").removeClass("error");
  clearFormErrors();
  setTimeout(function () {
    showStage(1);
    initializeForm();
  }, 500);
}
