<form method="POST" action="{{ route('assignBadge', $user) }}">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}">
    <select name="badge_id">
        @foreach($badges as $badge)
            <option value="{{ $badge->id }}">{{ $badge->name }}</option>
        @endforeach
    </select>
    <button type="submit">Assign Badge</button>
</form>
