<?php

namespace Controller;

use Model\Post;
use Src\View;
use Src\Request;
use Src\Auth\Auth;
use Model\Book;
use Src\Validator\Validator;

class AuthController
{
    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout()
    {
        Auth::logout();
        app()->route->redirect('/login');
    }

}