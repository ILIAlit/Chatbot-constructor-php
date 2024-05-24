<?php

// namespace App\Services;
// use App\Models\ChainModel;
// use App\Models\StageModel;
// use App\Models\StageTimeModel;
// use App\Models\UserModel;
// use Carbon\Carbon;
// use DefStudio\Telegraph\Models\TelegraphBot;
// use Illuminate\Support\Facades\Log;

// class ProcessTtuServices {
// 	private TimeServices $timeService;
// 	private BotServices $botService;
// 	private ChainServices $chainService;
// 	private TelegramServices $telegramService;

// 	private UserServices $userService;

// 	function __construct(TimeServices $timeService, BotServices $botService, ChainServices $chainService, TelegramServices $telegramService, UserServices $userService) {
// 		$this->timeService = $timeService;
// 		$this->botService = $botService;
// 		$this->chainService = $chainService;
// 		$this->telegramService = $telegramService;
// 		$this->userService = $userService;
// 	}

// 	public function processCheckUserTtu() {
//         $users = UserModel::all();
//         $timeNow = $this->timeService->getServerTime();

//         foreach ($users as $user) {
//             if ($timeNow > Carbon::parse($user->ttu)) {
// 				$bot = $this->botService->getBotById($user->telegraph_bot_id);
// 				$chain = $this->botService->getBotChain($bot->id);
// 				if(!$bot) {
// 					return;
// 				}
// 				if(!$chain) {
// 					return;
// 				}
// 				$this->processChain($user, $bot, $chain, $timeNow);
// 			}
//         }
//     }

//     private function processChain(UserModel $user, TelegraphBot $bot, ChainModel $chain, $timeNow) {
//         $stage = $this->chainService->getChainStageByOrder($chain->id, $user->stage);

//         if(!$stage) {
//             return;
//         }

//         $this->telegramService->sendMessage($bot->token, $user->tg_chat_id, $stage->text);
//         $nextStage = $this->chainService->getChainStageByOrder($chain->id, $user->stage + 1);

//         if(!$nextStage) {
//             $this->userService->updateUser($timeNow,$user->stage + 1, $user->id);
//             return;
//         }

//         $this->processNextStage($user, $bot, $nextStage);
//     }

//     private function processNextStage(UserModel $user, TelegraphBot $bot, StageModel | StageTimeModel $nextStage) {
//         if(isset($nextStage->time)) {
//             $checkUserRegisterTime = $this->timeService->checkUserRegisterTime($bot->webinar_start_time, $user->created_at);
//             $userTtu = $this->timeService->getUserTtuFoTime($checkUserRegisterTime ? 1 : 0, $nextStage->time);
//             $this->userService->updateUser($userTtu,$nextStage->order, $user->id);
//             return;
//         }

//         $userTtu = $this->timeService->getUserTtu($nextStage->pause);
//         $this->userService->updateUser($userTtu,$nextStage->order, $user->id);
//     }

// }