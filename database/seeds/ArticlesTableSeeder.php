<?php

use App\Article;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla articles.
        Article::truncate();
        $faker = \Faker\Factory::create();
        // iteramos sobre cada uno y simulamos un inicio de
        // Obtenemos la lista de todos los usuarios creados e
        // sesión con cada uno para crear artículos en su nombre
        $users = App\User::all();
        foreach ($users as $user) {
        // iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
        // Y ahora con este usuario creamos algunos articulos
            $num_articles = 5;
            for ($j = 0; $j < $num_articles; $j++) {
                //$image_name = $faker->image('public/storage/articles', 400, 300, null, false);
                Article::create([
                    'title' => $faker->sentence,
                    'body' => $faker->paragraph,
                    'category_id' => $faker->numberBetween(1,3),
                    //'image'=> 'articles/'.$image_name
                    'image' => $faker->imageUrl(400,300, null, false)
                ]);
            }
        }


    }
}
