<?php
declare(strict_types=1);

namespace App\User;

use App\Core\Database;
use App\Core\Valitron;

class UserService
{
    protected const TABLE = 'user';

    public object $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public static function createService()
    {
        return new UserService();
    }

    public function createUser(array $post): ?int
    {
        $user = User::createUser($post);
        $hash = Valitron::hash($post['password']);
        $user->setPassword($hash);
        $sql = "INSERT INTO `" . static::TABLE . "` 
        (`name`, `email`, `password`)
        VALUES (?, ?, ?)";
        $sth = $this->db->prepare($sql);
        $sth->execute([
            $user->getName(),
            $user->getEmail(),
            $user->getPassword()
        ]);
        return (int)$this->db->lastInsertId();
    }

    public function loginUser(array $post): bool
    {
        $userModel = User::createUser($post);
        $userModel->setPassword($post['password']);
        if (!$userModel->getEmail() && !$userModel->getPassword()) {
            return false;
        }
        $sql = "SELECT `id`, `name`, `email`, `password` FROM `" . static::TABLE ."` 
        WHERE `email`=:email LIMIT 1";
        $sth = $this->db->prepare($sql);
        $sth->execute([':email' => $userModel->getEmail()]);
        $user = $sth->fetch();
        if (!empty($user) && Valitron::areEqual($userModel->getPassword(), $user['password'])) {
            return true;
        }
        return false;
    }
}
