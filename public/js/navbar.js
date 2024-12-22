const navbar = document.querySelector("nav");

window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
        navbar.classList.add("nav-scrolled");
    } else {
        navbar.classList.remove("nav-scrolled");
    }
});
