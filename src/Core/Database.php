<?php
declare(strict_types=1);

namespace App\Core;

class Database extends \PDO
{
    public function __construct()
    {
        try {
            parent::__construct(
                'mysql:host=localhost;dbname=db-02;charset=utf8',
                'root',
                'root', [
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                    \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'",
                ]
            );
        } catch (\PDOException $e) {
            throw new \PDOException("Сервер временно не доступен", 500);
        }
    }
}
