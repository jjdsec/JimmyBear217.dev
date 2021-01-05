<?php
    session_start();
    header("Cache-Control: no-cache private");
    require_once(__DIR__ . "/assets/inc/settings.inc.php");
    require_once(__DIR__ . "/assets/inc/userList.inc.php");
    require_once(__DIR__ . "/assets/inc/checkLogin.inc.php");
    $status = "";
    if (!empty($_POST['username']) && !empty($_POST["password"]) && !empty($_POST['submit'])) {
        $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        if (isset($userList[$username])) {
            if (password_verify($_POST["password"], $userList[$username]["password"])) {
                $_SESSION["logged_in"] = true;
                $_SESSION["username"] = $username;
                session_commit();
                if (checkLogin()) {
                    $status = "success";
                } else {
                    $status = "errorSession " . json_encode($_SESSION);
                }
            } else {
                $status = "wrongPassword";
            }
        } else {
            $status = "unknownUser";
        }
    } else {
        $status = "noInput";
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>File Explorer - Login</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <style type="text/css">body {background-color: #ffe}body,table,form{margin:auto;text-align:center}h1{margin:10%;margin-bottom:1%}h2{margin:3% 10%}form{background-color:#fff;border:1px solid #000;padding:3%;width:max-content}input{margin:1em}</style>
        <link rel="manifest" href="manifest.json">
        <link rel="icon" href="assets/img/fileExplorer-72.png">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1>File Explorer</h1>
        <h2>Login</h2>

        <?php
        $writeForm=False;
        switch ($status) {
                
            default:
            case 'wrongPassword':
            case 'unknownUser':
                echo '<div class="alert">Something went wrong. Please try again.</div>';

            case 'noInput':
                $writeForm=True;
                break;

            case 'success':
                echo '<div class="alert">Your browser must support javascript for this service to work.</div>'
                 . '<script type="text/javascript">window.location.href = "explorer.html"</script>';
                $writeForm=False;
                break;
        }
        if ($status != "success" && isset($username) && $settings["logging"] = true)
                error_log("[fileExplorer] Unable to log in as $username: $status");
        
        if ($writeForm) {
            $form_username = "";
            $form_password = "";
            if (isset($settings["defaultUser"])) {
                if (!empty($settings["defaultUser"]["username"]))
                    $form_username = $settings["defaultUser"]["username"];
                    if (!empty($settings["defaultUser"]["password"]))
                    $form_password = $settings["defaultUser"]["password"];
            }
            if (isset($username)) {
                if ($form_username != $username) {
                    $form_username = $username;
                    $form_password = "";
                }
            }
            echo '<form method="POST" action="index.php">'
            . '<label for="username">Username</label>'
            . '<input name="username" placeholder="username" type="text" autocomplete="username" required value="' . $form_username . '">'
            . '<br><label for="password">Password</label>'
            . '<input name="password" placeholder="password" type="password" autocomplete="password" required value="' . $form_password . '">'
            . '<br><input type="submit" name="submit" value="Login">';
        }
        ?>
        </form>
    </body>
</html>