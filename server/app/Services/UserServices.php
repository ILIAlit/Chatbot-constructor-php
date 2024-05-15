<?php

namespace App\Services;
use App\Models\UserModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class UserServices {
	private TimeServices $timeService;
	private BotServices $botService;
	function __construct(TimeServices $timeService, BotServices $botService) {
		$this->timeService = $timeService;
		$this->botService = $botService;
	}
	public function createUser(string $name, string $last_name,string $userName, int $botId) {
			$bot = $this->botService->getBotById($botId);

			$user = new UserModel();
			$user->name = $name;
			$user->last_name = $last_name;
			$user->user_name = $userName;
			$user->stage = 0;
			
			$user->save();
			$bot->users()->attach($user);
			$bot->save();
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
                $user->stage = 0;
                $user->save();
            }
        }
	}
}