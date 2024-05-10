<?php

namespace App\Services;
use Carbon\Carbon;

class TimeServices {
	public function getServerTime() {
		return new Carbon();
	}
}