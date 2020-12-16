<?php

require 'config.php';

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Devsbook - A sua Rede Social</title>
    <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1"/>
    <link rel="stylesheet" href="<?= $base ?>/resources/assets/css/login.css" />
</head>
<body>
    <header>
        <div class="container">
            <a href="<?= $base ?>"><img src="<?= $base ?>/resources/assets/images/devsbook_logo.png" /></a>
        </div>
    </header>
    <section class="container main">
        <form method="POST" action="<?= $base ?>/login_action.php">
        
            <?php if( !empty( $_SESSION['errorLogin'] ) ) : ?>
                <?= $_SESSION['errorLogin']; ?>
                <?php $_SESSION['errorLogin'] = ''; ?>
            <?php endif; ?>

            <input placeholder="Digite seu e-mail" class="input" type="email" name="email" />

            <input placeholder="Digite sua senha" class="input" type="password" name="password" />

            <input class="button" type="submit" value="Acessar o sistema" />

            <a href="<?= $base ?>/signup.php">Ainda não tem conta? Cadastre-se</a>
        </form>
    </section>
</body>
</html>
