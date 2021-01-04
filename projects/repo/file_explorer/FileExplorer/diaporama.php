<?php

    if (isset($_GET["path"])){
        $path = $_GET["path"];
    }else{
        $path = ".";
    }

    /*
    if (isset($_GET["token"])){
        $token = $_GET["token"];

        // verify token
        //...

        if ($token != $correct){
            die("Wrong token");
        }
    }else{
        die("Missing token");
    }*/

    // Redirect to the next picture: 
    // header("Refresh:0; url=page2.php");


    if (is_dir($path)){
        echo '<!DOCTYPE HTML><html><head><title>File Explorer - PHP</title><meta name="viewport" content="width=device-width, initial-scale=1"></head><body><h1>Content of ' . $path . '</h1>';

        $dir    = $path;
        $files1 = scandir($dir);

        echo "<ul>";
        foreach ($files1 as $name) {
            echo "<li>";
            echo "<a href='" . $_SERVER["PHP_SELF"] . "?path=" . $path . "/" . $name . "'>" . $name . "</a>";
            if (is_dir($path . "/" . $name)){
                echo "/";
            }
            echo "</li>";
        }
        echo "</ul>";

        echo '</body></html>';
    
    }else{

        $mime = mime_content_type($path);
        //switch()
        header("Content-Type: " . $mime);
        echo file_get_contents($path);
    }
?>