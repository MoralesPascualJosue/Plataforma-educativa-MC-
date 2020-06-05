<?php

use Illuminate\Database\Seeder;

class FdiscussionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 
        Factory(App\Models\fcategoria::class,20)->create();       
         Factory(App\Models\fdiscusion::class,10)->create();
         Factory(App\Models\fpost::class,5)->create();

    }
}
