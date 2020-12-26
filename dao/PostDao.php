<?php 
require_once 'models/Post.php';
require_once 'dao/UserRelationDao.php';
require_once 'dao/UserDao.php';

class PostDao implements IPostDao 
{
    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo  = $driver;
    }

    private function generateUser($Users)
    {
        $user               = new User();
        $user->id           = $Users['id'] ?? 0;
        $user->email        = $Users['email'] ?? '';
        $user->password     = $Users['password'] ?? '';
        $user->name         = $Users['name'] ?? '';
        $user->birthdate    = $Users['birthdate'] ?? '';
        $user->city         = $Users['city'] ?? '';
        $user->avatar       = $Users['avatar'] ?? '';
        $user->cover        = $Users['cover'] ?? '';
        $user->token        = $Users['token'] ?? '';
        $user->work         = $Users['work'] ?? '';

        return $user;

    }

    public function insert(Post $p)
    {
        
       
        $sql = $this->pdo->prepare(
            "INSERT INTO posts
            (id_user, type, created_at, body)
            VALUES
            (:id_user, :type, :created_at, :body)"
        );

        $sql->bindValue(':id_user'      , $p->id_user);
        $sql->bindValue(':type'         , $p->type);
        $sql->bindValue(':created_at'   , $p->created_at);
        $sql->bindValue(':body'         , $p->body);
        
        if(!$sql->execute()){
            echo  '<pre>';
            var_dump($sql->errorInfo());exit;
        }
        
       
    }

    public function update(User $u)
    {
        $sql = $this->pdo->prepare(
            "UPDATE users
             SET    email     = :email,
                    password  = :password,
                    name      = :name,
                    birthdate = :birthdate,
                    city      = :city,
                    work      = :work,
                    avatar    = :avatar,
                    cover     = :cover,
                    token     = :token
             WHERE  id        = :id");

        $sql->bindValue(':email', $u->email);
        $sql->bindValue(':password', $u->password);
        $sql->bindValue(':name', $u->name);
        $sql->bindValue(':birthdate', $u->birthdate);
        $sql->bindValue(':city', $u->city);
        $sql->bindValue(':work', $u->work);
        $sql->bindValue(':avatar', $u->avatar);
        $sql->bindValue(':cover', $u->cover);
        $sql->bindValue(':token', $u->token);
        $sql->bindValue(':id', $u->id);
        
        $sql->execute();
        return true;

    }

    public function getHomeFeed($id_user){
        $array = [];

        // 1 . Lista  de  user que  eu sigo
        $urd = new UserRelationDao($this->pdo);
        $userList = $urd->getRelationsFrom($id_user);

        // 2 . Pegar  os posts ordenado pela  data
        $sql = $this->pdo->query("SELECT * FROM posts WHERE id_user in (".implode(',', $userList).") ORDER BY created_at DESC");

        if($sql->rowCount() > 0){
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            // 3 .  Transformar resultado em objetos
            $array = $this->_postListToObjet($data, $id_user);

        }

        return $array;
        

    }

    private function _postListToObjet($post_List, $id_user)
    {

        $posts = [];
        $userDao = new UserDao($this->pdo);

        foreach($post_List as $post_item){
            $newPost = new Post();
            $newPost->id = $post_item['id'];
            $newPost->id_user = $post_item['id_user'];
            $newPost->type = $post_item['type'];
            $newPost->created_at = $post_item['created_at'];
            $newPost->body = $post_item['body'];
            $newPost->mine = false;

            if($post_item['id_user'] == $id_user){
                $newPost->mine = true;
            }

            //pegar info do user
            $newPost->user = $userDao->findById($post_item['id_user']);

            //info sobre like
            $newPost->likeCount = 0;
            $newPost->liked = false;

            //info sobre comments
            $newPost->comments = [];

            $posts[] = $newPost;

        }

        return $posts;
    }
    

}
