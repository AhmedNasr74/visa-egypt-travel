<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Destination;
use App\Models\Tour;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class LinkToursByCategoriesAndDestinationsCommand extends Command
{
    protected $signature = 'link:tours';

    protected $description = 'Command description';

    public function handle(): void
    {
        $file_path = storage_path('app/public/tours.csv');

        if (!File::exists($file_path)) {
            $this->error('File not found');
            return;
        }

        $file_content = File::get($file_path);

        $rows = explode(PHP_EOL, $file_content);

        if (count($rows) < 1) {
            $this->error('File is empty');
            return;
        }

        unset($rows[0]);

        foreach ($rows as $row) {
            $row = str($row)->trim()->explode(',');

            $tour = Tour::where(function ($q) use ($row) {
                $q->whereTranslation('title', $row[0])
                    ->orWhere('slug', $row[0]);
            })->first();

            if (!$tour) { continue; }

            $categories = str($row[2])->explode(',');

            foreach ($categories as $category) {
                $cat = Category::where(function ($q) use ($category) {
                    $q->whereTranslation('title', $category)->orWhereTranslation('slug', $category);
                })->first();
                if (!$cat) { continue; }

                if ($tour->categories->contains('id', $cat->id)) { continue; }

                $tour->categories()->attach($cat->id);
            }

            $destinations = str($row[3])->explode(',');

            foreach ($destinations as $destination) {
                $dest = Destination::where(function ($q) use ($destination) {
                    $q->whereTranslation('title', $destination)->orWhereTranslation('slug', $destination);
                })->first();

                if (!$dest) { continue; }

                if ($tour->destinations->contains('id', $dest->id)) { continue; }

                $tour->destinations()->attach($dest->id);
            }

            $this->output->info('Tour Linked: ' . $tour->title);
        }

        $this->output->success('Done');
    }
}
