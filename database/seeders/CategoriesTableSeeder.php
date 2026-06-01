<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //A category
        $category = new Category;
        $category->title = 'Shore Excursions';
        $category->description = 'This is a category.';
        $category->slug = 'shore-excursions';
        $category->enabled = true;
        $category->featured = false;
        $category->banner = null;
        $category->featured_image = 'example.jpg';
        $category->gallery = ['image1.jpg', 'image2.jpg'];
        if (!Category::whereTranslation('slug', $category->slug)->exists()) {

            $category->save();

        }

        // A category
        $category = new Category;
        $category->title = 'Luxury Tours';
        $category->description = 'This is a category.';
        $category->slug = 'luxury-tours';
        $category->enabled = true;
        $category->featured = false;
        $category->banner = null;
        $category->featured_image = 'example.jpg';
        $category->gallery = ['image1.jpg', 'image2.jpg'];
        if (!Category::whereTranslation('slug', $category->slug)->exists()) {
            $category->save();

        }
        //
        $category = new Category;
        $category->title = 'Day Tours';
        $category->description = 'This is a category.';
        $category->slug = 'day-tours';
        $category->enabled = true;
        $category->featured = false;
        $category->banner = null;
        $category->featured_image = 'example.jpg';
        $category->gallery = ['image1.jpg', 'image2.jpg'];
        if (!Category::whereTranslation('slug', $category->slug)->exists()) {
            $category->save();

        }
        //
        $category = new Category;
        $category->title = 'Offers';
        $category->description = 'This is a category.';
        $category->slug = 'offers';
        $category->enabled = true;
        $category->featured = false;
        $category->banner = null;
        $category->featured_image = 'example.jpg';
        $category->gallery = ['image1.jpg', 'image2.jpg'];
        if (!Category::whereTranslation('slug', $category->slug)->exists()) {
            $category->save();
        }


        $category = new Category;
        $category->title = 'Packages';
        $category->description = 'This is a category.';
        $category->slug = 'packages';
        $category->enabled = true;
        $category->featured = false;
        $category->banner = null;
        $category->featured_image = 'example.jpg';
        $category->gallery = ['image1.jpg', 'image2.jpg'];
        if (!Category::whereTranslation('slug', $category->slug)->exists()) {
            $category->save();
        }

    }

}
