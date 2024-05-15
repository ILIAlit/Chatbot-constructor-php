<?php

namespace App\Services;
use Carbon\Carbon;

class TimeServices {
	public function getServerTime() {
		return new Carbon();
	}

	public function getUserTtu(int $pause) {
        $timeNow = $this->getServerTime();
		return $timeNow->addSeconds($pause);
    }
}