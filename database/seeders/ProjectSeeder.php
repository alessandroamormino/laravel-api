<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i = 0; $i < 10; $i++){
            $project = new Project();

            $project->title = $faker->sentence(3);
            $project->content = $faker->text(400);
            $project->slug = Str::slug($project->title, '-');
            $project->thumb = $faker->imageUrl(640, 480, 'animals', true);
            $project->languages = $faker->randomElement(['Vue', 'HTML5', 'CSS3', 'JS', 'Laravel']);
            $project->repo = $faker->word();

            $project->save();

        }
    }
}
