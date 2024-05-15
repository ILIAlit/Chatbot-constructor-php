<?php
namespace App\Services;

use App\Models\ChainModel;
use App\Models\StageModel;
use Illuminate\Support\Facades\DB;

class ChainServices {
	
	public function createChain(string $title, array $stages) {
		DB::transaction(function() use ($title, $stages) {
			$chain = new ChainModel();
			$chain->title = $title;
			$chain->save();
			
			foreach ($stages as $stage) {
				$stageModel = new StageModel();
				$stageModel->text = $stage->text;
				$stageModel->pause = $stage->pause;
				$stageModel->order = $stage->order;
				$chain->stages()->save($stageModel);
			}
			return $chain;
		});
	}

	public function getAllChain() {
        return ChainModel::all();
    }

	public function getChainById($chainId) {
		return ChainModel::where('id', $chainId)->first();
    }

	public function getChainStages(int $chainId) {
		$chain = $this->getChainById($chainId);
		return $chain->stages()->get();	
    }
}