<?php

    /**
     * projects/descriptions
     * 
     * this feature is going to display a summary and description as well as potentially
     * some instructions and an icon and/or theme specific to the project in order
     * to give a better overview of what it is rather than letting the users discover it
     * for themselves.
     * 
     * @author JimmyBear217
     * @since 2021-01-11
     * 
     */

    // 1. gather input
    if (empty($_GET["repo"])) {
        header("Location: /projects", true, 302);
        die("Please specify a repository or use the /projects page to find one");
    }
    $project = filter_var($_GET["repo"], FILTER_SANITIZE_STRING);

    // 2. check input
    $repo = __DIR__ . "/../repo/" . $project;
    if (!file_exists($repo)) {
        header("Location: /projects", true, 302);
        die("this project cannot be found: $project");
    }

    // 3. read manifest
    $manifest = null;
    $manifest_file = $repo . "/project-manifest.json";
    if (file_exists($manifest_file)) {
        $manifest = json_decode(file_get_contents($manifest_file), true);
    } else {
        error_log("No manifest could be found for " . $project, 0);
        // set default texts
        $manifest = array(
            "name" => $project,
            "author" => "N/A",
            "description" => "Error: the manifest of this project could not be found",
            "long_description" => "Error: the manifest of this project could not be found"
        );
    }

    // 4. write page head
    $PAGE_TITLE = $manifest["name"] . " - JimmyBear217.dev";
    require_once(__DIR__ . "/../../assets/inc/header.inc.php");

    // 5. write the page
    echo "<header><h1>" . $manifest["name"] . "</h1><p>" . $manifest["description"] . "</p></header>";
    echo "<section><h2>Description</h2><p>"
        . (isset($manifest["long_description"]) ? $manifest["long_description"] : $manifest["description"] . "<br>A project by " . $manifest["author"])
        . "</p><ul class=\"icons-horizontal\">";
        foreach(array("author", "published") as $key) {
            if (isset($manifest[$key]))
                echo "<li class=\"noHover capitalize\">" . $key . ": " . $manifest[$key] . "</li>";
        }
    echo "</ul><article><h2>Links</h2><ul class=\"icons-horizontal loading\" id='project-links'></ul></article>";
    echo "<script src=\"/assets/js/project-links.js\" type=\"text/javascript\" async></script>";
    if (isset($manifest["readme"])) {
        echo "<article><h2>README</h2><pre class=\"markdownFile loading\" data-src=\"" . $manifest["readme"] . "\"></pre></article>";
        echo "<script src=\"/assets/js/markDownReader.js\" type=\"text/javascript\" async></script>";
    }
    echo "</section>";

    // 6. write page footer
    require_once(__DIR__ . "/../../assets/inc/footer.inc.php");
?>