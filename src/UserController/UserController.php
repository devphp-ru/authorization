<?php
declare(strict_types=1);

namespace App\UserController;

use App\User\UserService;

class UserController
{
    private UserService $userService;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->userService = UserService::createService();
    }

    /**
     * @param array $post
     * @return string
     */
    public function actionSignUp(array $post)
    {
        if (!$this->userService->createUser($post)) {
            return 'Ошибка регистрации';
        }
        return 'Регистрация успешна';
    }

    public function actionLogin(array $post)
    {
        if (!$this->userService->loginUser($post)) {
            return 'Логин/пароль введены не верно';
        }
        return 'Вы авторизованы';
    }
}
