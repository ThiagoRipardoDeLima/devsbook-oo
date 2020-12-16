<?php 
require 'models/User.php';

class UserDao implements IUserDao 
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

    public function findByToken($token)
    {
        if( !empty($token) ){
            $sql = "SELECT *  FROM users WHERE token = :token";
            $prepare  =  $this->pdo->prepare($sql);
            $prepare->bindValue(':token',$token);
            $prepare->execute();

            if( $prepare->rowCount()> 0 ){
                $data  = $prepare->fetch(PDO::FETCH_ASSOC);
                $user  = $this->generateUser($data);
                return $user;
            }
        }
        return false;
    }

    public function findByEmail($email)
    {
       
        if( !empty($email) ){
            $sql = "SELECT * FROM users WHERE email = :email";
            $prepare  =  $this->pdo->prepare($sql);
            $prepare->bindValue(':email',$email);
            $prepare->execute();

            if( $prepare->rowCount()> 0 ){
                $data  = $prepare->fetch(PDO::FETCH_ASSOC);
                $user  = $this->generateUser($data);
                return $user;
            }
        }

        return false;
        exit;
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

    public function insert(User $u)
    {
        $sql = $this->pdo->prepare(
            "INSERT INTO users
            (email, password, name, birthdate, token)
            VALUES
            (:email, :password, :name, :birthdate, :token)"
        );

        $sql->bindValue(':email'    , $u->email);
        $sql->bindValue(':password' , $u->password);
        $sql->bindValue(':name'     , $u->name);
        $sql->bindValue(':birthdate', $u->birthdate);
        $sql->bindValue(':token'    , $u->token);

        if( $sql->execute() == 0 )
            return false;
        
        return true;
    }

}
