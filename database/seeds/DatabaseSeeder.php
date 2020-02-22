<?php

use Illuminate\Database\Seeder;
use App\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory('App\User', 20)->create();
        factory('App\Company', 20)->create();
        factory('App\Property', 20)->create();

        $categories = [
            'Sold',
            'Under Offer',
            'Sold STC',
            'For Sale'
        ];
        foreach ($categories as $category){
            Category::create(['name'=>$category]);
        }
    }
}
