<form method="POST" action="{{ route('assignBadge.post', $user) }}">
    @csrf
    <select name="badge_id">
        @foreach ($badges as $badge)
            <option value="{{ $badge->id }}">{{ $badge->name }}</option>
        @endforeach
    </select>
    <button type="submit">Assign Badge</button>
</form>
