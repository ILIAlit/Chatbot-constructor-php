<?php

namespace app\Telegram;
use App\Http\Controllers\UserController;
use App\Models\ChainModel;
use App\Models\TriggerModel;
use App\Models\UserModel;
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
        $botId = $this->bot->id;
        $chatId = $this->message->chat()->id();
        $user = $this->getUser($botId, $chatId);
        $chain = $this->getChain($user);
        $this->processStages($chain, $user, $botId);
    }

    private function getUser(int $botId, int $chatId): UserModel {
        $name = $this->message->from()->firstName();
        $lastName = $this->message->from()->lastName();
        $userName = $this->message->from()->username();

        $user  = $this->botServices->checkUserIsRegistered($botId, $userName);
        if (!$user) {
            return $this->userServices->createUser($name, $lastName, $userName, $botId, $chatId);
        } else {
            $this->userServices->updateUser(null , 0, $user->id);
            return $user;
        }
    }

    private function getChain(UserModel $user): ChainModel | null {
        $botId = $this->bot->id;
        $chain = $this->botServices->getBotChain($botId);
        if(!$chain) {
            $this->reply(message: 'Бот в разработке!');
            return null;
        }
        return $chain;
    }

    private function processStages(ChainModel $chain, UserModel $user, int $botId): void {
        $bot = $this->botServices->getBotById($botId);
        $stages = $this->chainServices->getChainStages($chain->id);
        Log::info(json_encode($stages, flags: JSON_UNESCAPED_UNICODE));
        foreach($stages as $stage) {
            if(isset($stage->time)) {
                $checkUserRegisterTime = $this->timeServices->checkUserRegisterTime($bot->webinar_start_time, $user->created_at);
                if($checkUserRegisterTime) {
                    $userTtu = $this->timeServices->getUserTtuFoTime(1, $stage->time);
                    $this->userServices->updateUser($userTtu,$stage->order, $user->id);
                } else {
                    $userTtu = $this->timeServices->getUserTtuFoTime(0, $stage->time);
                    $this->userServices->updateUser($userTtu,$stage->order, $user->id);
                }
                break;
            }
            if(isset($stage->pause)) {

                if($stage->pause === 0) {
                    $this->reply(message: $stage->text);
                } else {
                    $userTtu = $this->timeServices->getUserTtu($stage->pause);
                    $this->userServices->updateUser($userTtu,$stage->order, $user->id);
                    break;
                }
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