
    <h1>Experiment Simulator</h1>

    <form action="{{ route('experiment-simulator.simulate') }}" method="POST">
    @csrf
    <label for="stabilityIndex">Stability Index:</label>
    <input type="number" id="stabilityIndex" name="stabilityIndex" required>
    
    <label for="crashLikelihood">Crash Likelihood:</label>
    <input type="number" id="crashLikelihood" name="crashLikelihood" required>
    
    <label for="geopoliticalWeight">Geopolitical Weight:</label>
    <input type="number" id="geopoliticalWeight" name="geopoliticalWeight" required>
    
    <label for="economicWeight">Economic Weight:</label>
    <input type="number" id="economicWeight" name="economicWeight" required>
    
    <label for="socialWeight">Social Weight:</label>
    <input type="number" id="socialWeight" name="socialWeight" required>
    
    <label for="popularityWeight">Popularity Weight:</label>
    <input type="number" id="popularityWeight" name="popularityWeight" required>
    
    <label for="restrictionWeight">Restriction Weight:</label>
    <input type="number" id="restrictionWeight" name="restrictionWeight" required>

    <button type="submit">Start Simulation</button>
</form>

    @isset($rounds)
        <h2>Simulation Results</h2>
        <ul>
            @foreach ($rounds as $round => $price)
                <li>Round {{ $round }}: ${{ $price }}</li>
            @endforeach
        </ul>
    @endisset

