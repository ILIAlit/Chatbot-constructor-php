<?php

namespace App\Services;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserServices {
	private TimeServices $timeService;
	private BotServices $botService;
	private ChainServices $chainService;
	private TelegramServices $telegramService;

	function __construct(TimeServices $timeService, BotServices $botService, ChainServices $chainService, TelegramServices $telegramService) {
		$this->timeService = $timeService;
		$this->botService = $botService;
		$this->chainService = $chainService;
		$this->telegramService = $telegramService;
	}
	public function createUser(string $name, string $last_name,string $userName, int $botId, int $chatId) {
			$bot = $this->botService->getBotById($botId);

			$user = new UserModel();
			$user->name = $name;
			$user->last_name = $last_name;
			$user->user_name = $userName;
			$user->tg_chat_id = $chatId;
			$user->stage = 0;
			
			$bot->users()->save($user);
			return $user;
	}

	public function getUserByUserName(string $userName) {
        return UserModel::where('user_name', $userName)->first();
    }

	public function getUserById(int $userId) {
		return UserModel::find($userId);
	}

	public function updateUser($ttu,int $stage, int $userId) {
		$user = $this->getUserById($userId);
		$user->ttu = $ttu;
		$user->stage = $stage;
		$user->save();
	}

	public function checkUserTtu() {
			$users = UserModel::all();
			$timeNow = $this->timeService->getServerTime();
			foreach ($users as $user) {
				if ($timeNow > Carbon::parse($user->ttu)) {
					$bot = $this->botService->getBotById($user->telegraph_bot_id);
					$chain = $this->botService->getBotChain($bot->id);
					if(!$chain) {
						continue;
					}
					$stage = $this->chainService->getChainStageByOrder
					($chain->id, $user->stage);
					if(!$stage) {
						continue;
					}
					$this->telegramService->sendMessage($bot->token, $user->tg_chat_id, $stage->text);
					$nextStage = $this->chainService->getChainStageByOrder($chain->id, $user->stage + 1);
					if(!$nextStage) {
						Log::info($user->stage);
						$this->updateUser($timeNow,$user->stage + 1, $user->id);
						continue;
					}
					
					$userTtu = $this->timeService->getUserTtu($nextStage->pause);
					$this->updateUser($userTtu,$nextStage->order, $user->id);
				}
			}
		Log::info('Check');
	}
}