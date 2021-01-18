Array.from(document.getElementsByClassName("markdownFile")).forEach((md) => {
    var readme = "";
    if (md.hasAttribute("data-src") && md.hasAttribute('data-project')) {
        readme = "project/repo/" + md.getAttribute('data-project') + "/" + md.getAttribute("data-src");
    }
    if (readme.length > 0) {
        md.innerHTML = marked(readme);
    }
});