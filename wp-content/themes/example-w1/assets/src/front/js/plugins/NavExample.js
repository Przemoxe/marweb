export default function(){
  window.onscroll = function () {
    // pageYOffset or scrollY
    const navContainer = document.querySelector(".nav-top");
    const navMoblieContainer = document.querySelector(".nav-top-mobile");
    const navText = document.querySelectorAll(".menu-item a");
  
    if (window.pageYOffset > 0) {
      navContainer.classList.add("nav-top-active");
      navMoblieContainer.classList.add("nav-top-active");
      navText.forEach((el) => {
        el.classList.add("text-black");
      });
    } else {
      navContainer.classList.remove("nav-top-active");
      navMoblieContainer.classList.remove("nav-top-active");
      navText.forEach((el) => {
        el.classList.remove("text-black");
      });
    }
  };
  
}
