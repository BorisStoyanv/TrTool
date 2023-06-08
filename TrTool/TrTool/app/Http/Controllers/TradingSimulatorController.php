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
    session()->forget('eventMessage');
    $currentPrice = session('currentPrice', rand(1, 100));
    $balance = session('balance', 1000);
    $stocks = session('stocks', 0);
    $round = session('round', 1);
    $temp;
    $action = $request->input('action');
    $quantity = $request->input('quantity');

    if ($action === 'buy') {
        if ($balance >= $currentPrice * $quantity) {
            $balance -= $currentPrice * $quantity;
            $stocks += $quantity;
        }
    } elseif ($action === 'sell') {
        if ($stocks >= $quantity) {
            $balance += $currentPrice * $quantity;
            $stocks -= $quantity;
        }
    }

    $stabilityIndex = session('stabilityIndex');
    $crashLikelihood = session('crashLikelihood');
    $geopoliticalWeight = session('geopoliticalWeight');
    $economicWeight = session('economicWeight');
    $socialWeight = session('socialWeight');
    $popularityWeight = session('popularityWeight');
    $restrictionWeight = session('restrictionWeight');

    $crashThisRound = (rand(0, 100) / 100) < $crashLikelihood;

    $randomFactor = rand(-50, 50) / 1000; 
    $positiveRandomFactor = abs($randomFactor);
    $negativeRandomFactor = -abs($randomFactor);

    $newPrice = $currentPrice;
    $eventMessage = session()->get('futureEventMessage', '');
    session()->forget('futureEventMessage'); 

    $futureEventMessage = '';

    if (rand(0, 100) / 100 < $popularityWeight) {
        $breakthroughSize = rand(0, 100) / 100 < 0.5 ? 'small' : 'big';
        $futureEventMessage .= "A $breakthroughSize technological breakthrough is expected. ";
        $newPrice *= (1 + ($breakthroughSize == 'small' ? $negativeRandomFactor*4 : $negativeRandomFactor * 8));
    }

    if (rand(0, 100) / 100 < $geopoliticalWeight) {
        $warSize = rand(0, 100) / 100 < 0.5 ? 'small' : 'big';
        $futureEventMessage .= "A $warSize war is expected. ";
        $newPrice *= (1 - ($warSize == 'small' ? $positiveRandomFactor*2 : $positiveRandomFactor * 4));

    }

    if (rand(0, 100) / 100 < $restrictionWeight) {
        $restrictionChange = rand(0, 100) / 100 < 0.5 ? 'increased' : 'decreased';
        $futureEventMessage .= "Restrictions are expected to be $restrictionChange. ";
        $newPrice *= (1 - ($restrictionChange == 'increased' ? $positiveRandomFactor*3 : $negativeRandomFactor*3));
    }    

    if ($futureEventMessage == '') {
        if ($stabilityIndex > 7) { 
            $newPrice *= (1 + $randomFactor / 2);
        } else { 
            $newPrice *= (1 + $randomFactor);
        }
    }


    $priceCeiling = 1000 * $stabilityIndex;
    if ($newPrice > $priceCeiling) {
        $newPrice = $priceCeiling;
    }

    session()->put('eventMessage', $eventMessage);
    session()->put('futureEventMessage', $futureEventMessage);

    $round++;
    if ($round > 10) {
        $profit = ($balance - 1000) + ($stocks * $currentPrice);

        if (auth()->check()) {
            $user = auth()->user();
            $user->last_played_at = now();
            $user->profit = $profit;
            $elo = $user->elo;
            $temp = $profit;
            if($profit >= 25){
                $profit = 25;
            }
            if($profit <= -30){
                $profit = -30;
            }

            $elo = intval(round($elo + $profit));
            $profit = $temp;
            $user->elo = $elo;
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
        'stabilityIndex' => $stabilityIndex,
        'crashLikelihood' => $crashLikelihood,
        'geopoliticalWeight' => $geopoliticalWeight,
        'economicWeight' => $economicWeight,
        'socialWeight' => $socialWeight,
        'popularityWeight' => $popularityWeight,
        'restrictionWeight' => $restrictionWeight,
        'eventMessage' => $eventMessage,
    ]);
}



    public function leaderboard()
    {
        $users = User::where('profit', '>', 0)->orderBy('profit', 'desc')->get();
        return view('leaderboard', ['users' => $users]);
    }
}
  