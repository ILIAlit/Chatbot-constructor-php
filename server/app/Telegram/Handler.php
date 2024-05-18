<?php

namespace app\Telegram;
use App\Http\Controllers\UserController;
use App\Models\TriggerModel;
use App\Services\BotServices;
use App\Services\ChainServices;
use App\Services\TimeServices;
use App\Services\TriggerServices;
use App\Services\UserServices;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Stringable;

class Handler extends WebhookHandler {
	private UserServices $userServices;
	private ChainServices $chainServices;
	private BotServices $botServices;
	private TimeServices $timeServices;

	private TriggerServices $triggerServices;

	public function __construct(UserServices $userServices, BotServices $botServices, ChainServices $chainServices, TimeServices $timeServices, TriggerServices $triggerServices) {
		$this->userServices = $userServices;
		$this->botServices = $botServices;
		$this->chainServices = $chainServices;
		$this->timeServices = $timeServices;
		$this->triggerServices = $triggerServices;
	}
	public function start(string $request) {
		$name = $this->message->from()->firstName();
		$lastName = $this->message->from()->lastName();
		$userName = $this->message->from()->username();
		$botId = $this->bot->id;
		$chatId = $this->message->chat()->id();

		$user  = $this->botServices->checkUserIsRegistered($botId, $userName);
		if (!$user) {
			$user = $this->userServices->createUser($name, $lastName, $userName, $botId, $chatId);
		} else {
			$this->userServices->updateUser(null , 0, $user->id);	
		}
		
		$chain = $this->botServices->getBotChain($botId);
		if(!$chain) {
			$this->reply(message: 'Бот в разработке!');
			return;	
		}
		$stages = $this->chainServices->getChainStages($chain->id);
		foreach($stages as $stage) {
			if($stage->pause === 0) {
				$this->reply(message: $stage->text);
			} else {
				$userTtu = $this->timeServices->getUserTtu($stage->pause);
				$this->userServices->updateUser($userTtu,$stage->order, $user->id);
				break;
			}
		}	
	}

	protected function handleChatMessage(Stringable $text): void {
		Log::info(json_encode($this->message, flags: JSON_UNESCAPED_UNICODE));
		$botId = $this->bot->id;
		$chatId = $this->message->chat()->id();
		$trigger = $this->triggerServices->getOneBotTrigger($botId,$text);
		if($trigger) {
            $this->reply(message: $trigger->text);
            return;
        }
	}
}