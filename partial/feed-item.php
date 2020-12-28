<?php
$typePost = '';
switch($item->type){
    case 'text':
        $typePost = 'fez um post';
    break;
    case 'photo':
        $typePost = 'postou uma foto';
    break;
}

$dataPost = date('d/m/Y',strtotime($item->created_at));
$isLiked = $item->liked;

//echo '<pre>';
//var_dump($item);exit;

?>

<div class="box feed-item">
    <div class="box-body">
        <div class="feed-item-head row mt-20 m-width-20">
            <div class="feed-item-head-photo">
                <a href="<?= $base ?>/perfil.php?id=<?= $item->user->id ?>"><img src="<?= $base ?>/resources/media/avatars/<?= $item->user->avatar ?>.jpg" /></a>
            </div>
            <div class="feed-item-head-info">
                <a href=""><span class="fidi-name"><?= $item->user->name ?></span></a>
                <span class="fidi-action"><?= $typePost ?></span>
                <br/>
                <span class="fidi-date"><?= $dataPost ?></span>
            </div>
            <div class="feed-item-head-btn">
                <img src="<?= $base ?>/resources/assets/images/more.png" />
            </div>
        </div>
        <div class="feed-item-body mt-10 m-width-20">
            <?= $item->body ?>
        </div>
        <div class="feed-item-buttons row mt-20 m-width-20">
            <div class="like-btn <?= $isLiked ? 'on' : '' ?>"><?= $item->likeCount ?></div>
            <div class="msg-btn"><?= count($item->comments) ?></div>
        </div>
        <div class="feed-item-comments">
            <?php foreach($item->comments as $comments): ?>
            <div class="fic-item row m-height-10 m-width-20">
                <div class="fic-item-photo">
                    <a href=""><img src="<?= $base ?>/resources/media/avatars/avatar.jpg" /></a>
                </div>
                <div class="fic-item-info">
                    <a href="">Bonieky Lacerda</a>
                    Comentando no meu próprio post
                </div>
            </div>
            <?php endforeach; ?>

            <div class="fic-item row m-height-10 m-width-20">
                <div class="fic-item-photo">
                    <a href=""><img src="<?= $base ?>/resources/media/avatars/avatar.jpg" /></a>
                </div>
                <div class="fic-item-info">
                    <a href="">Bonieky Lacerda</a>
                    Muito legal, parabéns!
                </div>
            </div>

            <div class="fic-answer row m-height-10 m-width-20">
                <div class="fic-item-photo">
                    <a href="<?= $base ?>/perfil.php"><img src="<?= $base ?>/resources/media/avatars/<?= $user_info->avatar ?>" /></a>
                </div>
                <input type="text" class="fic-item-field" placeholder="Escreva um comentário" />
            </div>

        </div>
    </div>
</div>
