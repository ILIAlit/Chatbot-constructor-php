<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\ChainController;
use App\Http\Controllers\TriggerController;
use App\Models\BotModel;
use App\Models\TBotModel;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Support\Facades\Route;

Route::get('/bot/create', function () {
    return view('home');
})->name('home');
Route::get('/chain', function () {
    return view('chain/create-chain');
})->name('create-chain');
Route::get('/', [BotController::class, 'getAll'])->name('get-all-bots');
Route::get('/bot/update-bot/{id}', [BotController::class, 'updateBotIndex'])->name('update-bot-page');
Route::get('/trigger', [TriggerController::class, 'index'])->name('get-trigger-page');



Route::post('/bot/create', [BotController::class, 'create'])->name('create-bot');
Route::post('/chain/create', [ChainController::class, 'createChain'])->name('create-chain');
Route::post('/trigger/create', [TriggerController::class, 'create'])->name('create-trigger');

Route::patch('/bot/changeBotChain/{id}', [BotController::class, 'changeBotChain'])->name('change-bot-chain');
Route::patch('/bot/updateBotTriggers/{id}', [BotController::class, 'updateBotTriggers'])->name('update-bot-triggers');