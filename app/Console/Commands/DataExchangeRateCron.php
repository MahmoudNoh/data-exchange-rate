<?php

namespace App\Console\Commands;

use App\Models\DataExchangeRate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Rodenastyle\StreamParser\StreamParser;
use Tightenco\Collect\Support\Collection;

class DataExchangeRateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data_exchange_rate:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save data exchange rate from  https://www.bnr.ro/nbrfxrates.xml to database';

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
        Log::info("Cron is working fine!");

        StreamParser::xml('https://www.bnr.ro/nbrfxrates.xml')->each(function(Collection $dataset) {

            if($dataset->get('Cube') != null){
                $data = $dataset->get('Cube');
                $date = $data['date'];

                unset($data['date']);

                foreach ($data as $item){
                    DataExchangeRate::create([
                        'currency_code' => $item['currency'],
                        'date'=> $date,
                        'rate'=> $item['Rate'],
                    ]);
                }
            }

        });
        Log::info('data_exchange_rate:Cron Command Run successfully!');
    }
}
