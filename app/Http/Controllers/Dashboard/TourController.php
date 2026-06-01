<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\TourDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TourRequest;
use App\Models\Category;
use App\Models\Destination;
use App\Models\SeasonTour;
use App\Models\Tour;
use App\Models\TourOption;
use App\Models\Translations\TourTranslation;

class TourController extends Controller
{


    public function index(TourDataTable $dataTable)
    {
        return $dataTable->render('dashboard.tours.index');
    }

    public function store(TourRequest $request)
    {
        $tour = Tour::create($request->getSanitized());
        $tour->seo()->create($request->get('seo'));
        $tour->categories()->sync($request->get('categories'));
        $tour->destinations()->sync($request->get('destinations'));
        $tour->options()->attach($request->get('options'));
        $request->collect('days')->each(fn($day) => $tour->days()->create($day));
        $tour->refresh();
        $tour->update([
            'start_from_price' => $tour->start_from ?? $tour->adult_price ?? 0,
        ]);
        session()->flash('message', 'Tour Created Successfully!');
        session()->flash('type', 'success');
        return redirect()->route('dashboard.tours.edit', $tour);
    }

    public function create()
    {
        $relations = [
            'categories' => Category::all(),
            'destinations' => Destination::all(),
            'options' => TourOption::all()
        ];
        return view('dashboard.tours.create', compact('relations'));
    }

    public function options()
    {
        $tour = Tour::findOrFail(request('tour_id'));
        return response()->json([
            'options' => $tour->options->toArray()
        ]);
    }

    public function update(TourRequest $request, Tour $tour)
    {
        $tour->update($request->getSanitized());
        foreach (config('translatable.supported_locales') as $localKey => $local) {
            $tour_payload = [
                'tour_id' => $tour->id,
                'locale' => $localKey,
            ];
            TourTranslation::updateOrCreate($tour_payload, array_merge($request->get($localKey), $tour_payload));
        }
        $tour->seo ? $tour->seo->update($request->get('seo')) : $tour->seo()->create($request->get('seo'));
        $tour->categories()->sync($request->get('categories'));
        $tour->destinations()->sync($request->get('destinations'));
        $tour->options()->sync($request->get('options'));
        $tour->days()->delete();
        foreach ($request->get('days', []) as $tour_day) {
            if ($tour_day['en']['title']) {
                $tour->days()->create($tour_day);
            }
        }
        $tour->refresh();
        $tour->update([
            'start_from_price' => $tour->start_from ?? $tour->adult_price ?? 0
        ]);
        session()->flash('message', 'Tour Updated Successfully!');
        session()->flash('type', 'success');
        return back();
    }

    public function show(Tour $tour)
    {
        $seasons = SeasonTour::where('tour_id', $tour->id)->get();

        $relations = [
            'categories' => Category::all(),
            'destinations' => Destination::all(),
            'options' => TourOption::all(),
            'seasons' => $seasons
        ];
        return view('dashboard.tours.show', compact('tour', 'relations', 'seasons'));
    }

    public function edit(Tour $tour)
    {
        $seasons = SeasonTour::where('tour_id', $tour->id)->get();

        $relations = [
            'categories' => Category::all(),
            'destinations' => Destination::all(),
            'options' => TourOption::all(),
            'seasons' => $seasons
        ];
        return view('dashboard.tours.edit', compact('tour', 'relations', 'seasons'));
    }

    public function destroy(Tour $tour)
    {
        $tour->delete();
        return response()->json([
            'message' => 'Tour Deleted Successfully!'
        ]);
    }

    public function duplicate(Tour $tour)
    {
        $new_tour = $tour->duplicate();
        return redirect()->route('dashboard.tours.edit', ['tour' => $new_tour->id]);
    }
}
