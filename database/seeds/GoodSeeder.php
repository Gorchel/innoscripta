<?php

use Illuminate\Database\Seeder;

use App\Classes\Goods\GoodCreator;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Seed with default good data
     *
     * @return void
     */
    public function run()
    {
        $goodArray = [
            ['name' => 'Peperoni', 'description' => 'Qui sequi provident reiciendis aut asperiores.', 'price' => 7.33, 'img_path' => '/img/goods/pepperoni.jpg'],
            ['name' => 'Cheese', 'description' => 'Illo ad provident a at quia beatae id.', 'price' => 7.47, 'img_path' => '/img/goods/cheese.jpg'],
            ['name' => 'Margarita', 'description' => 'Iste sed molestiae voluptate officiis.', 'price' => 3.32, 'img_path' => '/img/goods/margarita.jpeg'],
            ['name' => 'Double Peperoni', 'description' => 'Suscipit aut voluptatem nam non voluptatibus nihil.', 'price' => 3.79, 'img_path' => '/img/goods/double_pepperoni.jpg'],
            ['name' => 'Meat Lovers', 'description' => 'Consectetur consequatur et omnis harum', 'price' => 2.15, 'img_path' => '/img/goods/meat_lovers.jpg'],
            ['name' => 'Italian', 'description' => 'Perspiciatis quae voluptatem sit id voluptatibus sunt.', 'price' => 4.93, 'img_path' => '/img/goods/italian.jpg'],
            ['name' => 'Mexican', 'description' => 'Esse nostrum quia et unde quo pariatur.', 'price' => 5.85, 'img_path' => '/img/goods/mexican.jpg'],
            ['name' => 'Four Cheese', 'description' => 'Tenetur maxime temporibus ipsum laboriosam veniam.', 'price' => 6.53, 'img_path' => '/img/goods/four_cheese.jpg'],
        ];

        $creator = new GoodCreator;

        foreach ($goodArray as $good) {
            $creator->make($good);
        }
    }
}
