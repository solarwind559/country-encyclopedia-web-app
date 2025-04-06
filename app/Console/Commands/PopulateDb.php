<?php

namespace App\Console\Commands;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class PopulateDb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:populate-db';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            // Fetch data from API with timeout and retry logic
            $response = Http::timeout(60) // Set timeout to 30 seconds
                            ->retry(3, 500) // Retry up to 3 times with 500ms delay
                            ->get('https://restcountries.com/v3.1/all');

            if ($response->ok()) {
                $countries = $response->json();

                // Sort countries by population
                $sortedCountries = collect($countries)->sortByDesc('population')->values();
                foreach ($sortedCountries as $rank => $country) {
                    Country::updateOrCreate(
                        ['name' => $country['name']['common']],
                        [
                            'official_name' => $country['name']['official'] ?? null,
                            'country_code' => $country['cca3'] ?? null,
                            'population' => $country['population'] ?? null,
                            'population_rank' => $rank + 1,
                            'flag' => $country['flags']['svg'] ?? null,
                            'area' => $country['area'] ?? null,
                            'neighbors' => json_encode($country['borders'] ?? []),
                            'languages' => json_encode(array_values($country['languages'] ?? [])),
                            'translations' => json_encode(collect($country['translations'] ?? [])
                                ->map(function ($translation) {
                                    return $translation['common'] ?? null;})
                                ->filter()
                                ->values()),
                        ]
                    );
                }

                $this->info('Countries data has been successfully populated!');
            } else {
                $this->error('API returned an error: ' . $response->status());
            }
        } catch (\Illuminate\Http\Client\RequestException $e) {
            $this->error('Failed to fetch data from the API. Error: ' . $e->getMessage());
        } catch (\Exception $e) {
            $this->error('An unexpected error occurred: ' . $e->getMessage());
        }
    }

}
