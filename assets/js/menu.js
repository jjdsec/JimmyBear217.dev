function setCurrentMenuItem() {

    // 1. load components
    var nav = document.getElementById("top-nav");
    var url = document.location.pathname;
    var page = false;
    var newlink = "/";
    var title = document.getElementsByTagName("title")[0].innerText;
    var state = {};

    // 2. interpret url
    switch (url) {
        case "/":
        case "/index.php":
            page = "home";
            newlink = "/";
            break;

        case "/projects":
        case "/projects/":
        case "/projects/index.php":
            page = "projects";
            newlink = "/projects";
            break;

        case "/contact":
        case "/contact/":
        case "/contact/index.php":
            page = "contact";
            newlink = "/contact";
            break;

        default:
            page = "";
            newlink = "/"
            break;
    }

    // 3. apply result
    Array.from(nav.getElementsByTagName("a")).map((elem) => {
        if (elem.hasAttribute("data-pagename")) {
            if (elem.getAttribute("data-pagename") == page) {
                elem.classList.add("current");
            } else {
                if (elem.classList.contains("current"))
                    elem.classList.remove("current");
            }
        }
    });

    // 4. update history
    newlink = document.location.protocol + "//" + document.location.host + newlink;
    window.history.replaceState(state, title, newlink)

}

setCurrentMenuItem();

function toggleMenu(force = "") {
    if (force != "") {
        if (force == "open") {
            if (document.getElementById("top-nav").classList.contains("menu-showing")) {
                document.getElementById("top-nav").classList.remove("menu-showing");
            }
        } else if (force == "close") {
            if (!document.getElementById("top-nav").classList.contains("menu-showing")) {
                document.getElementById("top-nav").classList.remove("menu-showing");
            }
        }
    } else {
        if (document.getElementById("top-nav").classList.contains("menu-showing")) {
            document.getElementById("top-nav").classList.remove("menu-showing");
        } else {
            document.getElementById("top-nav").classList.add("menu-showing");
        }
    }
}