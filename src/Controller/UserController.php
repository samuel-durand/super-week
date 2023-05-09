<?php 

namespace App\Controller;

use App\Model\UserModel;

class UserController
{
    public function list($connection)
    {
        $userModel = new UserModel();
        $users = $userModel->findAll($connection);
        return $users;
    }
}


?>