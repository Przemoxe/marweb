
    const hamburgerButton = document.querySelector(".nav-hamburger .fa-bars");
const hamburgerMenuLists = document.querySelector(".nav-top-mobile .main-container-px20 .nav-lists");
const backgroundMobileMenu = document.querySelector(".nav-top-mobile")
const singleLink = document.querySelector("#mobile-main-menu li a")
const allLinks = document.querySelector(".nav-lists")


hamburgerButton.addEventListener("click", function(){
    hamburgerMenuLists.classList.toggle("nav-mobile-visible")
    backgroundMobileMenu.classList.toggle("nav-top-mobile-active")
});


singleLink.addEventListener("click", function(){
    allLinks.classList.remove('nav-mobile-visible');
    backgroundMobileMenu.classList.toggle("nav-top-mobile-active")
});



