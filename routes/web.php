<?php

use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return redirect()->route('login');
});

// 仮ルート（Chapter 6で本実装に置き換え）
Route::middleware('auth')->group(function () {
    Route::get('/tasks', fn() => 'タスク一覧（準備中）')->name('tasks.index');
    Route::get('/categories', fn() => 'カテゴリー一覧（準備中）')->name('categories.index');
});


