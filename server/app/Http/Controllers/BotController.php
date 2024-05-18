<?php

namespace App\Http\Controllers;

use App\Models\BotModel;
use App\Services\BotServices;
use App\Services\ChainServices;
use App\Services\TriggerServices;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BotController extends Controller
{
    private BotServices $botService;
    private ChainServices $chainService;

    private TriggerServices $triggerService;
    function __construct(BotServices $botService, ChainServices $chainService, TriggerServices $triggerService) {
        $this->botService = $botService;
        $this->chainService = $chainService;
        $this->triggerService = $triggerService;
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

    public function updateBotIndex(string $id) {
        $bot = $this->botService->getBotById($id);
        $chains = $this->chainService->getAllChain();
        $triggers = $this->triggerService->getTriggers();
        $botTriggers = $this->botService->getBotTriggers($id);
        $botTriggersIdArray = array_map(function ($trigger) {
            return $trigger['id'];
        }, $botTriggers->toArray());
        return view('bot/update-bot', ['bot' => $bot, 'chains' => $chains, 'triggers' => $triggers], ['botIdTriggersArray' => $botTriggersIdArray]);
    }

    public function changeBotChain(Request $request, string $botId) {
        $jsonData = $request->getContent();
        $data = json_decode($jsonData);
        $chainId = $data->chainId;
        $this->botService->changeBotChain($botId, $chainId);
    }

    public function updateBotTriggers(Request $request, string $botId) {
        $jsonData = $request->getContent();
        $data = json_decode($jsonData);
        $triggers = $data->triggers;
        $this->triggerService->addTriggersToBot($triggers, $botId);
    }
}