<?php

    if (isset($_GET["path"])){
        $path = $_GET["path"];
    }else{
        die("Missing Path");
    }

    if (isset($_COOKIE["explorer_access"]) && isset($_COOKIE["explorer_username"])){
        $token = $_COOKIE["explorer_access"];
        $correct = base64_encode((date("Y") + date("m") + date("d")) . "fsdkjfhdk" . $_COOKIE["explorer_username"]);

        if ($token != $correct){
            die("Wrong token");
        }
    }else{
        die("Missing token");
    }

    $mime = mime_content_type($path);
    header("Content-Type: " . $mime);
    //var_dump(pathinfo($path));
    echo file_get_contents($path);

?>