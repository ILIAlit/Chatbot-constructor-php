<?php

namespace App\Services;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class TimeServices {
	public function getServerTime() {
		return new Carbon();
	}

	public function getUserTtu(int $pause) {
        $timeNow = $this->getServerTime();
		return $timeNow->addSeconds($pause);
    }

	public function getUserTtuFoTime(int $day, string $timeStage) {
		$carbonTimeStage = Carbon::parse($timeStage);
        return $carbonTimeStage->addDays($day);
	}

	public function checkUserRegisterTime(string | null $startTime, string $userRegisterTime) {
		if(!isset($startTime)) {
            return false;
        }
		return Carbon::parse($userRegisterTime) > Carbon::parse($startTime);
	}

	public function transformTimeToCarbon($time){
		$year = (int)$time->year;
		$month = (int)$time->month;
		$day = (int)$time->day;
		$hours = (int)$time->hour;
		$minutes = (int)$time->minute;
		$timeNow = $this->getServerTime();
		return $timeNow->year($year)->month($month)->day($day)->hours($hours)->minutes($minutes)->second(0);
	}

	public function transformToSeconds(int $hours, int $minutes, int $seconds){
		return ($hours * 3600) + ($minutes * 60) + $seconds;
	}
}