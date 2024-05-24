<?php

namespace App\Services;
use App\Models\BotModel;
use App\Models\ChainModel;
use App\Models\TBotModel;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class TelegramServices {

	
	public function sendMessage($botToken, $chatId, $message) {
		$client = new Client();
		$response = $client->post("https://api.telegram.org/bot$botToken/sendMessage", [
			'form_params' => [
				'chat_id' => $chatId,
				'text' => $message,
			],
		]);
	}
}