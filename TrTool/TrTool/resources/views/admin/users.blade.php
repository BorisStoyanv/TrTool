    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Created At</th>
        <br>
    </tr>
@foreach ($users as $user)
    <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->created_at }}</td>
        <td>
            @if ($user->is_admin)
                <form method="POST" action="/admin/remove-admin/{{ $user->id }}">
                    @csrf
                    <button type="submit">Remove Admin</button>
                </form>
            @endif
            @if (!($user->is_admin))
                <form method="POST" action="/admin/make-admin/{{ $user->id }}">
                    @csrf
                    <button type="submit">Make Admin</button>
                </form>
            @endif
        </td>
    </tr>
@endforeach
