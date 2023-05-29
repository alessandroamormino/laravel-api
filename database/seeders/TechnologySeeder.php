<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // creo un array di tecnologie per popolare dei dati di test
        $techs = ['HTML', 'CSS', 'JS', 'PHP', 'Vue', 'Bootstrap', 'Sass', 'MySQL', 'Laravel', 'VS Code', 'Figma'];
        // creo un record per ogni tecnologia
        foreach($techs as $tech){
            // creo un nuovo record
            $newTech = new Technology();
            // valorizzo i campi
            $newTech->name = $tech;
            $newTech->color = $faker->hexColor();
            $newTech->slug = Str::slug($newTech->name, '-');
            // salvo il record
            $newTech->save();
        }

    }
}
