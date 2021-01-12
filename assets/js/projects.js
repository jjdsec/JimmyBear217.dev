function addFeaturedProject(project) {
    /*
    <li><a href="https://github.com/jimmybear217" target="_blank" title="Open my Github Profile"><img src="/assets/img/github1600.png" height="72" width="72" alt="GitHub"></a></li>
    <li><a href="/projects" title="Open my Project Portfolio"><img src="/assets/img/projects.svg" height="72" width="72" alt="Projects"></a></li>
    */
    repo = "repo"
    var li = document.createElement("li");
    var a = document.createElement("a");
    project.links.forEach((link) => { if (link.type == "start") a.setAttribute("href", "/projects/" + repo + "/" + project.dir + "/" + link.value); })
    a.setAttribute("title", "Open " + project.name);
    a.setAttribute("target", "_blank");
    li.appendChild(a);
    var img = document.createElement("img");
    img.setAttribute("src", "/projects/" + repo + "/" + project.dir + "/" + project.icon);
    img.setAttribute("height", "72");
    img.setAttribute("width", "72");
    img.setAttribute("alt", project.name);
    a.appendChild(img);
    document.getElementById("featuredProjects").appendChild(li);
    if (document.getElementById("featuredProjects").classList.contains("loading"))
        document.getElementById("featuredProjects").classList.remove("loading");
    return li;
}

function addProject(project) {
    repo = "repo";
    var tr = document.createElement("tr");
    var td = document.createElement("td");
    var logo = document.createElement("img");
    logo.setAttribute("src", "/projects/" + repo + "/" + project.dir + "/" + project.icon);
    logo.setAttribute("height", "32");
    logo.setAttribute("width", "32");
    td.appendChild(logo);
    td.className = "projectList-logo";
    tr.appendChild(td);

    td = document.createElement("td");
    var a = document.createElement("a");
    a.appendChild(document.createTextNode(project.name));
    project.links.forEach((link) => { if (link.type == "start") a.setAttribute("href", "/projects/" + repo + "/" + project.dir + "/" + link.value); })
    a.setAttribute("title", "Open " + project.name);
    a.setAttribute("target", "_blank");
    td.appendChild(a);
    td.className = "projectList-name";
    tr.appendChild(td);

    td = document.createElement("td");
    if (project.description.length > 64) {
        td.appendChild(document.createTextNode(project.description.substr(0, 64) + "..."));
    } else {
        td.appendChild(document.createTextNode(project.description));
    }
    td.className = "projectList-description";
    tr.appendChild(td);

    td = document.createElement("td");
    project.links.forEach((link) => {
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
                td.appendChild(a);
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
                td.appendChild(a);
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
                td.appendChild(a);
                break;
        }
    })

    // add description link
    var a = document.createElement("a");
    a.setAttribute("href", "/projects/description/?repo=" + project.dir);
    a.setAttribute("title", "View description " + project.name);
    var img = document.createElement("img");
    img.setAttribute("src", "/assets/img/hastag.svg");
    img.setAttribute("height", "24");
    img.setAttribute("width", "24");
    img.setAttribute("alt", "Description");
    a.appendChild(img);
    td.appendChild(a);
    td.className = "projectList-Links";
    tr.appendChild(td);

    document.getElementById("allProjects").appendChild(tr);
    if (document.getElementById("allProjects").classList.contains("loading"))
        document.getElementById("allProjects").classList.remove("loading");
    return tr;
}

function showDefaults(which = 'BOTH') {
    if (which == "ALL" || which == "BOTH") {
        // see all projects view
        var tr = document.createElement("tr");
        var td = document.createElement("td");
        tr.appendChild(td);
        td = document.createElement("td");
        td.appendChild(document.createTextNode("No matching project found."));
        tr.appendChild(td)
        document.getElementById("allProjects").appendChild(tr);
        if (document.getElementById("allProjects").classList.contains("loading"))
            document.getElementById("allProjects").classList.remove("loading");
    }
    if (which == "FEATURED" || which == "BOTH") {
        // featured projects view
        var li = document.createElement("li");
        li.classList.add("noHover")
        var a = document.createElement("a");
        a.appendChild(document.createTextNode("No featured project found."));
        li.appendChild(a);
        document.getElementById("featuredProjects").appendChild(li);
        if (document.getElementById("featuredProjects").classList.contains("loading"))
            document.getElementById("featuredProjects").classList.remove("loading");
    }
}

function loadProjects() {
    fetch("/projects/api/listProjects.php")
        .then((response) => {
            if (response.status == 200) {
                return response.json();
            } else {
                console.error("loadProjects returned an unexpected status:", response.status, response.statusText);
                return [];
            }
        })
        .then((responseJson) => {
            var countA = 0;
            var countF = 0;
            responseJson.forEach((project) => {
                if (project.featured == true) {
                    countF++
                    addFeaturedProject(project);
                }
                countA++
                addProject(project);
            });
            if (countA == 0)
                showDefaults("BOTH");
            else if (countF == 0)
                showDefaults("FEATURED");
        })
}

loadProjects();