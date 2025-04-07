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
        $countries = null;

        try {
            $this->info('Attempting to fetch data from the API...');

            // Fetch data from the API
            $response = Http::timeout(60)->retry(3, 500)->get('https://restcountries.com/v3.1/all');

            if ($response->ok()) {
                $countries = $response->json();
            } else {
                throw new \Exception('API responded with an error: ' . $response->status());
            }
        } catch (\Exception $e) {

            // Fallback to the JSON file in case the API fetch fails
            $this->warn('API fetch failed: ' . $e->getMessage());
            $this->warn('Using fallback JSON file data...');

            $filePath = storage_path('../api-data.json');
            if (!file_exists($filePath)) {
                $this->error('Fallback JSON file not found.');
                return;
            }

            $data = file_get_contents($filePath);
            $countries = json_decode($data, true);

            if (!$countries) {
                $this->error('Failed to decode the JSON file data.');
                return;
            }
        }

        if (!isset($countries) || empty($countries)) {
            $this->error('No data available to populate the database.');
            return;
        }

        // Sort countries: biggest by population
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
                            return $translation['common'] ?? null;
                        })
                        ->filter()
                        ->values()),
                ]
            );
        }

        $this->info('Countries populated successfully!');
    }

}
