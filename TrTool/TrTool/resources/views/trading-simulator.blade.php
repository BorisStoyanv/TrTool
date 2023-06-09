<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>Trading Simulator</title>
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
    <div >
    <div class="card">
        <h1 class="text-2xl mb-4">Trading Simulator</h1>
        <p>Stability Index: {{ $stabilityIndex }}</p>
        <p>Crash Likelihood: {{ $crashLikelihood }}</p>
        <p>Geopolitical Weight: {{ $geopoliticalWeight }}</p>
        <p>Economic Weight: {{ $economicWeight }}</p>
        <p>Social Weight: {{ $socialWeight }}</p>
        <p>Popularity Weight: {{ $popularityWeight }}</p>
        <p>Restriction Weight: {{ $restrictionWeight }}</p>
        <form method="POST" action="{{ route('simulate') }}" class="text-gray-300">
            @csrf
            <p class="mb-4">Current price: ${{ $currentPrice }}</p>
            <input type="hidden" name="current_price" value="{{ $currentPrice }}">
            <input type="hidden" name="balance" value="{{ $balance }}">
            <input type="hidden" name="stocks" value="{{ $stocks }}">

            <div class="mb-4">
                <button type="submit" name="action" value="buy">Buy</button>
                <button type="submit" name="action" value="sell" >Sell</button>
                <button type="submit" name="action" value="hold" >Hold</button>
                <input type="number" id="quantity" name="quantity" step="1" min="0" value="1" required >
            </div>
        </form>
        @if (session('eventMessage'))
        <p>{{ session('eventMessage') }}</p>
        @endif
        <div class="results">
            <h2 class="text-xl mt-4">Results</h2>
            <p>Balance: ${{ $balance }}</p>
            <p>Stocks: {{ $stocks }}</p>
            <p>Profit: ${{ $profit ?? '' }}</p>
        </div>
    </div>
    </div>
</body>
</html>
