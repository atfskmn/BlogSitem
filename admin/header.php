<?php
    global $user;
    if(empty($user)){
        header('Location: /');
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
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
                            <a href="/admin" <?php if(is_page('adminhome')){ ?> style="opacity: 100%;" <?php } ?>>Home</a>
                        </li>
                        <li>
                            <a href="/admin/blog.php" <?php if(is_page('adminblog')){ ?> style="opacity: 100%;" <?php } ?>>Blog</a>
                        </li>
                        <li>
                            <a href="/admin/setting.php" <?php if(is_page('adminsetting')){ ?> style="opacity: 100%;" <?php } ?>>Setting</a>
                        </li>
                        <li>
                            <a href="/admin/contact.php" <?php if(is_page('admnincontact')){ ?> style="opacity: 100%;" <?php } ?>>Contact</a>
                        </li>
                        <li>
                            <a href="/admin/logout.php" <?php if(is_page('adminlogout')){ ?> style="opacity: 100%;" <?php } ?>>Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>