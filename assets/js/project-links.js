function loadLinks() {
    repo = "/projects/repo";
    project = document.getElementsById("project-links").getAttribute("data-project");
    manifest = repo + "/" + project + "/project-manifest.json";

    fetch(manifest)
        .then(response => {
            if (response.status == 200) {
                return response.json();
            } else {
                return {
                    links: []
                };
            }
        })
        .then(responseJson => {
            responseJson.links.forEach((link) => {
                var li = document.createElement("li");
                switch (link.type) {
                    case "start":
                        var a = document.createElement("a");
                        a.setAttribute("href", "/projects/" + repo + "/" + project.dir + "/" + link.value);
                        a.setAttribute("title", "Open " + project.name);
                        a.setAttribute("target", "_blank");
                        var img = document.createElement("img");
                        img.setAttribute("src", "/assets/img/open-in-browser.svg");
                        img.setAttribute("height", "24");
                        img.setAttribute("width", "24");
                        img.setAttribute("alt", "Launch");
                        a.appendChild(img);
                        li.appendChild(a);
                        break;

                    case "github":
                        var a = document.createElement("a");
                        a.setAttribute("href", link.value);
                        a.setAttribute("title", "See " + project.name + " on github");
                        a.setAttribute("target", "_blank");
                        var img = document.createElement("img");
                        img.setAttribute("src", "/assets/img/github1600.png");
                        img.setAttribute("height", "24");
                        img.setAttribute("width", "24");
                        img.setAttribute("alt", "GitHub");
                        a.appendChild(img);
                        li.appendChild(a);
                        break;

                    case "web":
                        var a = document.createElement("a");
                        a.setAttribute("href", link.value);
                        a.setAttribute("title", "Visit the website for " + project.name);
                        a.setAttribute("target", "_blank");
                        var img = document.createElement("img");
                        img.setAttribute("src", "/assets/img/world-wide-web.svg");
                        img.setAttribute("height", "24");
                        img.setAttribute("width", "24");
                        img.setAttribute("alt", "Website");
                        a.appendChild(img);
                        li.appendChild(a);
                        break;
                }
                document.getElementById("project-links").appendChild(li);
                if (document.getElementById("project-links").classList.contains("loading"))
                    document.getElementById("project-links").classList.remove("loading");
            });
        })
}
loadLinks();








// # project-links