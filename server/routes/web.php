<?php

use App\Http\Controllers\BotController;
use App\Http\Controllers\BotManController;
use App\Http\Controllers\ChainController;
use App\Http\Controllers\TriggerController;
use App\Models\BotModel;
use App\Models\TBotModel;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Support\Facades\Route;

Route::get('/', [BotController::class, 'getAll'])->name('home');



Route::get('/chain/create', function () {
    return view('chain/create-chain');
})->name('create-chain');
Route::get('/chain', [ChainController::class, 'getAll'])->name('chain');
Route::post('/chain/create', [ChainController::class, 'createChain'])->name('create-chain');
Route::delete('/chain/delete-chain/{id}', [ChainController::class, 'deleteChain'])->name('delete-chain');



Route::post('/trigger/create', [TriggerController::class, 'create'])->name('create-trigger');
Route::get('/trigger/create-trigger', function () {return view('trigger/create');})->name('create-page');
Route::get('/trigger', [TriggerController::class, 'index'])->name('get-trigger-page');



Route::get('/bot/create', function () {
    return view('bot/create');
})->name('create-bot');
Route::get('/bot/update-bot/{id}', [BotController::class, 'updateBotIndex'])->name('update-bot-page');
Route::post('/bot/create', [BotController::class, 'create'])->name('create-bot');
Route::patch('/bot/changeBotChain/{id}', [BotController::class, 'changeBotChain'])->name('change-bot-chain');
Route::patch('/bot/updateBotTriggers/{id}', [BotController::class, 'updateBotTriggers'])->name('update-bot-triggers');
Route::delete('/bot/delete-bot/{id}', [BotController::class, 'deleteBot'])->name('delete-bot');