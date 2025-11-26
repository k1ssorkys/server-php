<?php

namespace Controller;

use Model\User;
use Src\View;
use Src\Request;
use Src\Validator\Validator;

class UserController
{
    public function createLibrarian(Request $request): string
    {
        $librarians = User::where('roleID', 2)->get(); // роль библиотекаря
        $message = '';

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'lastName' => ['required'],
                'firstName' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field обязательно для заполнения',
                'unique' => 'Пользователь с таким логином уже существует'
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.new_librarian', [
                    'errors' => $validator->errors(),
                    'message' => 'Ошибка валидации',
                    'librarians' => $librarians
                ]);
            }

            $data = $request->all();
            $data['roleID'] = 2; // роль библиотекаря
            $data['password'] = md5($data['password']);

            if (User::create($data)) {
                $message = 'Библиотекарь успешно добавлен';
                $librarians = User::where('roleID', 2)->get(); // обновляем список
            } else {
                $message = 'Ошибка при добавлении библиотекаря';
            }
        }

        return (new View())->render('site.new_librarian', [
            'message' => $message,
            'librarians' => $librarians
        ]);
    }

    public function deleteLibrarian(Request $request): string
    {
        if ($request->method === 'POST' && isset($request->all()['delete_id'])) {
            $id = $request->all()['delete_id'];
            $user = User::find($id);

            if ($user && $user->roleID === 2) {
                $user->delete();
            }

            app()->route->redirect('/new_librarian');
            return '';
        }

        return (new View())->render('site.new_librarian');
    }
}