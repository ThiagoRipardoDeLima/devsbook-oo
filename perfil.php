<?php
require 'config.php';
require 'models/Auth.php';
require 'dao/PostDao.php';

$auth = new Auth($pdo, $base);
$userInfo = $auth->checkToken();
$activeMenu = 'profile';

//echo '<pre>';
//var_dump($userInfo);exit;

$id = filter_input(INPUT_GET, 'id');
if(!$id){
    $id = $userInfo->id;
}

$userDao = new UserDao($pdo);
$postDao = new PostDao($pdo);

$user = $userDao->findById($id);
//echo '<pre>';
//var_dump($user);exit;
if(!$user){
    header("Location: ". $base);
    exit;
}

$dateFrom = new DateTime($user->birthdate);
$dateTo = new DateTime('today');
$user->ageYear = $dateFrom->diff($dateTo)->y;

//var_dump($user);exit;

//$userRelationsDao = new UserRelationDao($pdo);
//$userTo = $userRelationsDao->getRelationsFrom($userInfo->id); 
$seguidores = 0;
//$dataPost = date('d/m/Y',strtotime($feed[0]->created_at));

//var_dump($dataPost);
//var_dump($feed);
//exit;

include_once 'partial/header.php';
include_once 'partial/menu.php';
?>

<section class="feed">
    <div class="row">
        <div class="box flex-1 border-top-flat">
            <div class="box-body">
                <div class="profile-cover" style="background-image: url('<?= $base ?>/resources/media/covers/<?= $user->cover ?>');"></div>
                <div class="profile-info m-20 row">
                    <div class="profile-info-avatar">
                        <img src="<?= $base ?>/resources/media/avatars/<?= $user->avatar ?>" />
                    </div>
                    <div class="profile-info-name">
                        <div class="profile-info-name-text"><?= $user->name ?></div>
                        <?php if(!empty($user->city)) : ?>
                            <div class="profile-info-location"><?= $user->city ?></div>
                        <?php endif ?>
                    </div>
                    <div class="profile-info-data row">
                        <div class="profile-info-item m-width-20">
                            <div class="profile-info-item-n">-1</div>
                            <div class="profile-info-item-s">Seguidores</div>
                        </div>
                        <div class="profile-info-item m-width-20">
                            <div class="profile-info-item-n">-1</div>
                            <div class="profile-info-item-s">Seguindo</div>
                        </div>
                        <div class="profile-info-item m-width-20">
                            <div class="profile-info-item-n">-1</div>
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
                        <span>(363)</span>
                    </div>
                    <div class="box-header-buttons">
                        <a href="">ver todos</a>
                    </div>
                </div>
                <div class="box-body friend-list">
                    
                    <div class="friend-icon">
                        <a href="">
                            <div class="friend-icon-avatar">
                                <img src="media/avatars/avatar.jpg" />
                            </div>
                            <div class="friend-icon-name">
                                Bonieky
                            </div>
                        </a>
                    </div>

                    <div class="friend-icon">
                        <a href="">
                            <div class="friend-icon-avatar">
                                <img src="media/avatars/avatar.jpg" />
                            </div>
                            <div class="friend-icon-name">
                                Bonieky
                            </div>
                        </a>
                    </div>

                    <div class="friend-icon">
                        <a href="">
                            <div class="friend-icon-avatar">
                                <img src="media/avatars/avatar.jpg" />
                            </div>
                            <div class="friend-icon-name">
                                Bonieky
                            </div>
                        </a>
                    </div>

                    <div class="friend-icon">
                        <a href="">
                            <div class="friend-icon-avatar">
                                <img src="media/avatars/avatar.jpg" />
                            </div>
                            <div class="friend-icon-name">
                                Bonieky
                            </div>
                        </a>
                    </div>

                    <div class="friend-icon">
                        <a href="">
                            <div class="friend-icon-avatar">
                                <img src="media/avatars/avatar.jpg" />
                            </div>
                            <div class="friend-icon-name">
                                Bonieky
                            </div>
                        </a>
                    </div>

                    <div class="friend-icon">
                        <a href="">
                            <div class="friend-icon-avatar">
                                <img src="media/avatars/avatar.jpg" />
                            </div>
                            <div class="friend-icon-name">
                                Bonieky
                            </div>
                        </a>
                    </div>

                    <div class="friend-icon">
                        <a href="">
                            <div class="friend-icon-avatar">
                                <img src="media/avatars/avatar.jpg" />
                            </div>
                            <div class="friend-icon-name">
                                Bonieky
                            </div>
                        </a>
                    </div>

                </div>
            </div>

        </div>
        <div class="column pl-5">

            <div class="box">
                <div class="box-header m-10">
                    <div class="box-header-text">
                        Fotos
                        <span>(12)</span>
                    </div>
                    <div class="box-header-buttons">
                        <a href="">ver todos</a>
                    </div>
                </div>
                <div class="box-body row m-20">
                    
                    <div class="user-photo-item">
                        <a href="#modal-1" rel="modal:open">
                            <img src="media/uploads/1.jpg" />
                        </a>
                        <div id="modal-1" style="display:none">
                            <img src="media/uploads/1.jpg" />
                        </div>
                    </div>

                    <div class="user-photo-item">
                        <a href="#modal-2" rel="modal:open">
                            <img src="media/uploads/1.jpg" />
                        </a>
                        <div id="modal-2" style="display:none">
                            <img src="media/uploads/1.jpg" />
                        </div>
                    </div>

                    <div class="user-photo-item">
                        <a href="#modal-3" rel="modal:open">
                            <img src="media/uploads/1.jpg" />
                        </a>
                        <div id="modal-3" style="display:none">
                            <img src="media/uploads/1.jpg" />
                        </div>
                    </div>

                    <div class="user-photo-item">
                        <a href="#modal-4" rel="modal:open">
                            <img src="media/uploads/1.jpg" />
                        </a>
                        <div id="modal-4" style="display:none">
                            <img src="media/uploads/1.jpg" />
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</section>

<?php require 'partial/footer.php'; ?>

