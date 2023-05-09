<?php

namespace App\Model;

use App\Core\Database;

class UserModel {
    
    public function findAll()
    {
        $query = "SELECT * FROM users";
        $statement = $connection->prepare($query);
        $statement->execute();
        $users = $statement->fetchALL(\PDO::FETCH_ASSOC);

        return $users;
    }
}

?>