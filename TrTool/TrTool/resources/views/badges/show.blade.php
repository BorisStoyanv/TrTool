@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>{{ $badge->name }}</h1>
            <p>{{ $badge->description }}</p>

        </div>
    </div>
</div>
@endsection
