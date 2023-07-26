<?php
global $user;
if(!empty($user)){
    header('Location: /admin/');
}

?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="shortcut icon" href="/assets/img/icon/favicon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/fonts/flaticon/flaticon.css">
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/mobile.css">
</head>

<body>

<header>
    <div class="container">
        <div class="header-wrapper mt-5">
            <div class="row header-content">
                <div class="header-title col-md-8">
                    <a href="/"><?= get_setting('site_title')   ?></a>
                </div>
                <div class="header-menu col-md-4">
                    <ul>
                        <li>
                            <a href="/" <?php if(is_page('home')){ ?> style="opacity: 100%;" <?php } ?>>Home</a>
                        </li>
                        <li>
                            <a href="/blog.php" <?php if(is_page('blog')){ ?> style="opacity: 100%;" <?php } ?>>Blog</a>
                        </li>
                        <li>
                            <a href="/about.php" <?php if(is_page('about')){ ?> style="opacity: 100%;" <?php } ?>>About</a>
                        </li>
                        <li>
                            <a href="/contact.php" <?php if(is_page('contact')){ ?> style="opacity: 100%;" <?php } ?>>Contact</a>
                        </li>
                        <li>
                            <a href="/login.php" <?php if(is_page('login')){ ?> style="opacity: 100%;" <?php } ?>>Login</a>
                        </li>
                        <li>
                            <a href="/register.php" <?php if(is_page('register')){ ?> style="opacity: 100%;" <?php } ?>>Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>