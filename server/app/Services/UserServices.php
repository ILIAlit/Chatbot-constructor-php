<?php

namespace App\Services;
use App\Models\UserModel;
use Illuminate\Support\Facades\Log;

class UserServices {
	private TimeServices $timeService;
	private BotServices $botService;
	function __construct(TimeServices $timeService, BotServices $botService) {
		$this->timeService = $timeService;
		$this->botService = $botService;
	}
	public function createUser(string $name, string $last_name,string $userName, int $botId) {
		$time = $this->timeService->getServerTime();
			$bot = $this->botService->getBotById($botId);

			$user = new UserModel();
			$user->name = $name;
			$user->last_name = $last_name;
			$user->user_name = $userName;
			$user->stage = 0;
			$user->ttu = $time;
			
			$user->save();
			$bot->users()->attach($user);
			$bot->save();
			return $user;
	}

	public function getUserByUserName(string $userName) {
        return UserModel::where('user_name', $userName)->first();
    }
}