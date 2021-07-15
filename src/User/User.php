<?php
declare(strict_types=1);

namespace App\User;

class User
{
    private string $name;
    private string $email;
    private string $password;

    /**
     * @param array $post
     * @return User
     */
    public static function createUser(array $post): User
    {
        return new User($post);
    }

    /**
     * User constructor.
     * @param array $post
     */
    public function __construct(array $post)
    {
        $this->setName($post);
        $this->setEmail($post);
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = \trim($password);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param array $post
     */
    private function setName(array $post): void
    {
        $this->name = $post['name'] ?? '';
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param array $post
     */
    private function setEmail(array $post): void
    {
        $this->email = $post['email'] ?? '';
    }
}
