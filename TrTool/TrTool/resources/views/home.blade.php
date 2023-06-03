@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    @if (auth()->user()->is_admin)
                        <div class="mt-3">
                            <a href="{{ route('admin.users') }}">Admin Dashboard</a>
                            <a href="{{ route('badges.index') }}">Badges</a>
                        </div>
                    @endif
               

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
