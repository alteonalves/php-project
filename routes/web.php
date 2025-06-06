<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('vehicles');
})->name('/');

Route::get('/create', function () {
    return Inertia::render('create');
})->name('create');

Route::get('/edit/{id}', function ($id) {
    return Inertia::render('edit', ['id' => $id]);
})->name('edit');
