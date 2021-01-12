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
            "longdescription"
        );
    }

    // 4. write page head
    $PAGE_TITLE = $manifest["name"] . " - JimmyBear217.dev";
    require_once(__DIR__ . "/../../assets/inc/header.inc.php");

    // write the page
    echo "<header><h1>" . $manifest["name"] . "</h1><p>" . $manifest["description"] . "</p></header>";
    //<p>A project by " . $manifest["author"] . "</p>
?>
    <section>
        <h2>Description</h2>
        <p>Consequat excepteur anim Lorem duis nostrud irure. Nostrud ut ut excepteur reprehenderit ullamco duis esse dolor esse laborum. Ad qui nisi id laborum adipisicing labore ex excepteur incididunt proident. Laborum deserunt ut aute deserunt do. Incididunt ea sint consequat tempor laborum reprehenderit sint.</p>
        <ul class="icons-horizontal">
            <li class="noHover">Auhtor: JimmyBear217</li>
            <li class="noHover">Published: 2021-01-11</li>
        </ul>
        <article>
            <h2>Links</h2>
            <ul class="icons-horizontal">
                <li>start</li>
                <li>github</li>
            </ul>
        </article>
        <article>
            <h2>README</h2>
            <p>this is a markdown text</p>
        </article>
    </section>