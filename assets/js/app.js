// MENU

var prevScrollpos = window.pageYOffset;
window.onscroll = function () {
    var currentScrollPos = window.pageYOffset;
    if (prevScrollpos > currentScrollPos) {
        document.getElementById("nav").style.top = "0";
    } else {
        document.getElementById("nav").style.top = "-160px";
    }
    prevScrollpos = currentScrollPos;
}

var menu = document.getElementById("menu_lien");
var menuOpen = document.getElementById("menu_resp");
var menuClose = document.getElementById("menu_resp_close");

menuOpen.addEventListener("click", function (e) {
    menu.style.display = "block";


});

menuClose.addEventListener("click", function () {
    menu.style.display = "none";
    menu.style.transition = "0.5s";
});
