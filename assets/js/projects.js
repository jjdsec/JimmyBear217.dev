function addFeaturedProject(project) {
    /*
    <li><a href="https://github.com/jimmybear217" target="_blank" title="Open my Github Profile"><img src="/assets/img/github1600.png" height="72" width="72" alt="GitHub"></a></li>
    <li><a href="/projects" title="Open my Project Portfolio"><img src="/assets/img/projects.svg" height="72" width="72" alt="Projects"></a></li>
    */
    return false;
}

function addProject(project) {
    // table

    return false
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
            responseJson.forEach((project) => {
                if (project.featured == true)
                    addFeaturedProject(project);
                else
                    addFeaturedProject(project);
            })
        })
}