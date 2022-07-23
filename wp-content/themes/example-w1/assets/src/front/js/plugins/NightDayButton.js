
function setCookie(cvalue) {
  var d = new Date();
  d.setTime(d.getTime() + 30 * 24 * 60 * 60 * 1000);
  var expires = "expires=" + d.toUTCString();
  document.cookie = "theme=" + cvalue + ";" + expires + "; path=/";
}

function getCookie(theme) {
  var name = theme + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(";");
  for (var i = 0; i < ca.length; i++) {
    var c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1); 
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function checkCookie() {
  var theme = getCookie("theme");
  if (theme == "default") {
    body.className = "";
  }
  if (theme == "dark") {
    body.className = "dark";
  }
} 
// Gettings
var theme = window.localStorage.getItem("theme");
// Setting
window.localStorage.setItem("theme", "dark");
const buttonColor = document.querySelector(".color-icon");
const buttonColorMobile = document.querySelector(".color-icon-mobile");
const buttonColors = document.querySelectorAll(".color-icon");

var body = document.querySelector(":root");

checkCookie();

// night day button desktop && mobile
if (body.classList.contains("dark")) {
  buttonColors.forEach((el) => {
    el.classList.add("color-night");
  });
} else {
  buttonColors.forEach((el) => {
    el.classList.remove("color-night");
  });
}
window.addEventListener("resize", function() {
  if (body.classList.contains("dark")) {
    buttonColors.forEach((el) => {
      el.classList.add("color-night");
    });
  } else {
    buttonColors.forEach((el) => {
      el.classList.remove("color-night");
    });
  }
});

buttonColors.forEach((el) => {
  el.addEventListener("click", function() {
    if (el.classList.contains("color-night")) {
      el.classList.remove("color-night");
      body.className = "";
      setCookie("default");
    } else {
      el.classList.add("color-night");
      body.className = "";
      body.classList.add("dark");
      setCookie("dark");
    }
  });
});
////////front-page
const logofrontDay = document.querySelector(".front-page-logo-day");
const logofrontDark = document.querySelector(".front-page-logo-night");

var body = document.querySelector(":root");

let state = false

if(logofrontDay || logofrontDark){

  if(body.classList.contains('dark')){
    state = true
  }else{
    state = false
  }
  
  if(state == true){
    logofrontDark.classList.add('logo-active')
    logofrontDay.classList.remove('logo-active')
  }else{
    logofrontDark.classList.remove('logo-active')
    logofrontDay.classList.add('logo-active')
  }
  
  buttonColors.forEach((el) => {
    el.addEventListener("click", function() {
      if (el.classList.contains("color-night")) {
        logofrontDark.classList.add('logo-active')
        logofrontDay.classList.remove('logo-active')
      } else {
        logofrontDark.classList.remove('logo-active')
        logofrontDay.classList.add('logo-active')
      }
    });
  });    
}

////no front page 
const darkLogoRestPage = document.querySelector('.dark-logo-rest-page')
const whiteLogoRestPage = document.querySelector('.white-logo-rest-page')


if(!logofrontDay || !logofrontDark){

  if(body.classList.contains('dark')){
    darkLogoRestPage.classList.remove('logo-active')
    whiteLogoRestPage.classList.add('logo-active')
  }else{
    darkLogoRestPage.classList.add('logo-active')
    whiteLogoRestPage.classList.remove('logo-active')
  }
  buttonColors.forEach((el) => {
    el.addEventListener("click", function() {
      if (el.classList.contains("color-night")) {
        whiteLogoRestPage.classList.add('logo-active')
        darkLogoRestPage.classList.remove('logo-active')
      } else {
        darkLogoRestPage.classList.add('logo-active')
        whiteLogoRestPage.classList.remove('logo-active')
      }
    });
  }); 
   
}