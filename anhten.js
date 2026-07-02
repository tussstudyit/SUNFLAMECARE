function toggleDropdown() {
  const dropdown = document.getElementById("dropdownMenu");
  dropdown.style.display =
    dropdown.style.display === "block" ? "none" : "block";
}

// Ẩn dropdown nếu click ra ngoài
document.addEventListener("click", function (event) {
  const dropdown = document.getElementById("dropdownMenu");
  const userInfo = document.querySelector(".user-info");

  if (!userInfo.contains(event.target)) {
    dropdown.style.display = "none";
  }
});
