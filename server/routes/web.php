<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\ChainController;
use App\Models\BotModel;
use App\Models\TBotModel;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo env('APP_URL');
    return view('home');
})->name('home');
Route::get('/chain/create', function () {
    return view('chain/create-chain');
})->name('create-chain');
Route::get('/bot/bots', [BotController::class, 'getAll'])->name('get-all-bots');
Route::get('/bot/update-bot/{id}', [BotController::class, 'updateBot'])->name('update-bot');



Route::post('/bot/create', [BotController::class, 'create'])->name('create-bot');
Route::post('/chain/create', [ChainController::class, 'createChain'])->name('create-chain');

Route::patch('/bot/changeBotChain/{id}', [BotController::class, 'changeBotChain'])->name('change-bot-chain');