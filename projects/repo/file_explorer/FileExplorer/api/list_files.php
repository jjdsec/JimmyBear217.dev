<?php

    session_start();
    require_once(__DIR__ . "/../assets/inc/userList.inc.php");
    require_once(__DIR__ . "/../assets/inc/checkLogin.inc.php");

    if (!checkLogin()) {
        header('WWW-Authenticate: OAuth realm="Access to fileExplorer"', true, 401);
        header("Content-Type: text/plain", true);
        die("invalid login");
    }


    if (isset($_GET["path"])){
        $path = $_GET["path"];
    }else{
        header("Content-Type: text/plain", true, 400);
        die("Missing Path");
    }

    $token = "token";
    $path = realpath($path);
    $chroot = $userList[$_SESSION["username"]]["chroot"];
    if (substr($path, 0, strlen($chroot)) != $chroot) {
        header("Content-Type: text/plain", true, 403);
        die("Sorry, you cannot access this ressource");
    }

    if (is_dir($path)){

        $dir    = $path;
        $files1 = scandir($dir);

        $dirs = array();
        $files = array();
        $exclusions = array(".");

        foreach ($files1 as $name) {
            if (!in_array($name, $exclusions)){
                $node = array("path" => realpath($path . "/" . $name), "name" => $name);
                if (is_dir($path . "/" . $name)) {
                    array_push($dirs, $node);
                } else {
                    array_push($files, $node);
                }
            }
        }

        $final = array(
            "files" => array(),
            "local" => array(
                "path" => realpath($path),
                "basename" => basename($path)
            )
        );
        foreach ($dirs as $line) {
            array_push($final["files"], array(
                "type" => "dir",
                "path" => $line["path"],
                "name" => $line["name"]
            ));
        }
        foreach ($files as $line) {
            array_push($final["files"], array(
                "type" => "file",
                "path" => $line["path"],
                "name" => $line["name"],
                "mime" => mime_content_type($path)
            ));
        }

        header("Content-Type: text/json", true, 200);
        echo json_encode($final);
    
    }else{
        header("Content-Type: text/plain", true, 418);
        die("Not a direcrory");
    }
?>
