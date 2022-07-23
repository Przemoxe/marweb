

  window.onscroll = function () {
    // pageYOffset or scrollY
    const navContainer = document.querySelector(".nav-top");
    const navMoblieContainer = document.querySelector(".nav-top-mobile");
    const logofrontDark = document.querySelector(".logo-front-dark");
    const logofrontWhite = document.querySelector(".logo-front-white");

    let navText = document.querySelectorAll(".menu-item a");
  
    if (window.pageYOffset > 0) {

      logofrontDark.classList.remove("logo-front-active");
      logofrontWhite.classList.add("logo-front-active");
      
      navContainer.classList.add("nav-top-active");
      navMoblieContainer.classList.add("nav-top-active");

      // logofrontWhite.classList.add('active');
      navText.forEach((el) => {
        el.classList.add("text-black");
      });
    } else {
      logofrontDark.classList.add("logo-front-active");
      logofrontWhite.classList.remove("logo-front-active");

      navContainer.classList.remove("nav-top-active");
      navMoblieContainer.classList.remove("nav-top-active");

      navText.forEach((el) => {
        el.classList.remove("text-black");
      });
    }
  };

