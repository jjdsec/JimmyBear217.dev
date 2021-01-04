<?php

    if (isset($_GET["path"])){
        $path = $_GET["path"];
    }else{
        die("Missing Path");
    }

    if (isset($_GET["token"])){
        $token = explode(":",$_GET["token"]);
        $username = $token["0"];
        $token = $token["1"];

        $correct = base64_encode((date("Y") + date("m") + date("d")) . "fsdkjfhdk" . $username);
        
        if ($token != $correct){
            die("Wrong token");
        }
    }else{
        die("Missing token");
    }

    $token = "token";
    $path = realpath($path);
    header("Content-Type: text/json");

    if (is_dir($path)){

        $dir    = $path;
        $files1 = scandir($dir);

        $dirs = array();
        $files = array();

        foreach ($files1 as $name) {
            if ($name != ".." AND $name != "."){
                //echo "<a href='list_files.php?path=" . $path . "/" . $name . "'>" . $name . "</a>";
                if (is_dir($path . "/" . $name)){
                    array_push($dirs,array("path" => $path . "/" . $name, "name" => $name));
                }else{
                    array_push($files,array("path" => $path . "/" . $name, "name" => $name));
                }
            }
        }

        $final = '{"files":[{"type":"dir","path":"' . $path . '/..","name": ".."}';
        foreach ($dirs as $line) {
            $final .= ',{"type":"dir","path":"' . htmlentities($line["path"]) . '","name":"' . $line["name"] . '"}';
        }
        foreach ($files as $line) {
            $final .= ',{"type":"file","path":"' . htmlentities($line["path"]) . '","name":"' . $line["name"] . '"}';
        }
        $final .= '],';
        $final .= '"local": {"path": "' . $path . '","basename": "' . basename($path) . '"}';
        $final .= '}';

        echo $final;
    
    }else{
        $final = '{"files":[{"type":"dir","path":"' . $path . '/..","name": ".."}';
        $final .= ',{"type":"file","path":"' . dirname($path) . '/' . basename($path) . '","name":"' . basename($path) . '"}';
        $final .= '],';
        if (basename($path) == ""){
            $final .= '"local": {"path": "' . $path . '","basename": "/"}';
        }else{
            $final .= '"local": {"path": "' . $path . '","basename": "' . basename($path) . '"}';
        }
        $final .= '}';

        header("Content-Type: text/json");
        echo $final;
    }
?>