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
        session()->put('stabilityIndex', rand(1, 10));
        session()->put('crashLikelihood', rand(0, 100) / 100);
        session()->put('geopoliticalWeight', rand(1, 100) / 100);
        session()->put('economicWeight', rand(1, 100) / 100);
        session()->put('socialWeight', rand(1, 100) / 100);
        session()->put('popularityWeight', rand(1, 100) / 100);
        session()->put('restrictionWeight', rand(1, 100) / 100);
        session()->put('initialized', true);
        session()->forget('action');
    }

    $currentPrice = session('currentPrice');
    $balance = session('balance');
    $stocks = session('stocks');
    $round = session('round');
    $action = session('action');
    $stabilityIndex = session('stabilityIndex');
    $crashLikelihood = session('crashLikelihood');
    $geopoliticalWeight = session('geopoliticalWeight');
    $economicWeight = session('economicWeight');
    $socialWeight = session('socialWeight');
    $popularityWeight = session('popularityWeight');
    $restrictionWeight = session('restrictionWeight');

   

    return view('trading-simulator', [
        'currentPrice' => $currentPrice,
        'balance' => $balance,
        'stocks' => $stocks,
        'round' => $round,
        'stabilityIndex' => $stabilityIndex,
        'crashLikelihood' => $crashLikelihood,
        'geopoliticalWeight' => $geopoliticalWeight,
        'economicWeight' => $economicWeight,
        'socialWeight' => $socialWeight,
        'popularityWeight' => $popularityWeight,
        'restrictionWeight' => $restrictionWeight, 
    ]);
    
}
    
    
public function simulate(Request $request)
{

    $currentPrice = session('currentPrice', rand(1, 100));
    $balance = session('balance', 1000);
    $stocks = session('stocks', 0);
    $round = session('round', 1);

    $action = $request->input('action');
    $quantity = $request->input('quantity');
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

    $stabilityIndex = session('stabilityIndex');
    $crashLikelihood = session('crashLikelihood');
    $geopoliticalWeight = session('geopoliticalWeight');
    $economicWeight = session('economicWeight');
    $socialWeight = session('socialWeight');
    $popularityWeight = session('popularityWeight');
    $restrictionWeight = session('restrictionWeight');


    $totalWeight = $geopoliticalWeight + $economicWeight + $socialWeight + $popularityWeight + $restrictionWeight;


    $crashThisRound = (rand(0, 100) / 100) < $crashLikelihood;

  
    $newPrice = $currentPrice;
    $randomFactor = rand(-100, 100) / 1000; 


    if ($crashThisRound) {
        $newPriceChangePercentage = -abs($randomFactor * (1 + $totalWeight)); 
    } 
   
    else {
        
        if ($stabilityIndex > 7) { 
            $newPriceChangePercentage = $randomFactor / 2; 
        } 
       
        else { 
            $newPriceChangePercentage = $randomFactor * (1 + $totalWeight);
        }
    }
    $newPrice = $currentPrice * (1 + $newPriceChangePercentage);

    $round++;
    if ($round > 10) {
        $profit = ($balance - 1000) + ($stocks * $currentPrice);

        if (auth()->check()) {
            $user = auth()->user();
            $user->last_played_at = now();
            $user->profit = $profit;
            if ($profit > $user->highest_profit) {
                $user->highest_profit = $profit;
            }
            $user->save();
        }

        session()->forget(['currentPrice', 'balance', 'stocks', 'round']);
        return view('trading-simulator-final', [
            'balance' => $balance,
            'stocks' => $stocks,
            'profit' => $profit,
        ]);
    }

 
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
  