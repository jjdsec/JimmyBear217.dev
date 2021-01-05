<?php

    $userList = array(
        "JimmyBear217" => array(
            "password" => '$2y$10$LMtwcpUEVJMbYF13Nzwcuu3DBi6gxTT4O.nzqQCKZsH7JzPw5MAVS',
            "chroot" => "/",
        ),
        "DemoUser" => array(
            "password" => password_hash("SuperSecurePassword", PASSWORD_BCRYPT),
            "chroot" => realpath(__DIR__ . str_repeat("/..", 5)) // 5 levels up
        )
    );