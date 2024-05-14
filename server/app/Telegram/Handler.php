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
	private BotServices $botServices;
	public function __construct(UserServices $userServices, BotServices $botServices) {
		$this->userServices = $userServices;
		$this->botServices = $botServices;
	}
	public function start(string $request) {
		$name = $this->message->from()->firstName();
		$lastName = $this->message->from()->lastName();
		$userName = $this->message->from()->username();
		$botId = $this->bot->id;
		$userCandidate = $this->botServices->checkUserIsRegistered($botId, $userName);
		if (!$userCandidate) {
			$this->userServices->createUser($name, $lastName, $userName, $botId);
			$this->reply(message: 'Пользователь добавлен в БД');
		} else {
			$this->reply(message: 'Пользователь уже есть в БД');
		}
		Log::info(json_encode($userCandidate, flags: JSON_UNESCAPED_UNICODE));
		
	}

	protected function handleChatMessage(Stringable $text): void {
		Log::info(json_encode($this->message, flags: JSON_UNESCAPED_UNICODE));
		$this->reply(message: $this->message->from()->username());
		$this->reply(message: '8=>');
	}
}