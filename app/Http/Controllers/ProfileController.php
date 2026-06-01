<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Booking;
use App\Models\Tour;


class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

     public function index()
     {
        if(auth()->guard('client')->user())
        {
            $client=auth()->guard('client')->user();
            $books=Booking::where('client_id',auth()->guard('client')->user()->id)->get();
            $tours=[];
            foreach($books as $book){
                $tour=Tour::where('id',$book->tour_id)->first();
                if(!array_key_exists($tour->id, $tours)){
                    $tours[$tour->id]=$tour;
                }
            }
            return view('site.profile.index' , compact('tours','client'));

        }
        else
          return  view('site.about.index');
     }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }


    public function toggleTheme()
    {
        admin()->forceFill([
            'theme' => admin()->theme == 'light' ? 'dark' : 'light',
        ])->save();
        return response()->json([
            'success' => true
        ]);
    }
}
