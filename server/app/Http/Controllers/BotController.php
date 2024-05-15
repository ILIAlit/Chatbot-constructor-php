<?php

namespace App\Http\Controllers;

use App\Models\BotModel;
use App\Services\BotServices;
use App\Services\ChainServices;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BotController extends Controller
{
    private BotServices $botService;
    private ChainServices $chainService;
    function __construct(BotServices $botService, ChainServices $chainService) {
        $this->botService = $botService;
        $this->chainService = $chainService;
    }
    public function create(Request $request) {
        $name = $request->input('name');
        $token = $request->input('token');
        $valid = $request->validate([
            'token' => 'required',
            'name' => 'required',
        ]);
        $this->botService->createBot($token, $name);
        return redirect()->route('home');
    }

    public function getAll() {
        $bots = TelegraphBot::all();
        return view('bot/bots', ['bots' => $bots]);
    }

    public function updateBot(string $id) {
        $bot = TelegraphBot::find($id);
        $chains = $this->chainService->getAllChain();
        return view('bot/update-bot', ['bot' => $bot, 'chains' => $chains]);
    }

    public function changeBotChain(Request $request, string $botId) {
        $jsonData = $request->getContent();
        $data = json_decode($jsonData);
        $chainId = $data->chainId;
        $this->botService->changeBotChain($botId, $chainId);
    }
}