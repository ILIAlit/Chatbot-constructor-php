<?php

namespace App\Http\Controllers;

use App\Models\BotModel;
use App\Services\BotServices;
use Illuminate\Http\Request;

class BotController extends Controller
{
    private BotServices $botService;
    function __construct(BotServices $botService) {
        $this->botService = $botService;
    }
    public function create(Request $request) {
        $name = $request->input('name');
        $token = $request->input('token');
        $valid = $request->validate([
            'token' => 'required',
            'name' => 'required',
        ]);
        $this->botService->createBot($token, $name);
        return redirect()->route('home');
    }

    public function getAll() {
        $bots = BotModel::all();
        return view('home', ['bots' => $bots]);
    }
}