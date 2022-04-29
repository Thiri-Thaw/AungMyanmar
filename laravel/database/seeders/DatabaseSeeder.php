<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1)->create();
    }
}
        //\App\Models\Category::factory(20)->create();
        //\App\Models\Item::factory(200)->create();
        /*\App\Models\Customer::factory()->create([
            'id' => 1,
            'name' => 'Default Customer',
            'sale_type' => 'retail'
        ]);
        \App\Models\Company::factory()->create([
            'id' => 1,
            'name' => 'Awba',
            // 'sale_type' => 'wholesale'
        ]);
        \App\Models\Company::factory()->create([
            'id' => 2,
            'name' => 'Shwe nagar',
            // 'sale_type' => 'retail'
        ]);
        \App\Models\Customer::factory(10)->create();
        // factory(App\Article::class, 20)->create();
    }
}*/