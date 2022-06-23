const hamburgerButton = document.querySelector(".nav-hamburger .fa-bars");
const hamburgerMenuLists = document.querySelector(".nav-top-mobile .main-container-px20 .nav-lists");
const backgroundMobileMenu = document.querySelector(".nav-top-mobile")

hamburgerButton.addEventListener("click", function(){
    hamburgerMenuLists.classList.toggle("nav-mobile-visible")
    backgroundMobileMenu.classList.toggle("nav-top-mobile-active")
});
