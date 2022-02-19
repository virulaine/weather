<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\City;

class ParseData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse {fileName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse weather data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $fileName = $this->argument('fileName');

        if (Storage::disk('local')->exists($fileName)) {

            $path = Storage::disk('local')->path($fileName);

            foreach ($this->getLines($path) as $n => $line) {

                echo "Processing line " . ++$n . PHP_EOL;

                $data = json_decode($line);

                $city = City::updateOrCreate(
                    ['external_id' =>  $data->city->id],
                    [
                        'external_id' => $data->city->id,
                        'name' => $data->city->name,
                        'country' => $data->city->country,
                        'lat' => $data->city->coord->lat,
                        'lon' => $data->city->coord->lon,
                    ]
                );

                foreach ($data->data as $weather) {

                    $city->weather()->updateOrCreate(
                        ['timestamp' =>  $weather->dt],
                        [
                            'temp' => $weather->temp->day,
                            'pressure' => $weather->pressure,
                            'humidity' => $weather->humidity,
                        ]
                    );
                }
            }
        }

        return 0;
    }

    private function getLines($file)
    {
        $f = fopen($file, 'r');

        try {
            while ($line = fgets($f)) {
                yield $line;
            }
        } finally {
            fclose($f);
        }
    }
}
