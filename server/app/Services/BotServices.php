<?php

namespace App\Services;
use App\Models\BotModel;
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
				/** @var TelegraphBot $bot */
				$bot->registerWebhook()->send();
			});
		} catch (\Exception $e) {
			echo "Error: " . $e->getMessage();
		}
	}
}