<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExperimentSimulatorController extends Controller
{
    public function index()
    {
        return view('experiment-simulator');
    }
    
    public function simulate(Request $request)
    {
        $stabilityIndex = $request->input('stabilityIndex');
        $crashLikelihood = $request->input('crashLikelihood');
        $geopoliticalWeight = $request->input('geopoliticalWeight');
        $economicWeight = $request->input('economicWeight');
        $socialWeight = $request->input('socialWeight');
        $popularityWeight = $request->input('popularityWeight');
        $restrictionWeight = $request->input('restrictionWeight');

        $rounds = [];
        $currentPrice = 100; 
        for ($round = 1; $round <= 10; $round++) {
            $randomFactor = rand(-100, 100) / 1000; 

            $crashThisRound = (rand(0, 100) / 100) < $crashLikelihood;
            if ($crashThisRound) {
                $newPriceChangePercentage = -abs($randomFactor * (1 + $geopoliticalWeight + $economicWeight + $socialWeight + $popularityWeight + $restrictionWeight));
                
                $newPriceChangePercentage = max($newPriceChangePercentage, -1);
            } else {
                $newPriceChangePercentage = ($stabilityIndex > 7) ? ($randomFactor / 2) : ($randomFactor * (1 + $geopoliticalWeight + $economicWeight + $socialWeight + $popularityWeight + $restrictionWeight));
            }
            $currentPrice *= (1 + $newPriceChangePercentage);

            $rounds[$round] = $currentPrice;
        }

        return view('experiment-simulator', ['rounds' => $rounds]);
    }
}

