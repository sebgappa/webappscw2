<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Page::class, 5)->create()->each(function($page) {
            for ($i = 0; $i < rand(1,5); $i++) {
                $page->users()->attach(factory(App\User::class, 1)->create());
            }
        });;
    }
}
