<?php

namespace App\Console\Commands;

use App\Models\District;
use App\Models\Province;
use Illuminate\Console\Command;

class CreateDataDistrict extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'district:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command create district';

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
        $provinces = Province::pluck('id','key')->all();
        $districts = trans('districts_of_province');
        foreach ($districts as $key =>  $district)
        {
            if (in_array($key, array_keys($provinces)) == true)
            {
                foreach ($district as $k => $dt)
                {
                    District::create([
                        'key_province' => $key,
                        'province_id' => $provinces[$key],
                        'key' => $k,
                        'name' => $dt,
                    ]);
                }

            }else{
                echo 'ERROR';
            }
        }

        echo "done";
    }
}
