<?php

    /**
     * checkLogin.inc.php
     * 
     * checks the current login of the user
     * @uses /assets/inc/userList.inc.php
     */
    if (!session_status())
        session_start();

    function checkLogin() {
        global $userList;
        if ($_SESSION["logged_in"] == true && isset($userList[$_SESSION["username"]])) {
            return true;
        } else {
            /*error_log("checkLogin failed: " . json_encode(array(
                "logged_in" => array(
                    "value" => $_SESSION["logged_in"],
                    "check" => intval($_SESSION["logged_in"] == true)
                ),
                "username" => array(
                    "value" => $_SESSION["username"],
                    "check" => intval(isset($userList[$_SESSION["username"]]))
                )
            )));*/
            return false;
        }
    }