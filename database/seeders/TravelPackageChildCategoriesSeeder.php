<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class TravelPackageChildCategoriesSeeder extends Seeder
{
    public function run(): void
    {
        $child_categories = [
            'Egypt Classic Tours',
            'Egypt Honeymoon Packages',
            'Egypt Spiritual Tours',
            'Egypt Family Holidays',
            'Egypt Luxury Tours',
            'Egypt Private Tours',
            'Egypt Adventure Tours',
            'Egypt Cultural Tours',
            'Egypt Offers',
            'Solo Woman Egypt Tour',
            'Egypt Wheelchair Holidays'
        ];

        $package = Category::whereTranslation('slug', 'packages')->first();

        foreach ($child_categories as $cat_name) {
            $category = $this->findCategory($cat_name);
            $category->forceFill(['parent_id' => $package->id])->save();
        }
    }

    private function findCategory(string $cat_name)
    {
        $category = Category::whereTranslation('title', $cat_name)->first();

        if ($category) {
            return $category;
        }

        return Category::create([
            'en' => [
                'title' => $cat_name,
                'slug' => str($cat_name)->slug()
            ],

            'enabled' => true,
            'featured' => false,
            'banner' => null,
            'featured_image' => null,
            'parent_id' => null,
            'gallery' => null,
            'order_id' => 0,
        ]);
    }
}
