@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Admin Dashboard</h1>

        <div class="users-management">
            <h2>User Management</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Actions</th>
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
                            <a href="{{ route('assignBadge', $user->id) }}">Assign Badge</a>
                        </td>
                    </tr>
                @endforeach

            </table>
        </div>

        <div class="badges-management">
            <h2>Badges Management</h2>
            <a href="{{ route('badges.index') }}" class="btn btn-primary">View All Badges</a>
            <a href="{{ route('badges.create') }}" class="btn btn-success">Create New Badge</a>
        </div>
    </div>
@endsection
