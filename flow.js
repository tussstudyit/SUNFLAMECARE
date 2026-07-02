let allUsers = JSON.parse(localStorage.getItem("users")) || [];
let currentUser = JSON.parse(localStorage.getItem("currentUser")) || null;

let suggestions = allUsers.filter(
  (user) => user.username !== currentUser?.username
);

// Lấy 4 người đầu tiên
let topSuggestions = suggestions.slice(0, 4);

// Hiển thị
let suggestionContainer = document.getElementById("suggestions");
topSuggestions.forEach((user) => {
  let item = document.createElement("div");
  item.className = "suggestion-item";
  item.innerHTML = `
    <img src="${user.avatar}" alt="avatar" class="suggestion-avatar">
    <span>${user.username}</span>
    <button class="follow-btn">Theo dõi</button>
  `;
  suggestionContainer.appendChild(item);
});
