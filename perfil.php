<?php
require 'config.php';
require 'models/Auth.php';
require 'dao/PostDao.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
$activeMenu = 'profile';

$user = [];
$feed = [];

//echo '<pre>';
//var_dump($userInfo);exit;

$id = filter_input(INPUT_GET, 'id');
if(!$id){
    $id = $userInfo->id;
}

if( $id == $userInfo->id ){

}

$userDao = new UserDao($pdo);
$postDao = new PostDao($pdo);

$user = $userDao->findById($id,true);
//echo '<pre>';
//var_dump($user);exit;
if(!$user){
    header("Location: ". $base);
    exit;
}

$birthdate = date("Y",strtotime($user->birthdate)) > 0 ? new DateTime($birthdate) : date("Y");
$dateFrom = new DateTime($birthdate);
$dateTo = new DateTime('today');
$user->ageYear = $dateFrom->diff($dateTo)->y;

$feed = $postDao->getUserFeed($id);

//var_dump($user);exit;

//$userRelationsDao = new UserRelationDao($pdo);
//$userTo = $userRelationsDao->getRelationsFrom($userInfo->id); 
$seguidores = 0;
//$dataPost = date('d/m/Y',strtotime($feed[0]->created_at));

//var_dump($user);
//var_dump($birthdate );
//exit;

include_once 'partial/header.php';
include_once 'partial/menu.php';
?>

<section class="feed">
    <div class="row">
        <div class="box flex-1 border-top-flat">
            <div class="box-body">
                <div class="profile-cover" style="background-image: url('<?= $base ?>/resources/media/covers/<?= strlen($user->cover) > 0 ? $user->cover : 'cover.jpg' ?>');"></div>
                <div class="profile-info m-20 row">
                    <div class="profile-info-avatar">
                        <img src="<?= $base ?>/resources/media/avatars/<?= strlen($user->avatar) > 0 ? $user->avatar : 'avatar.jpg'  ?>" />
                    </div>
                    <div class="profile-info-name">
                        <div class="profile-info-name-text"><?= $user->name ?></div>
                        <?php if(!empty($user->city)) : ?>
                            <div class="profile-info-location"><?= $user->city ?></div>
                        <?php endif ?>
                    </div>
                    <div class="profile-info-data row">
                        <div class="profile-info-item m-width-20">
                            <div class="profile-info-item-n"><?= count($user->followers) ?></div>
                            <div class="profile-info-item-s">Seguidores</div>
                        </div>
                        <div class="profile-info-item m-width-20">
                            <div class="profile-info-item-n"><?= count($user->following) ?></div>
                            <div class="profile-info-item-s">Seguindo</div>
                        </div>
                        <div class="profile-info-item m-width-20">
                            <div class="profile-info-item-n"><?= count($user->photos) ?></div>
                            <div class="profile-info-item-s">Fotos</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="column side pr-5">
    
            <div class="box">
                <div class="box-body">
                    
                    <div class="user-info-mini">
                        <img src="<?= $base ?>/resources/assets/images/calendar.png" />
                        <?= date('d/m/Y', strtotime($user->birthdate)) ?> (<?= $user->ageYear ?> anos)
                    </div>
                    
                    <?php if(!empty($user->city)) : ?>
                    <div class="user-info-mini">
                        <img src="<?= $base ?>/resources/assets/images/pin.png" />
                        <?= $user->city ?>, Brasil
                    </div>
                    <?php endif ?>
                    
                    <?php if(!empty($user->work)) : ?>
                    <div class="user-info-mini">
                        <img src="<?= $base ?>/resources/assets/images/work.png" />
                        <?= $user->work ?>
                    </div>
                    <?php endif ?>
                </div>
            </div>

            <div class="box">
                <div class="box-header m-10">
                    <div class="box-header-text">
                        Seguindo
                        <span>(<?= count($user->following) ?>)</span>
                    </div>
                    <div class="box-header-buttons">
                        <a href="<?= $base ?>/amigos.php?id=<?= $user->id ?>">ver todos</a>
                    </div>
                </div>
                <div class="box-body friend-list">

                    <?php if( count($user->following) ) : ?>
                        <?php foreach( $user->following as $item ) : ?>
                            <div class="friend-icon">
                                <a href="<?= $base ?>/perfil.php?id=<?= $item->id ?>">
                                    <div class="friend-icon-avatar">
                                        <img src="<?= $base ?>/resources/media/avatars/<?= $user->avatar?>" />
                                    </div>
                                    <div class="friend-icon-name">
                                        <?= $user->name ?>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach ?>
                    <?php endif ?>

                </div>
            </div>

        </div>
        <div class="column pl-5">

            <div class="box">
                <div class="box-header m-10">
                    <div class="box-header-text">
                        Fotos
                        <span><?= (count($user->photos)) ?></span>
                    </div>
                    <div class="box-header-buttons">
                        <a href="<?= $base ?>/fotos.php?id=<?= $user->id ?>">ver todos</a>
                    </div>
                </div>
                <div class="box-body row m-20">

                    <?php if( count($user->photos) > 0 ) : ?>
                    
                        <?php foreach( $user->photos as $foto ) :?>
                        <div class="user-photo-item">
                            <a href="#modal-1" rel="modal:open">
                                <img src="media/uploads/1.jpg" />
                            </a>
                            <div id="modal-1" style="display:none">
                                <img src="media/uploads/1.jpg" />
                            </div>
                        </div>
                        <?php endforeach ?>

                    <?php endif ?>
                    
                </div>

                <?php if( count($feed) > 0 ) : ?>
                    <?php foreach( $feed as $item ) : ?>
                    <?php require 'partial/feed-item.php'; ?>
                    <?php endforeach ?>
                <?php else : ?>
                    Não há postagens deste usuário
                <?php endif; ?>


            </div>
        </div>
    </div>
</section>

<?php require 'partial/footer.php'; ?>

