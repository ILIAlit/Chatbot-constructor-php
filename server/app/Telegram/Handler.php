<?php

namespace app\Telegram;
use App\Http\Controllers\UserController;
use App\Services\BotServices;
use App\Services\UserServices;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler {
	private UserServices $userServices;
	public function __construct(UserServices $userServices) {
		$this->userServices = $userServices;
	}
	public function start(string $request) {
		$botservise = new BotServices();
		$name = $this->message->from()->firstName();
		$lastName = $this->message->from()->lastName();
		$botId = $this->bot->id;
		
		$bot = $this->userServices->createUser($name, $lastName, $botId);
		Log::info($botservise->getBotById($botId));
		$this->reply(message: '8=>');
	}

	protected function handleChatMessage(Stringable $text): void {
		Log::info(json_encode($this->message, flags: JSON_UNESCAPED_UNICODE));
		$this->reply(message: $this->message->from()->username());
		$this->reply(message: '8=>');
	}
}