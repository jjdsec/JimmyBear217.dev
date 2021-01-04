function setCurrentMenuItem() {

    // 1. load components
    var nav = document.getElementById("top-nav");
    var url = document.location.pathname;
    url = url.replace("index.html", "");
    url = url.replace("index.php", "");
    url = url.replace(".html", "");
    url = url.replace(".php", "");
    url = url.replace("/", "");
    var page = false;
    var newlink = "/";
    var title = document.getElementsByTagName("title")[0].innerText;
    var state = {};

    // 2. interpret url
    switch (url) {
        case "":
            page = "home";
            newlink = "/";
            break;

        case "projects":
            page = "projects";
            newlink = "/projects";
            break;

        case "contact":
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