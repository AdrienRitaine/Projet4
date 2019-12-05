        // MENU

        var prevScrollpos = window.pageYOffset;
        window.onscroll = function() {
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

        menuOpen.addEventListener("click", function(e) {
            menu.style.display = "block";


        });

        menuClose.addEventListener("click", function() {
            menu.style.display = "none";
            menu.style.transition = "0.5s";
        });

        // FORMULAIRE DE CONNEXION

        var login = document.getElementById("loginForm");
        var inscrire = document.getElementById("signinForm");
        document.getElementById('connexion').addEventListener("click", function(e) {
            login.style.display = "block";
            inscrire.style.display = "none";
            this.style.opacity = "1";
            document.getElementById("inscrire").style.opacity = "0.5";

        });
        document.getElementById('inscrire').addEventListener("click", function(e) {
            login.style.display = "none";
            inscrire.style.display = "block";
            this.style.opacity = "1";
            document.getElementById("connexion").style.opacity = "0.5";
        });