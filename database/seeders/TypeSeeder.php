<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // creo un array con la lista delle tipologie di progetto
        $types = ['Back End', 'Front End', 'Full Stack', 'UI', 'UX'];

        // ciclo l'array per creare un record per ogni tipologia per test di dati
        foreach($types as $type){
            $newType = new Type();

            $newType->name = $type;
            $newType->slug = Str::slug($newType->name, '-');
            $newType->description = $faker->text(100);

            $newType->save();

        }

    }
}
