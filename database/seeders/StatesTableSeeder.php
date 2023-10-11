<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;
class StatesTableSeeder extends Seeder
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
            $path = storage_path('data/countries_regions_cities/states/' . $country->name . '.json');
            if(is_file($path))
            {
                $states 	= json_decode(file_get_contents($path));
                if(!empty($states))
                {
                    $data 	= array();
                    foreach($states->regions as $state)
                    {
                        $data[]  = array(
                            'country_id' 	=> $country->id,
                            'name' 			=> $state->name,
                            'abrv' 			=> $state->toponymName,
                            'created_at'	=> $now,
                            'updated_at'	=> $now,
                        );
                    }
                    DB::table('states')->insert($data);
                }
            }
        }
    }
}
