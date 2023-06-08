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

            $positiveRandomFactor = abs($randomFactor);
            $negativeRandomFactor = -abs($randomFactor);

            $newPrice = $currentPrice;

            if (rand(0, 100) / 100 < $popularityWeight) {
                $breakthroughSize = rand(0, 100) / 100 < 0.5 ? 'small' : 'big';
                $newPrice *= (1 + ($breakthroughSize == 'small' ? $positiveRandomFactor*2 : $positiveRandomFactor * 4));
            }

            if (rand(0, 100) / 100 < $geopoliticalWeight) {
                $warSize = rand(0, 100) / 100 < 0.5 ? 'small' : 'big';
                $newPrice *= (1 + ($warSize == 'small' ? $negativeRandomFactor*2 : $negativeRandomFactor * 4));
            }

            if (rand(0, 100) / 100 < $restrictionWeight) {
                $restrictionChange = rand(0, 100) / 100 < 0.5 ? 'increased' : 'decreased';
                $newPrice *= (1 + ($restrictionChange == 'increased' ? $negativeRandomFactor*2 : $positiveRandomFactor*2));
            }

            if ($stabilityIndex > 7) { 
                $newPrice *= (1 + $randomFactor / 2);
            } else { 
                $newPrice *= (1 + $randomFactor);
            }

            $priceCeiling = 1000 * $stabilityIndex;
            if ($newPrice > $priceCeiling) {
                $newPrice = $priceCeiling;
            }

            $currentPrice = $newPrice;
            $rounds[$round] = $currentPrice;
        }

        return view('experiment-simulator', ['rounds' => $rounds]);
    }
}
