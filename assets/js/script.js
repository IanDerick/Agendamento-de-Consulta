document.addEventListener("DOMContentLoaded", function () {
  const links = document.querySelectorAll(".nav-link");
  const currentPage = window.location.pathname.split("/").pop();

  links.forEach(link => {
    const linkHref = link.getAttribute("href").split("/").pop();
  
    if (linkHref === currentPage) {
      link.classList.add("active");
    }
  });
});