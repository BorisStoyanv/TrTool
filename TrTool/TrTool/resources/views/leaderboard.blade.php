<!DOCTYPE html>
<html>
<head>
    <title>Leaderboard</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('leaderboard.css') }}"/>

</head>
<body class="antialiased">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
<div class="leaderboard">
    
  <h1>
    <svg class="ico-cup">
      <use xlink:href="#cup"></use>
    </svg>
    Todays Leaderboard
  </h1>
  <ol>
    @foreach ($users as $user)
            <li>
                <mark>{{ $user->name }}</td>
                <small>${{ $user->profit }}</td>
            </li>
        @endforeach
  </ol>
</div>
@if (session('message'))
<a>{{ session('message') }}</a>
@endif
</div>
</body>
</html>