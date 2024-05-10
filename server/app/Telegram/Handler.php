<?php

namespace app\Telegram;
use App\Http\Controllers\UserController;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler {
	private UserController $userController;
	public function __construct(UserController $userController) {
		$this->userController = $userController;
	}
	public function start($message) {
		$name = $this->message->from()->firstName();
		$lastName = $this->message->from()->lastName();
		$this->userController->create($name, $lastName);
		$this->reply(message: '8=>');
	}

	protected function handleChatMessage(Stringable $text): void {
		//Log::info(json_encode($this->message, flags: JSON_UNESCAPED_UNICODE));
		//$this->reply(message: $this->message->from()->username());
		$this->reply(message: '8=>');
	}
}