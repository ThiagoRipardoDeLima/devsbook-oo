<?php 
require_once 'models/Post.php';

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

    

}
