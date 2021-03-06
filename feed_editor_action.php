<?php

require 'config.php';
require 'models/Auth.php';
require 'dao/PostDao.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();

$body = filter_input(INPUT_POST, 'body');

if( $body ) {

    $postDao = new PostDao($pdo);

    $newPost  =  new Post();
    $newPost->id_user = $userInfo->id;
    $newPost->type = 'Text';
    $newPost->created_at = date('Y-m-d H:i:s', time());
    $newPost->body = $body;
    
    $postDao->insert($newPost);

}

header('Location: ' . $base);
exit;
