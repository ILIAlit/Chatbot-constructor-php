<?php
namespace App\Services;

use App\Models\StageModel;
use App\Models\StageTimeModel;
use Illuminate\Support\Facades\DB;
use ResponsePause;

class StageServices {

	private TimeServices $timeService;

	public function __construct(TimeServices $timeService) {
        $this->timeService = $timeService;
    }

	public function createStage($stage) {
		if(isset($stage->time)) {
			return $this->createTimeStage($stage->text, $stage->order, $stage->time);
		}
		if(isset($stage->pause)) {
			return $this->createPauseStage($stage->text, $stage->order, $stage->pause);
		}
	}
	
	public function createPauseStage(string $textValue, string $orderValue,  $pauseValue) {

		$transformPause = $this->timeService->transformToSeconds((int)$pauseValue->hour, (int)$pauseValue->minute, (int)$pauseValue->second);
		$stageModel = new StageModel();
		$stageModel->text = $textValue;
		$stageModel->pause = $transformPause;
		$stageModel->order = $orderValue;
		return $stageModel;
		
	}

	public function createTimeStage(string $textValue, string $orderValue, $timeValue) {
		$transformTime = $this->timeService->transformTimeToCarbon($timeValue);
		$stageTimeModel = new StageTimeModel();
		$stageTimeModel->text = $textValue;
		$stageTimeModel->time = $transformTime;
		$stageTimeModel->order = $orderValue;
		return $stageTimeModel;
	}
}