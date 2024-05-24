<?php

namespace App\Http\Controllers;

use App\Models\ChainModel;
use App\Models\StageModel;
use App\Services\ChainServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ChainController extends Controller
{
    private ChainServices $chainServices;
    public function __construct(ChainServices $chainServices) {
        $this->chainServices = $chainServices;
    }

    public function createChain(Request $request) {
        $jsonData = $request->getContent();
        $data = json_decode($jsonData);
        $stages = $data->stages;
        $title = $data->title;
        $webinar_start_time = $data->webinar_start_time;
        if(!$webinar_start_time) {
            $webinar_start_time = null;
        }
        $this->chainServices->createChain($title, $stages, $webinar_start_time);
        return redirect()->route('chain');
    }

    public function getAll() {
        $chains = ChainModel::all();
        return view('chain/chain', ['chains' => $chains]);
    }

    public function deleteChain(Request $request, string $chainId) {
        DB::transaction(function () use ($chainId) {
            $chain = ChainModel::find($chainId);
            $chain->stages()->delete();
            $chain->delete();
            return redirect()->route('chain');
        });
    }
}