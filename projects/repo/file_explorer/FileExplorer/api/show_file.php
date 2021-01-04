<?php

    if (isset($_GET["path"])){
        $path = $_GET["path"];
    }else{
        die("Missing Path");
    }

    if (isset($_COOKIE["explorer_access"]) && isset($_COOKIE["explorer_username"])){
        $token = $_COOKIE["explorer_access"];
        $correct = base64_encode((date("Y", time()) + date("m", time()) + date("d", time())) . "fsdkjfhdk" . $_COOKIE["explorer_username"]);

        if ($token != $correct){
            die("Wrong token");
        }
    }else{
        die("Missing token");
    }

    if (substr($path, 0, strlen($chroot)) != $chroot && $username == $_COOKIE["explorer_username"]) {
        header("Content-Type: text/json", true, 403);
        die(json_encode(array("status" => "error","message" => "this user cannot access this directory")));
    }

    $mime = mime_content_type($path);
    header("Content-Type: " . $mime);
    //var_dump(pathinfo($path));
    echo file_get_contents($path);

?>