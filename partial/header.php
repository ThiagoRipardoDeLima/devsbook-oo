<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title></title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?= $base; ?>/resources/assets/css/style.css" />
</head>
<body>
    <header>
        <div class="container">
            <div class="logo">
                <a href="<?= $base; ?>"><img src="<?= $base; ?>/resources/assets/images/devsbook_logo.png" /></a>
            </div>
            <div class="head-side">
                <div class="head-side-left">
                    <div class="search-area">
                        <form method="GET" action="<?= $base ?>/search.php">
                            <input type="search" placeholder="Pesquisar" name="s" />
                        </form>
                    </div>
                </div>
                <div class="head-side-right">
                    <a href="<?= $base; ?>/perfil.php" class="user-area">
                        <div class="user-area-text"><?= $userInfo->name ?></div>
                        <div class="user-area-icon">
                            <img src="<?= $base ?>/resources/media/avatars/avatar.jpg" />
                        </div>
                    </a>
                    <a href="<?= $base; ?>/logout.php" target="blank" class="user-logout">
                        <img src="<?= $base; ?>/resources/assets/images/power_white.png" />
                    </a>
                </div>
            </div>
        </div>
    </header>
    <section class="container main">
