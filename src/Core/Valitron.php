<?php
declare(strict_types=1);

namespace App\Core;


class Valitron
{

    public static function hash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @param string $password
     * @param string $hash
     * @return bool
     */
    public static function areEqual(string $password, string $hash): bool
    {
        return password_verify($password, $hash);
    }
}