const dropdownMenu = document.getElementById("dropdownMenu");
window.toggleDropdown = function (event) {
  event.stopPropagation();
  dropdownMenu.style.display =
    dropdownMenu.style.display === "block" ? "none" : "block";
};

document.addEventListener("click", function (event) {
  if (!event.target.closest(".user-dropdown")) {
    dropdownMenu.style.display = "none";
  }
});
