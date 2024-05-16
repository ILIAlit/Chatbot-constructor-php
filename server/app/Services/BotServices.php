<?php

namespace App\Services;
use App\Models\BotModel;
use App\Models\ChainModel;
use App\Models\TBotModel;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Support\Facades\DB;

class BotServices {

	private ChainServices $chainService;
	public function __construct(ChainServices $chainService) {
        $this->chainService = $chainService;
    }
	public function createBot(string $token, string $name) {
		try {
			DB::transaction(function () use ($token, $name) {
				$bot = TelegraphBot::create([
					'token' => $token,
					'name' => $name
				]);
				$bot->info();
				$bot->save();
				/** @var TelegraphBot $bot */
				$bot->registerWebhook()->send();
			});
		} catch (\Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function changeBotChain(int $botId, int $chainId) {
		$bot = $this->getBotById($botId);
        $bot->chain_model_id = $chainId;
		$bot->save();
	}

	public function getBotChain($botId) {
		$bot = $this->getBotById($botId);
        $chainId = $bot->chain_model_id;
		$chain = $this->chainService->getChainById($chainId);
        return $chain;
	}

	public function getBotById(int $id) : TelegraphBot {
		$bot = TelegraphBot::find($id);
        return $bot;
	}

	public function checkUserIsRegistered(int $botId, string $userName) {
		$bot = $this->getBotById($botId);
        $user = $bot->users()->where('user_name', $userName)->first();
        if ($user) {
            return $user;
        }
        return false;
	}
}