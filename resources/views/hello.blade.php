@extends('layouts.app')

@section('content')

    <p>This is my first Blade view.</p>

    <p>Welcome, {{ $name }}</p>



    @if ($isAdmin)
        <p>Welcome Admin!</p>
    @else
        <p>Welcome User!</p>
    @endif

    <ul>
        @foreach ($fruits as $fruit)
            <li>{{ $fruit }}</li>
        @endforeach
    </ul>
    
    <ul>
        @forelse ($fruits as $fruit)
            <li>{{ $fruit }}</li>
        @empty
            <li>No fruits found.</li>
        @endforelse
    </ul>

@endsection
