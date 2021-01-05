# FileExplorer

A multiuser PHP/JS Tool to access a server's fileSystem originally finished on April 29, 2018 and updated in 2021. this can be used for anything from convenience to pentesting on any web server that runs php.

## Update 2021.04.01

This software has been updated with better technologies and security. changes includes:

1. Replaced the ajax requests with fetch
2. Implemented access control by scope as part of user management
3. Replaced password encryption with blowfish
4. Replaced JSON Generation with `json_encode` of an array


## Authentification

The users and credentials are stored in the `$userList` array in `assets/inc/userList.inc.php`. This file is called
each time a script wants to verify user authentification. Passwords are encrypted with blowfish,
(BCRYPT) which is the current default for php 7.

The `chroot` option allows to set the required path that the requested file or directory must have
in order to honor the specifc user's request. For example, chroot can be set to `/var/www`. Any folder
contained in `/var/www/` such as `/var/www/level1/level2/level3/leve4/level5` are allowed. anything
out of this scope, like `/`, `/var/` or `/home` will return an error.

```php
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
```

## Security

In addition to limiting users' access to a certain scope, you can protect your files by restricting
the "others" or "everyone" permissions so that only the authorized users can view or user the chosen 
file or directory. This system uses the web server's own permissions and users which mean that if your
server was to be breached using the web server, this is the access they would have.

For instance, under Linux and MacOS, you can restrict permissions to the type of user "other" with
the following command:

```bash
chmod -Rv o-rwx ~/Documents
```
