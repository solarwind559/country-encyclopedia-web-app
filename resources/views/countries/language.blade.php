@extends('layouts.app')

@section('content')
<div class="container mb-4">

    <h1 class="my-5">Countries with Official Language "{{ $language }}"</h1>

    @if ($countries->isNotEmpty())
        <ul class="list-group">
            @foreach ($countries as $country)
                <li class="languages-wrap list-group-item">
                    <a href="{{ route('countries.show', $country->id) }}">
                        {{ $country->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif

    {{-- Back Button --}}
    <a href="{{ route('home') }}" class="btn btn-primary my-4">Back to All Countries</a>

</div>
@endsection
