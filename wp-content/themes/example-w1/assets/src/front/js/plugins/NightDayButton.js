export default function(){
  
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

}
