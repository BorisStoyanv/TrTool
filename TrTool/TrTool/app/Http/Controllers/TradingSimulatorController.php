<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\User;


class TradingSimulatorController extends Controller
{
    public function index()
{
    
    if (auth()->check()) {
        $lastPlayedAt = auth()->user()->last_played_at;
        if ($lastPlayedAt && $lastPlayedAt->isToday()) {
            return redirect()->route('leaderboard')->with('message', 'You can play only once a day.');
        }
    }

    if (!session()->has('initialized')) {
        session()->put('currentPrice', rand(1, 100));
        session()->put('balance', 1000);
        session()->put('stocks', 0);
        session()->put('round', 1);
        session()->put('initialized', true);
        session()->forget('action'); // Reset the action
    }

    $currentPrice = session('currentPrice');
    $balance = session('balance');
    $stocks = session('stocks');
    $round = session('round');
    $action = session('action');

    return view('trading-simulator', compact('currentPrice', 'balance', 'stocks', 'round', 'action'));
}
    
    
    public function simulate(Request $request)
    {
       
        $currentPrice = session('currentPrice', rand(1, 100));
        $balance = session('balance', 1000);
        $stocks = session('stocks', 0);
        $round = session('round', 1);
        $action = 'hold';
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
            $profit = round($profit, 3);
            if (auth()->check()) {
                $user = auth()->user();
                $user->last_played_at = now();
                $user->profit = $profit;
                $user->save();
            }

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

    public function leaderboard()
    {
        $users = User::where('profit', '>', 0)->orderBy('profit', 'desc')->get();
        return view('leaderboard', ['users' => $users]);
    }
}
  