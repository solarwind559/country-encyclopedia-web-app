@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Countries with Official Language "{{ $language }}"</h2>
    @if ($countries->isNotEmpty())
        <ul class="list-group">
            @foreach ($countries as $country)
                <li class="list-group-item">
                    <a href="{{ route('countries.show', $country->id) }}">
                        {{ $country->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @else
        <p class="text-muted">No countries found that speak this language.</p>
    @endif

    <div class="my-4">
        <a href="{{ route('home') }}" class="btn btn-primary">Back to All Countries</a>
    </div>
</div>
@endsection
