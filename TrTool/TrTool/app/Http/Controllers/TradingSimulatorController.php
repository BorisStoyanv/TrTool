<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;

class TradingSimulatorController extends Controller
{
    public function index()
    {
      
        $currentPrice = session('currentPrice', rand(1, 100));
        $balance = session('balance', 1000);
        $stocks = session('stocks', 0);
        $round = session('round', 1);
    

        return view('trading-simulator', [
            'currentPrice' => $currentPrice,
            'balance' => $balance,
            'stocks' => $stocks,
            'round' => $round,
        ]);
    }
    
    public function simulate(Request $request)
    {
       
        $currentPrice = session('currentPrice', rand(1, 100));
        $balance = session('balance', 1000);
        $stocks = session('stocks', 0);
        $round = session('round', 1);
    
        $action = $request->input('action');
        $quantity = 1;
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
    
      
        $round++;
        if ($round > 10) {
            $profit = ($balance - 1000) + ($stocks * $currentPrice);
            session()->forget(['currentPrice', 'balance', 'stocks', 'round']);
            return view('trading-simulator-final', [
                'balance' => $balance,
                'stocks' => $stocks,
                'profit' => $profit,
            ]);
        }
    
      
        $newPrice = $currentPrice * (1 + (rand(-100, 100) / 1000)); 
        session([
            'currentPrice' => $newPrice,
            'balance' => $balance,
            'stocks' => $stocks,
            'round' => $round,
        ]);
    
    
        return view('trading-simulator', [
            'currentPrice' => $newPrice,
            'balance' => $balance,
            'stocks' => $stocks,
            'round' => $round,
        ]);
    }
    
}    