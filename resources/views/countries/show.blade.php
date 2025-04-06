@extends('layouts.app')
@section('content')

    <div class="container mt-5 country-details">

        {{-- Success Message for Favorites toggle --}}
        <success-alert
            :initial-message="'{!! session('success') !!}'"
            :timeout="2000">
        </success-alert>

        <div class="row">

            {{-- Country Details --}}
            <div class="col-12 col-md-6">
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between country-name-wrap">
                        <h1>{{ $country->name }}</h1>
                        <form action="{{ route('countries.favorites', $country->id) }}" method="POST">
                            @csrf
                            <favorite-icon class="custom-btn country-details-btn"
                                :is-favorite="{{ $country->is_favorite ? 'true' : 'false' }}"
                                favorite-id="{{ $country->id }}">
                            </favorite-icon>
                        </form>
                    </li>
                    <li class="list-group-item flag d-flex">
                        <img src="{{ $country->flag }}" alt="Flag of {{ $country->name }}" class="img-flag">
                    </li>
                    <li class="list-group-item"><strong>Common Name:</strong> {{ $country->name }}</li>
                    <li class="list-group-item"><strong>Official Name:</strong> {{ $country->official_name }}</li>
                    <li class="list-group-item"><strong>Country Code:</strong> {{ $country->country_code }}</li>
                    <li class="list-group-item"><strong>Population:</strong> {{ number_format($country->population) }}</li>
                    <li class="list-group-item"><strong>Population Rank:</strong> {{ $country->population_rank }}</li>
                    <li class="list-group-item"><strong>Area:</strong> {{ number_format($country->area) }} km²</li>

                    {{-- Neighboring Countries List --}}
                    <li class="list-group-item d-flex flex-wrap">
                        <strong class="mr-1">Neighboring Countries:</strong>
                        @if ($neighbors->isNotEmpty())
                            @foreach ($neighbors as $neighbor)
                                <span class="mr-1">
                                    <a class="badge bg-primary" href="{{ route('countries.show', $neighbor->id) }}">
                                        {{ $neighbor->name }}
                                    </a>
                                </span>
                            @endforeach
                        @else
                            <p class="text-muted">None</p>
                        @endif
                    </li>

                    {{-- Languages List --}}
                    <li class="list-group-item d-flex flex-wrap">
                        <strong class="mr-1">Languages:</strong>

                        @foreach (json_decode($country->languages) as $language)
                            <span class="mr-1">
                                <a href="{{ route('countries.language', ['language' => $language]) }}"
                                    class="badge bg-primary">
                                    {{ $language }}
                                </a>
                            </span>
                        @endforeach
                    </li>
                </ul>
            </div>

        </div>

        {{-- Back Button --}}
        <a href="{{ route('home') }}" class="btn btn-primary my-4">Back to All Countries</a>

    </div>
@endsection
