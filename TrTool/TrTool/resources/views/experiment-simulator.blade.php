<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Experiment Simulator</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('wind.css') }}"/>
    <style>
        body {
            color: #e2e8f0;
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background-color: rgba(74, 85, 104, 0.7);
            backdrop-filter: blur(10px); 
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 6px 0 hsla(0, 0%, 0%, 0.2);
            max-width: 800px;
            width: 90%;
        }

        h1, h2 {
            text-align: center;
            margin-bottom: 1em;
        }

        p {
            line-height: 1.5em;
            margin: 0.5em 0;
        }

        button {
            background-color: #718096;
            color: #e2e8f0;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-weight: 600;
            margin-right: 10px;
        }

        button:hover {
            background-color: #2d3748;
        }

        input[type="number"] {
            background-color: #2d3748;
            border: 1px solid #4a5568;
            color: #e2e8f0;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .results {
            margin-top: 20px;
            border-top: 1px solid #e2e8f0;
            padding-top: 20px;
        }
    </style>
</head>
<body class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
    <div class="card">
        <h1 class="text-2xl mb-4">Experiment Simulator</h1>
        <form action="{{ route('experiment-simulator.simulate') }}" method="POST" class="text-gray-300">
        @csrf
        <label for="stabilityIndex">Stability Index:</label>
        <input type="number" id="stabilityIndex" name="stabilityIndex"step="0.1" required>

        <label for="crashLikelihood">Crash Likelihood:</label>
        <input type="number" id="crashLikelihood" name="crashLikelihood"step="0.1" required>

        <label for="geopoliticalWeight" >Geopolitical Weight:</label>
        <input type="number" id="geopoliticalWeight" name="geopoliticalWeight" step="0.1"required>

        <label for="economicWeight">Economic Weight:</label>
        <input type="number" id="economicWeight" name="economicWeight"step="0.1" required>

        <label for="socialWeight">Social Weight:</label>
        <input type="number" id="socialWeight" name="socialWeight"step="0.1" required>

        <label for="popularityWeight">Popularity Weight:</label>
        <input type="number" id="popularityWeight" name="popularityWeight"step="0.1" required>

        <label for="restrictionWeight">Restriction Weight:</label>
        <input type="number" id="restrictionWeight" name="restrictionWeight"step="0.1"   required>

        <button type="submit">Start Simulation</button>
        </form>

        @isset($rounds)
        <div class="results">
            <h2 class="text-xl mt-4">Simulation Results</h2>
            <ul>
                @foreach ($rounds as $round => $price)
                    <li>Round {{ $round }}: ${{ number_format($price, 2) }}</li>
                @endforeach
            </ul>
        </div>
        @endisset
    </div>
</body>
</html>
