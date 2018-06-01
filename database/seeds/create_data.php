<?php

use Illuminate\Database\Seeder;
use App\company;
use App\department;
use App\employment;
use Faker\Factory as Faker;

class create_data extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	// employment::Truncate();
    	// department::Truncate();
     //    company::Truncate();

        $faker = Faker::create();
        //$faker->addProvider(new CompanyNameGenerator\FakerProvider($faker));

        foreach (range(1,5) as $index) {

	        $company_name_data = company::create([
	        		'name'=> str_random(10),
	        	])->id;

	        foreach(range(1,5) as $index_2) {

				$department_row = department::create([
	        		'name'=> str_random(7),
	        		'company_id'=>$company_name_data,
	        	])->id;	

	        	foreach (range(1,5) as $index_3) 
	        	{
	        		$employment_row = employment::create([
	        		'name'=> $faker->name,
	        		'depart_id'=>$department_row,
	        	])->id;	
	        		
	        	}	        	
	        }


        }
    }
}
