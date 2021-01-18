Array.from(document.getElementsByClassName("markdownFile")).forEach((md) => {
    var readme = "";
    if (md.hasAttribute("data-src") && md.hasAttribute('data-project')) {
        readme = "/projects/repo/" + md.getAttribute('data-project') + "/" + md.getAttribute("data-src");
    }
    console.log("Readme:", readme);
    if (readme.length > 0) {
        fetch(readme)
            .then(response => { return response.text(); })
            .then(responseText => {
                md.innerHTML = marked(responseText);
            })

        // add markdown.css stylesheet
        // https://www.cssscript.com/replicate-github-markdown-style/
        // <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/@sukka/markdown.css">
        var stylesheet = document.createElement("link");
        stylesheet.setAttribute("rel", "stylesheet");
        stylesheet.setAttribute("href", "//cdn.jsdelivr.net/npm/@sukka/markdown.css");
        document.head.appendChild(stylesheet);
        if (!md.classList.contains("markdown-body")) {
            md.classList.add("markdown-body")
            md.style.textAlign = "left";
            md.style.maxWidth = "800px";
            md.style.margin = "auto";
        }
    } else {
        md.innerText = "No readme file found";
    }
    if (md.classList.contains("loading"))
        md.classList.remove("loading");
});