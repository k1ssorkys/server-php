<?php

namespace Controller;

use Model\Book;
use Model\Reader;
use Model\Issued;
use Src\View;
use Src\Request;
use Src\Validator\Validator;

class ReaderController
{
    public function new_reader(Request $request): string
    {
        $message = '';

        if ($request->method === 'POST') {
            $validator = new Validator($request->all(), [
                'lastName' => ['required'],
                'firstName' => ['required'],
                'phone' => ['required', 'digits']
            ], [
                'required' => 'Поле :field обязательно для заполнения',
                'digits' => 'Поле :field должно содержать только цифры'
            ]);

            if ($validator->fails()) {
                return (new View())->render('site.new_reader', [
                    'errors' => $validator->errors(),
                    'message' => 'Ошибка валидации'
                ]);
            }

            if (Reader::create($request->all())) {
                app()->route->redirect('/show_reader');
                return '';
            }
        }

        return (new View())->render('site.new_reader');
    }

    public function readers($id, Request $request): string
    {
        $reader = Reader::find($id);

        if (!$reader) {
            return "Читатель не найден";
        }

        $issuedBooks = Issued::where('readerID', $id)
            ->where('isReturned', 0)
            ->with('book')
            ->get();

        return (new View())->render('site.reader', [
            'reader' => $reader,
            'issuedBooks' => $issuedBooks
        ]);
    }

    public function show_reader(Request $request): string
    {
        $readers = Reader::all();
        return (new View())->render('site.show_reader', ['readers' => $readers]);
    }

    public function issued(Request $request): string
    {
        $message = '';
        $foundReader = null;

        if ($request->method === 'POST') {
            $data = $request->all();

            // Поиск по ID или фамилии
            if (!empty($data['search_card']) || !empty($data['search_name'])) {
                $query = Reader::query();

                if (!empty($data['search_card'])) {
                    $query->where('id', $data['search_card']);
                }

                if (!empty($data['search_name'])) {
                    $query->where('lastName', 'like', '%' . $data['search_name'] . '%');
                }
                $foundReader = $query->first();
            }

            // Выдача или возврат
            if (!empty($data['readerID']) && !empty($data['bookID']) && !empty($data['action'])) {
                $readerID = (int)$data['readerID'];
                $bookID = (int)$data['bookID'];
                $action = $data['action'];

                if ($action === 'issue') {
                    Issued::create([
                        'readerID' => $readerID,
                        'bookID' => $bookID,
                        'issuedDate' => date('Y-m-d H:i'),
                        'isReturned' => 0
                    ]);
                    $message = 'Книга выдана.';
                }

                if ($action === 'return') {
                    $entry = Issued::where('readerID', $readerID)
                        ->where('bookID', $bookID)
                        ->where('isReturned', 0)
                        ->first();

                    if ($entry) {
                        $entry->update([
                            'returnDate' => date('Y-m-d H:i:s'),
                            'isReturned' => 1
                        ]);
                        $message = 'Книга возвращена.';
                    } else {
                        $message = 'Выдача не найдена.';
                    }
                }
                $foundReader = Reader::find($readerID);
            }
        }

        $books = Book::all();
        $readers = Reader::all();
        $issued = Issued::where('isReturned', 0)->get();

        return (new View())->render('site.issued', [
            'message' => $message,
            'books' => $books,
            'readers' => $readers,
            'issued' => $issued,
            'foundReader' => $foundReader
        ]);
    }
}