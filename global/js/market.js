window.onscroll = function() {myFunction()};
var navbar = document.getElementById("navbar");
var iklan = document.getElementById("iklan");
var sticky = navbar.offsetTop+60;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    console.log(window.pageYOffset);
    navbar.style.position="fixed";
    iklan.style.marginTop="60px";
  }else {
    navbar.style.position="relative";
    iklan.style.marginTop="0";
  }
}

let buttonside = document.getElementById("button-side"); 
let sidenavv = document.getElementById("sidenav"); 
let sidenavvv = document.getElementById("sidenav-luar"); 
let img_side = document.getElementById("img-side"); 
let span1 = document.getElementById("span1"); 
let span2 = document.getElementById("span2"); 
let i=0;
let j;
function sidenav(){
  // span
  img_side.style.transform=" scale(0)";
  span1.style.transform="rotate(-45deg) scale(1)";
  span2.style.transform="rotate(45deg) scale(1)";
  // nav
  buttonside.style.overflow="visible";
  sidenavv.style.animation="in-nav 1.5s forwards";
  sidenavv.style.display="block";
  sidenavvv.style.display="block";
  i++
  j=i%2;
  if(j == 0){
    // span
    img_side.style.transform=" scale(1)";
    span1.style.transform="rotate(-45deg) scale(0)";
    span2.style.transform="rotate(45deg) scale(0)";
    // nav
    sidenavv.style.animation="out-nav 1.5s forwards";
    buttonside.style.overflow="hidden";
  }
}

