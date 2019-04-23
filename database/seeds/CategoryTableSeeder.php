<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
    	DB::table('categories')->insert([

    		'category' 			=> 'CTOIC',

    		'created_at'		=> date('Y-m-d H:i:s'),

    		'updated_at'		=> date('Y-m-d H:i:s')

    	]);

    	DB::table('categories')->insert([

    		'category' 			=> 'CTOOC',

    		'created_at'		=> date('Y-m-d H:i:s'),

    		'updated_at'		=> date('Y-m-d H:i:s')

    	]);

    	DB::table('categories')->insert([

    		'category' 			=> 'CTOIOM',

    		'created_at'		=> date('Y-m-d H:i:s'),

    		'updated_at'		=> date('Y-m-d H:i:s')

    	]);

    	DB::table('categories')->insert([

    		'category' 			=> 'OTHERS',

    		'created_at'		=> date('Y-m-d H:i:s'),

    		'updated_at'		=> date('Y-m-d H:i:s')

    	]);
    	
        
    }
}
