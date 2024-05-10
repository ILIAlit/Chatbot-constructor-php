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
	public function createUser(string $name, string $last_name, int $botId) {
		try {
			
		} catch (\Exception $e) {
			echo "Error: " . $e->getMessage();
		}
		$time = $this->timeService->getServerTime();
			$bot = $this->botService->getBotById($botId);

			$user = new UserModel();
			$user->name = $name;
			$user->last_name = $last_name;
			$user->stage = 0;
			$user->ttu = $time;
			
			$user->save();
			$bot->users()->attach($user);
			$bot->save();
			return $user;
	}
}