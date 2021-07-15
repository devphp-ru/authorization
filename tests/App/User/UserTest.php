<?php
declare(strict_types=1);

namespace App\User;

use App\Core\Valitron;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private User $user;
    private array $post = [
        'name' => 'user',
        'email' => 'mail@mail.ru',
        'password' => '123456',
    ];

    public function setUp(): void
    {
        $this->user = new User($this->post);
    }

    public function testUserData()
    {
        $this->user->setPassword($this->post['password']);
        self::assertEquals($this->post['name'], $this->user->getName());
        self::assertEquals($this->post['email'], $this->user->getEmail());
        self::assertEquals($this->post['password'], $this->user->getPassword());
    }

    /**
     * пароль устанавливатеся как бы из бд Valitron::hash
     * а второй как бы из формы
     */
    public function testPasswordAreEqual()
    {
        $hash = Valitron::hash($this->post['password']);
        $this->user->setPassword($this->post['password']);
        self::assertTrue(Valitron::areEqual($this->user->getPassword(), $hash));
    }

    public function testFalsePassword()
    {
        $hash = Valitron::hash($this->post['password']);
        $password = '123';
        $this->user->setPassword($password);
        self::assertFalse(Valitron::areEqual($this->user->getPassword(), $hash));
    }
}