<?php

require 'config.php';
require 'models/Auth.php';
require 'dao/PostDao.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

//echo '<pre>';
//var_dump($userInfo);exit;
$activeMenu = 'home';

$postDao = new PostDao($pdo);
$feed = $postDao->getHomeFeed($userInfo->id);

//var_dump($feed);

include_once 'partial/header.php';
include_once 'partial/menu.php';
?>

<section class="feed mt-10">
    <div class="row">
        <div class="column pr-5">
            <?php require "partial/feed-editor.php"?>
            <?php require "partial/feed-item.php"?>
        </div>

        <div class="column side pl-5">
            <div class="box banners">
                <div class="box-header">
                    <div class="box-header-text">Patrocinios</div>
                    <div class="box-header-buttons">
                        
                    </div>
                </div>
                <div class="box-body">
                    <a href=""><img src="https://alunos.b7web.com.br/media/courses/php-nivel-1.jpg" /></a>
                    <a href=""><img src="https://alunos.b7web.com.br/media/courses/laravel-nivel-1.jpg" /></a>
                </div>
            </div>
            <div class="box">
                <div class="box-body m-10">
                    Criado com ❤️ por B7Web
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'partial/footer.php'; ?>

