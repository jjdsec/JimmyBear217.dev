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
    if (!file_exists(__DIR__ . "/../repo/" . $project)) {
        header("Location: /projects", true, 302);
        die("this project cannot be found: $project");
    }

    // 3. read manifest
    $manifest = "{}";
    if (file_exists(__DIR__ . "/../repo/project-manifest.json")) {
        $manifest = file_get_contents(__DIR__ . "/../repo/project-manifest.json");
    } else {
        error_log("No manifest could be found for " . $project, 0);
        // set default texts
        $manifest["name"] = $project;
    }
    $manifest = json_decode($manifest, true);

    // 4. write page header
    $PAGE_TITLE = $manifest["name"] . " - JimmyBear217.dev";
    $PAGE_HEADER_TITLE = $manifest["name"];
    require_once(__DIR__ . "/../../assets/inc/header.inc.php");
?>