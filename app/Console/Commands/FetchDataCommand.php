<?php

namespace App\Console\Commands;

use App\Models\Task;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class FetchDataCommand extends Command
{
    private $apis;
    private $api_fields;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch data from api providers';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->apis = config('api_providers');
        $this->api_fields = ["level", "duration", "task_id"];
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Fetching data....');
        $this->getApiData();
        $this->info('Successfully fetched.');
        return 0;
    }

    public function getApiData()
    {
        $result = Array();
        foreach ($this->apis as $api) {
            $result[$api["name"]] = Array();
            $response = Http::get($api["url"]);
            if ($response->successful()){
                $data = $response->json();
            } else $this->error("something went wrong.....");

            foreach ($data as $key => $value) {
                $tmp = Array("task_id" => "", "level" => "", "duration" => "");

                foreach ($this->api_fields as $field) {     //level", "duration", "task_id
                    $fieldVal = $value;                     //api providerlarından çekilen iş.

                    foreach ($api[$field . "_path"] as $path) {     //api_providers içinde field_path tanımına göre value pathini belirler.
                        if ($path["type"] == "string") {            //path type'ı string ise value'su yani pathin keyinden veriyi alır. path['zorluk']
                            $fieldVal = $fieldVal[$path["val"]];
                        } else if ($path["type"] == "int") {
                            $fieldVal = $fieldVal[$path["val"]];
                        } else if ($path["type"] == "key") {
                            $arrKeys = array_keys($value);                      // [0 => "Business Task 0"]
                            $fieldVal = $fieldVal[$arrKeys[$path["val"]]];      // ["level" => 1, "estimated_duration" => 7]
                        } else if ($path["type"] == "own") {
                            $arrKeys = array_keys($value);
                            $fieldVal = $arrKeys[$path["val"]];
                        }
                    }

                    $tmp[$field] = $fieldVal;
                }

                $result[$api["name"]][] = $tmp;
            }
        }

        $this->saveData($result);
    }

    public function saveData($data)
    {
        try {
            foreach ($data as $items) {
                Task::insert($items);
            }
        }catch (Exception $e) {
            throw new Exception($e->getMessage(), $e->getCode());
        }
    }
}
