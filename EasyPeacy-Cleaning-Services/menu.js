document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.getElementById("hamburger");
  const nav = document.getElementById("nav-links");

  hamburger.addEventListener("click", function () {
    nav.classList.toggle("active");
  });
});
