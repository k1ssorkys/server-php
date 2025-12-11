<?php

use Src\Route;

Route::add('GET', '/hello', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);
Route::add('GET', '/go', [Controller\Site::class, 'index']);

Route::add(['GET', 'POST'], '/new_books', [Controller\BookController::class, 'new_books']);
Route::add('GET', '/show_book/{id:\d+}', [Controller\BookController::class, 'show_book']);

Route::add(['GET', 'POST'], '/new_reader', [Controller\ReaderController::class, 'new_reader']);
Route::add('GET', '/show_reader', [Controller\ReaderController::class, 'show_reader']);
Route::add('GET', '/reader/{id:\d+}', [Controller\ReaderController::class, 'readers']);

Route::add(['GET', 'POST'], '/issued', [Controller\ReaderController::class, 'issued']);

Route::add(['GET', 'POST'], '/new_librarian', [Controller\UserController::class, 'createLibrarian']);

Route::add('GET', '/seed-admin', [Controller\AdminSeederController::class, 'createAdmin']);
Route::add('POST', '/delete_librarian', [Controller\UserController::class, 'deleteLibrarian']);
