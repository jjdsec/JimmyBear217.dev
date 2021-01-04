<?php
    header("Cache-Control: no-cache ");

    if (isset($_POST["username"])){
        $username = $_POST["username"];
    }else{
        http_response_code(401);
        header("Location: login_error.html");
        include("login_error.html");
        die("Error");
        setcookie("explorer_access","no",time()+60*30,realpath($_SERVER["PHP_SELF"]),$_SERVER["SERVER_NAME"],false,false);
    }

    if (isset($_POST["password"])){
        $password = md5($_POST["password"]);
    }else{
        http_response_code(401);
        header("Location: login_error.html");
        include("login_error.html");
        setcookie("explorer_access","no",time()+60*30,realpath($_SERVER["PHP_SELF"]),$_SERVER["SERVER_NAME"],false,false);
        die("Error");
    }

    if (isset($_POST["submit"])){
        if ($_POST["submit"] == "Login"){

            $users = array(
                "JimmyBear217" => "bfaf8e04f35b2bc33cf8fb03d9377964"
            );

            if ($password == $users[$username]){
                http_response_code(202);
                //setcookie("username",$_POST["username"],time()+60+60);
                //setcookie("key","fsdkjfhdk",time()+60+60);
                header("Location: login_success.html");
                include("login_success.html");
                setcookie("explorer_access",base64_encode((date("Y") + date("m") + date("d")) . "fsdkjfhdk" . $_POST["username"]),time()+60*60*6,realpath($_SERVER["PHP_SELF"]),$_SERVER["SERVER_NAME"],false,false);
                setcookie("explorer_username",$username,time()+60*60*6,realpath($_SERVER["PHP_SELF"]),$_SERVER["SERVER_NAME"],false,false);
            }else{
                http_response_code(401);
                header("Location: login_error.html");
                include("login_error.html");
                setcookie("explorer_access","no",time()+60*30,realpath($_SERVER["PHP_SELF"]),$_SERVER["SERVER_NAME"],false,false);
                die("Wrong login or password");
            }


        }elseif ($_POST["submit"] == "Register") {


            http_response_code(401);
            header("Location: login_error.html");
            include("login_error.html");
            setcookie("explorer_access","no",time()+60*30,realpath($_SERVER["PHP_SELF"]),$_SERVER["SERVER_NAME"],false,false);
            die("Sorry, No more registrations.");
            
            http_response_code(201);
            //setcookie("username",$_POST["username"],time()+60+60);
            //setcookie("key","fsdkjfhdk",time()+60+60);
            header("Location: login_success.html");
            include("login_success.html");
            setcookie("explorer_access",base64_encode((date("Y") + date("m") + date("d")) . "fsdkjfhdk" . $_POST["username"]),time()+60*60*6,realpath($_SERVER["PHP_SELF"]),$_SERVER["SERVER_NAME"],false,false);
            setcookie("explorer_username",$username,time()+60*60*6,realpath($_SERVER["PHP_SELF"]),$_SERVER["SERVER_NAME"],false,false);


        }else{
            http_response_code(401);
            header("Location: login_error.html");
            include("login_error.html");
            setcookie("explorer_access","no",time()+60*30,realpath($_SERVER["PHP_SELF"]),$_SERVER["SERVER_NAME"],false,false);
            die("Error");
        }
    }else{
        http_response_code(401);
        header("Location: /login_error.html");
        include("login_error.html");
        setcookie("explorer_access","no",time()+60*30,realpath($_SERVER["PHP_SELF"]),$_SERVER["SERVER_NAME"],false,false);
        die("Error");
    }
?>