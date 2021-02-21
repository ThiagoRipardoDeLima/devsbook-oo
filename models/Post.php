<?php

class Post 
{

    public $id;
    public $id_user;
    public $type; //text // photo
    public $created_at;
    public $body;
    
}

interface IPostDao 
{
    public function insert(Post $p);
    public function getHomeFeed($id_user);
    public function getUserFeed($id_user);
}
