<?php

namespace App\Http\Controllers;

use App\Services\TriggerServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TriggerController extends Controller
{
    private TriggerServices $triggerServices;
    
    public function __construct(TriggerServices $triggerServices) {
        $this->triggerServices = $triggerServices;
    }

    public function index() {
        return view('trigger/trigger');
    }

    public function create(Request $request) {
        $trigger = $request->input('trigger');
        $text = $request->input('text');
        $valid = $request->validate([
            'trigger' => 'required',
            'text' => 'required',
        ]);
        $this->triggerServices->createTrigger($trigger, $text);
        return redirect()->route('home');
    }
}