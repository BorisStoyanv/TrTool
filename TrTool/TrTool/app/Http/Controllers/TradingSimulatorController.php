<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TradingSimulatorController extends Controller
{
    public function index()
    {
        $currentPrice = rand(1, 100);
        $balance = Session::get('balance', 1000);
        $stocks = Session::get('stocks', 0);

        return view('trading-simulator', [
            'currentPrice' => $currentPrice,
            'balance' => $balance,
            'stocks' => $stocks,
        ]);
    }

    public function simulate(Request $request)
    {
        $action = $request->input('action');
        $currentPrice = $request->input('current_price');
        $balance = $request->input('balance');
        $stocks = $request->input('stocks');

        $quantity = 1; // Fixed quantity for simplicity
        $profit = 0;

        if ($action === 'buy') {
            if ($balance >= $currentPrice * $quantity) {
                $balance -= $currentPrice * $quantity;
                $stocks += $quantity;
            }
        } elseif ($action === 'sell') {
            if ($stocks >= $quantity) {
                $balance += $currentPrice * $quantity;
                $stocks -= $quantity;
                $profit = ($currentPrice * $quantity) - ($currentPrice * (1 - 0.05) * $quantity);
            }
        }

        Session::put('balance', $balance);
        Session::put('stocks', $stocks);

        $newPrice = rand(1, 100);

        return view('trading-simulator', [
            'currentPrice' => $newPrice,
            'balance' => $balance,
            'stocks' => $stocks,
            'profit' => $profit,
        ]);
    }
}