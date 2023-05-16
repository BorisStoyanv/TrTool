<!DOCTYPE html>
<html>
<head>
    <title>Trading Simulator</title>
</head>
<body>
    <h1>Trading Simulator</h1>

    <form method="POST" action="{{ route('simulate') }}">
        @csrf
        <p>Current price: ${{ $currentPrice }}</p>
        <input type="hidden" name="current_price" value="{{ $currentPrice }}">
        <input type="hidden" name="balance" value="{{ $balance }}">
        <input type="hidden" name="stocks" value="{{ $stocks }}">
        <button type="submit" name="action" value="buy">Buy</button>
        <button type="submit" name="action" value="sell">Sell</button>
        <button type="submit" name="action" value="hold">Hold</button>
    </form>

    <h2>Results</h2>
    <p>Balance: ${{ $balance }}</p>
    <p>Stocks: {{ $stocks }}</p>
    <p>Profit: ${{ $profit ?? '' }}</p>


    
</body>
</html>