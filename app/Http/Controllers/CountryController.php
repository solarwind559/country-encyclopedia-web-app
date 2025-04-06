<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        $favorites = Country::where('is_favorite', true)->get();
        return view('home', compact('favorites', 'countries'));
    }

    public function show($id)
    {
        $country = Country::findOrFail($id);
        $neighbors = Country::whereIn('country_code', json_decode($country->neighbors))->get();
        return view('countries.show', compact('country', 'neighbors'));
    }

    public function countriesByLanguage($language)
    {
        $countries = Country::whereJsonContains('languages', $language)->get();
        return view('countries.language', compact('language', 'countries'));
    }

    public function toggleFavorite($id)
    {
        $country = Country::findOrFail($id);
        $country->is_favorite = !$country->is_favorite;
        $country->save();

        $message = $country->is_favorite
        ? '<strong>' . $country->name . '</strong> was added to favorites'
        : '<strong>' . $country->name . '</strong> was removed from favorites';

        return redirect()->back()->with('success', $message);
    }

    public function showFavorites()
    {
        $favorites = Country::where('is_favorite', true)->get();
        return view('home', compact('favorites'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $countries = Country::where('name', 'LIKE', "%{$query}%")
            ->orWhere('official_name', 'LIKE', "%{$query}%")
            ->orWhereRaw('JSON_SEARCH(translations, "one", ?) IS NOT NULL', ["{$query}"])
            ->get();

        $favorites = Country::where('is_favorite', true)->get();

        return view('home', compact('countries', 'favorites'));
    }

}
