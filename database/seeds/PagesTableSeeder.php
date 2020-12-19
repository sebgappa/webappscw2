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
            $page->users()->attach(App\User::all()->random()->id);
        });;
    }
}
