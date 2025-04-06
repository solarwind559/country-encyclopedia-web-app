@extends('layouts.app')

@section('content')

    <div class="container mb-5 countries-home" id="top">

        {{-- Success Message for Favorites toggle --}}
        <success-alert
            :initial-message="'{!! session('success') !!}'"
            :timeout="2000">
        </success-alert>

        <h1 class="my-5 text-center">Country Encyclopedia</h1>

        <div class="row mb-4">
            <div class="col-12 col-md-6">

                {{-- Searchbox --}}
                <form method="GET" action="{{ route('countries.search') }}">
                    <div class="d-flex">
                        <input class="form-control" type="text" name="query" placeholder="Search for a country..."
                            required>
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </form>
                {{-- Ends Searchbox --}}

                {{-- Countries List --}}
                <div class="countries-list mt-3">
                    @if (isset($countries) && $countries->isNotEmpty())
                        <ul class="p-0 list-group">
                            @foreach ($countries as $country)
                                <li class="countries-wrap list-group-item d-flex justify-content-between">
                                    <ul class="p-0 country">
                                        <li class="mb-1">
                                            <a href="/countries/{{ $country->id }}">{{ $country->name }}</a>
                                        </li>
                                    </ul>
                                    <div class="favorite align-content-center">
                                        <form class="favorite-form" action="{{ route('countries.favorites', $country->id) }}" method="POST">
                                            @csrf
                                            <favorite-icon
                                                :is-favorite="{{ $country->is_favorite ? 'true' : 'false' }}"
                                                favorite-id="{{ $country->id }}">
                                            </favorite-icon>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @elseif(isset($countries))
                        <p>No countries found</p>
                    @endif
                </div>
                {{-- Ends Countries List --}}
            </div>

            <div class="col-12 col-md-6">
                {{-- Favorites List --}}
                <div class="favorites-list">
                    <h3 class="mt-3 mt-md-1 mb-3">Your Favorites</h3>
                    <ul class="p-0 list-group">
                        @forelse ($favorites as $favorite)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a class="" href="/countries/{{ $favorite->id }}">{{ $favorite->name }}</a>

                                {{-- Remove from Favorites Button --}}
                                <form class="favorite-form" action="{{ route('countries.favorites', $favorite->id) }}" method="POST">
                                    @csrf
                                    <favorite-icon
                                        :is-favorite="{{ $favorite->is_favorite ? 'true' : 'false' }}"
                                        favorite-id="{{ $favorite->id }}">
                                    </favorite-icon>
                                </form>

                            </li>
                        @empty
                            <p>You haven't added any countries to Favorites yet</p>
                        @endforelse
                    </ul>
                </div>
                {{-- Ends Favorites List --}}
            </div>
        </div>

        {{-- Return to Top Button, conditionally if the request doesn't have a query --}}
        @if (!request()->has('query'))
            <a class="btn btn-primary" href="#top">Return to Top</a>
        @else
            {{-- Back Button --}}
            <a href="{{ route('home') }}" class="btn btn-primary my-4">Back to All Countries</a>
        @endif

    </div>

@endsection