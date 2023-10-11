<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;
class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection()->disableQueryLog();
        $countries 	= \App\Models\Country::all();
        $now 		= date('Y-m-d H:i:s');

        foreach($countries as $country)
        {
        	if($country->states->count() > 0)
        	{
        		$states 	= $country->states;
        		foreach($states as $state)
        		{
		        	$path 	= storage_path('data/countries_regions_cities/cities/'. $country->name .'/'. $state->name .'.json');
			        if(is_file($path))
			        {
			        	$cities 	= json_decode(file_get_contents($path));
			        	if(!empty($cities))
			        	{
			        		$data 	= array();
			        		foreach($cities->cities as $city)
			        		{
			        			$data[]  = array(
			        				'state_id' 		=> $state->id,
			        				'name' 			=> $city->name,
			        				'abrv' 			=> $city->asciiname,
			        				'created_at'	=> $now,
			        				'updated_at'	=> $now,
			        			);
			        		}
			        		DB::table('cities')->insert($data);
			        	}
			        }
			    }
	    	}
        }
    }
}
