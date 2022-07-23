const navContainer = document.querySelector(".nav-top");
const navMoblieContainer = document.querySelector(".nav-top-mobile");
const darkLogo = document.querySelector(".dark-logo");
const whiteLogo = document.querySelector(".white-logo");

let navText = document.querySelectorAll(".menu-item a");


  window.onscroll = function () {
    // pageYOffset or scrollY

    if (window.pageYOffset > 0) {
      if(darkLogo){
        darkLogo.classList.remove('logo-active')
        whiteLogo.classList.add('logo-active')
      }
      navContainer.classList.add("nav-top-active");
      navMoblieContainer.classList.add("nav-top-active");

      // logofrontWhite.classList.add('active');
      navText.forEach((el) => {
        el.classList.add("text-black");
      });
    } else {
      if(darkLogo){
        darkLogo.classList.add('logo-active')
        whiteLogo.classList.remove('logo-active')
      }
      navContainer.classList.remove("nav-top-active");
      navMoblieContainer.classList.remove("nav-top-active");

      navText.forEach((el) => {
        el.classList.remove("text-black");
      });
    }


  };

  

  if (window.pageYOffset > 0) {
    navContainer.classList.add("nav-top-active");
    navMoblieContainer.classList.add("nav-top-active");

    // logofrontWhite.classList.add('active');
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


