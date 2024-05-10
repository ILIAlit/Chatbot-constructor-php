<?php

namespace App\Services;
use App\Models\BotModel;
use App\Models\TBotModel;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Support\Facades\DB;

class BotServices {
	public function createBot(string $token, string $name) {
		try {
			DB::transaction(function () use ($token, $name) {
				$bot = TelegraphBot::create([
					'token' => $token,
					'name' => $name
				]);
				$bot->info();
				/** @var TelegraphBot $bot */
				$bot->registerWebhook()->send();
			});
		} catch (\Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}

	public function getBotById(int $id) : TelegraphBot {
		$bot = TelegraphBot::find($id);
        return $bot;
	}
}