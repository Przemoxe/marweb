const navContainer = document.querySelector(".nav-top");
const navMoblieContainer = document.querySelector(".nav-top-mobile");
const darkLogo = document.querySelector(".dark-logo");
const whiteLogo = document.querySelector(".white-logo");
const mobileDarkLogo = document.querySelector(".mobile-dark-logo");
const mobileWhiteLogo = document.querySelector(".mobile-white-logo");

let navText = document.querySelectorAll(".menu-item a");


  window.onscroll = function () {
    // pageYOffset or scrollY

    if (window.pageYOffset > 0) {
      if(darkLogo || whiteLogo){
        darkLogo.classList.remove('logo-active')
        whiteLogo.classList.add('logo-active')

      }
      if(mobileDarkLogo){
        mobileDarkLogo.classList.remove('logo-active')
        mobileWhiteLogo.classList.add('logo-active')
      }
      navContainer.classList.add("nav-top-active");
      navMoblieContainer.classList.add("nav-top-active");

      // logofrontWhite.classList.add('active');
      navText.forEach((el) => {
        el.classList.add("text-black");
      });
    } else {
      if(darkLogo || whiteLogo){
        darkLogo.classList.add('logo-active')
        whiteLogo.classList.remove('logo-active')
      }
      if(mobileWhiteLogo){
        mobileDarkLogo.classList.add('logo-active')
        mobileWhiteLogo.classList.remove('logo-active')
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
  
    var body = document.querySelector(":root");
    if(!body.classList.contains('dark')){
      const darkLogo = document.querySelector(".dark-logo");
      const whiteLogo = document.querySelector(".white-logo")
      const mobileDarkLogo = document.querySelector(".mobile-dark-logo");
      const mobileWhiteLogo = document.querySelector(".mobile-white-logo");
      if(darkLogo || whiteLogo){
        darkLogo.classList.remove('logo-active')
        whiteLogo.classList.add('logo-active')
      }
      if(mobileDarkLogo || mobileWhiteLogo){
        mobileDarkLogo.classList.remove('logo-active')
        mobileWhiteLogo.classList.add('logo-active')
      }
    }

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

