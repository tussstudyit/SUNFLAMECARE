function toggleDropdown() {
  const menu = document.getElementById("dropdownMenu");
  menu.classList.toggle("show");
}

// Ẩn dropdown khi click ra ngoài
window.addEventListener("click", function (e) {
  if (!e.target.closest(".user-dropdown")) {
    document.getElementById("dropdownMenu")?.classList.remove("show");
  }
});
