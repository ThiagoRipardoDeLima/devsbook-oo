<?php

class UserRelation {
    public $id;
    public $user_from;
    public $user_to;
}

interface IUserRelationDao{
    public function insert(UserRelation $u);
    public function getFollowers($id);
    public function getFollowing($id);
}
