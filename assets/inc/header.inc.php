<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/assets/css/main.css">
        <link rel="stylesheet" href="/assets/css/nav.css">
        <title><?php echo (isset($PAGE_TITLE) ? $PAGE_TITLE : "JimmyBear217.dev"); ?></title>
    </head>
    <body>
        <nav>
            <h2><a href="/">JimmyBear217.dev</a></h2>
            <img id="nav-btn" src="/assets/img/menu.png" height="32" width="32" onClick="toggleMenu()">
            <ul id="top-nav">
                <li><a href="/" data-pagename="home">Home</a></li>
                <li><a href="/projects" data-pagename="projects">Projects</a></li>
                <li><a href="/contact" data-pagename="contact">Contact Me</a></li>
            </ul>
            <script src="/assets/js/menu.js" async></script>
        </nav>