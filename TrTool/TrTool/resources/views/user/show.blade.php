<h1>{{ $user->name }}'s Profile</h1>
<p>Highest Profit: ${{ $highestProfit }}</p>
<p>ELO: {{ $elo }}</p>

@php
    if ($elo < 610) {
        $rank = "Copper Cadet";
    } elseif ($elo >= 610 && $elo < 670) {
        $rank = "Silver Strategist";
    } elseif ($elo >= 670 && $elo < 720) {
        $rank = "   Gold Guardian";
    } elseif ($elo >= 720 && $elo < 800) {
        $rank = "Platinum Prodigy";
    } elseif ($elo >= 800 && $elo < 900) {
        $rank = "Diamond Dealer";
    } else {
        $rank = "Obsidian Overlord";
    }
@endphp
<p>Current Rank: {{ $rank }}</p>