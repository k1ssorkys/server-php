<?php

namespace Controller;

use Model\Book;
use Src\View;
use Src\Request;
use Validators\RequireValidator;
use Validators\OnlyDigitsValidator;
use Validators\OnlyLettersValidator;
use Src\Validator\Validator;

class BookController
{
    public function new_books(Request $request): string
    {
        $message = '';

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'title' => ['required'],
                'author' => ['required'],
                'year' => ['required', 'digits'],
                'price' => ['required', 'numeric'],
                'isbn' => ['required'],
                'description' => ['required'],
            ], [
                'required' => 'Поле :field обязательно для заполнения',
                'digits' => 'Поле :field должно содержать только цифры',
                'numeric' => 'Поле :field должно быть числом'
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.new_books', [
                    'errors' => $validator->errors(),
                    'message' => 'Ошибка валидации'
                ]);
            }

            $data = $request->all();

            // Обработка загрузки файла
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $file = $_FILES['image'];
                $filename = time() . '_' . basename($file['name']);
                $destination = $_SERVER['DOCUMENT_ROOT'] . '/server-php/public/uploads/' . $filename;

                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    $data['image'] = $filename;
                    $message = 'Файл успешно загружен. ';
                } else {
                    $message = 'Ошибка при загрузке обложки. ';
                }
            }

            if (Book::create($data)) {
                $message .= 'Книга успешно добавлена.';
            } else {
                $message .= 'Ошибка при добавлении книги.';
            }
        }
        return (new View())->render('site.new_books', ['message' => $message]);
    }

    public function show_book($id, Request $request): string
    {
        $book = Book::find($id);

        if (!$book) {
            return "Книга не найдена";
        }
        return (new View())->render('site.show_book', ['book' => $book]);
    }
}