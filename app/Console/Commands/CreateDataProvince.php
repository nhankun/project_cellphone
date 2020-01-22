<?php

namespace App\Console\Commands;

use App\Models\Province;
use Illuminate\Console\Command;

class CreateDataProvince extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'province:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command create province';

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
     * @return mixed
     */
    public function handle()
    {
        $provinces = trans('province_of_vietnam.province');

        foreach ($provinces as $key =>  $province){
            Province::create([
                'key' => $key,
                'name' => $province
            ]);
        }

        echo "done";
    }
}
