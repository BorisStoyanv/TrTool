@extends('layouts.app')

@section('content')
<form method="POST" action="{{ route('communities.store') }}">
    @csrf
    <input type="text" name="title" placeholder="Community Title">
    <textarea name="description" placeholder="Community Description"></textarea>
    <button type="submit">Create Community</button>
</form>
@endsection
