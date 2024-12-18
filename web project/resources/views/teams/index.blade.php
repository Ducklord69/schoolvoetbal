<x-base-layout>
@extends('layouts.coach')

@section('content')

    <ul>
        @forelse ($teams as $team)
            <li>{{ $team->name }}</li>
        @empty
            <li>You have no teams yet.</li>
        @endforelse
    </ul>
@endsection
</x-base-layout>
