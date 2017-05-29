<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Messanger</title>
    <link rel="icon" href="/public/images/favicon.ico">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/app.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/public/js/app.js"></script>
</head>
<body class="container">
    <ul class="nav nav-tabs menu">
        <li role="presentation" class="<?php if($_SERVER['PATH_INFO'] == '/'){ echo 'active'; } ?>"><a href="/">Home</a></li>
        <?php if(!isset($_SESSION['user'])): ?>
            <li role="presentation" class="<?php if($_SERVER['PATH_INFO'] == '/auth/login'){ echo 'active'; } ?>"><a href="/auth/login">Sign in</a></li>
            <li role="presentation" class="<?php if($_SERVER['PATH_INFO'] == '/auth/register'){ echo 'active'; } ?>"><a href="/auth/register">Sign up</a></li>
        <?php else: ?>
            <li role="presentation" class="<?php if($_SERVER['PATH_INFO'] == '/user/profile'){ echo 'active'; } ?>"><a href="/user/profile">Profile</a></li>
            <li role="presentation" class="<?php if($_SERVER['PATH_INFO'] == '/user/dialogs'){ echo 'active'; } ?>"><a href="/user/dialogs">Dialogs</a></li>
            <li role="presentation"><a href="/auth/signout">Sign out</a></li>
        <?php endif; ?>
    </ul>

    <?= \Core\Helper::alert() ?>
    <?= \Core\Helper::notice() ?>

    <div class="validation_errors"></div>

    <div class="content"><?= $content ?></div>

</body>
</html>
