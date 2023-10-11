<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;
class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection()->disableQueryLog();
        $path 	= storage_path('data/countries_regions_cities/countries.json');
        $now 		= date('Y-m-d H:i:s');

        if(is_file($path))
        {
        	$countries 	= json_decode(file_get_contents($path));
        	if(count($countries) > 0)
        	{
        		$data 	= array();
        		foreach($countries as $country)
        		{
        			$data[]  = array(
        				'name' 			=> $country->country,
        				'abrv' 			=> $country->ISO3,
        				'created_at'	=> $now,
        				'updated_at'	=> $now
        			);
        		}
        		DB::table('countries')->insert($data);
        	}
        }
        else
        {
        	throw new Exception("File not Found.");
        }
    }
}
