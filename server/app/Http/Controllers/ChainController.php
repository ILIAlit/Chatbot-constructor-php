<?php

namespace App\Http\Controllers;

use App\Services\ChainServices;
use Illuminate\Http\Request;
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
        $this->chainServices->createChain($title, $stages);
    }
}