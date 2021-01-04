<?php

    header("Content-Type: application/json", true, 200);
    echo json_encode(array(
        array(
            "name" => "project A",
            "icon" => "",
            "featured" => true,
            "description" => "blah blah blah",
            "dir" => "project_a",
            "links" => array(
                array(
                    "type" => "start",
                    "value" => "index.html"
                ),
                array(
                    "type" => "github",
                    "value" => "https://github.com/jimmybear217/jimmybear217.dev"
                )
            )
        ),
        array(
            "name" => "project B",
            "icon" => "",
            "featured" => true,
            "description" => "blah blah blah",
            "dir" => "project_b",
            "links" => array(
                array(
                    "type" => "start",
                    "value" => "index.html"
                ),
                array(
                    "type" => "github",
                    "value" => "https://github.com/jimmybear217/jimmybear217.dev"
                )
            )
        )
    ));

    /**
     * @todo list the contents of each folder in the project repository to read
     * the mamifest of each and dynamically generate this list
     */

?>