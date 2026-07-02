const observer = new IntersectionObserver((entries) => {
  entries.forEach((entry) => {
    if (entry.isIntersecting) {
      document.querySelector(".img-top").classList.add("img-show");
      document.querySelector(".img-bottom").classList.add("img-show");
      observer.disconnect(); // Chỉ chạy 1 lần
    }
  });
});

observer.observe(document.querySelector(".imgage"));
