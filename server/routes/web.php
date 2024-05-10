<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\BotManController;
use App\Models\BotModel;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $bots = TelegraphBot::all();
    echo env('APP_URL');
    return view('home', ['bots' => $bots]);
})->name('home');

Route::post('/bot/create', [BotController::class, 'create'])->name('create-bot');

Route::get('/bots', [BotController::class, 'getAll'])->name('get-all-bots');