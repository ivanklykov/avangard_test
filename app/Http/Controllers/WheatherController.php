<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\WhetherHelper;

class WheatherController extends Controller
{
    public function index()
    {
        $helper = new WhetherHelper('53.243326', '34.363731');
        $temperature = $helper->getTemperature();

        return view('wheather', [
            'temperature' => $temperature,
        ]);
    }
}
