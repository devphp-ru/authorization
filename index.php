<?php
declare(strict_types=1);
error_reporting(-1);

require_once __DIR__ . '/vendor/autoload.php';

function debug($arr)
{
    echo '<pre>'; var_dump($arr); echo '</pre>';
}

$post = [
    'name' => 'user',
    'email' => 'mail@mail.ru',
    'password' => '123456',
];

$controller = new \App\UserController\UserController();
//регистрация
//echo $controller->actionSignUp($post);

//$post['password'] = '0123';
//авторизация
echo $controller->actionLogin($post);

