<?php

    header("Content-Type: application/json", true, 200);

    $projectOutput = array();
    $repo = __DIR__ . "/../repo";
    $dirs = scandir($repo);
    foreach($dirs as $folder) {
        if (str_replace(".", "", $folder) == "")
            continue;
        if (file_exists($repo . "/" . $folder . "/project-manifest.json")) {
            $manifest = json_decode(file_get_contents($repo . "/" . $folder . "/project-manifest.json"), true);
            $project = array(
                "name" => $manifest["name"],
                "description" => $manifest["description"],
                "icon" => $manifest["icon"],
                "featured" => (isset($manifest["featured"]) ? boolval($manifest["featured"]) : false),
                "dir" => $folder,
                "links" => $manifest["links"]
            );
            array_push($projectOutput, $project);
        }
    }


    echo json_encode($projectOutput);


?>