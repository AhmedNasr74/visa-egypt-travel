<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function add_to_wishlist(Request $request)
    {
        try {
            if(!auth()->guard('client')->user()){
                return response()->json([
                    'failed' => 'You Must Login First',
                    'login'=>route('login-page')
                ]);
            }
            $client = auth()->guard('client')->user();
            if ($client->wishlist()->where('tour_id', $request->tour_id)->exists()) {
                $client->wishlist()->detach($request->tour_id);
                return response()->json([
                    'remove' => 'removed from wishlist',
                ]);
            }
            $client->wishlist()->attach($request->tour_id);
            return response()->json([
                'success' => 'added to wishlist',
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => 'unknown error'
            ], 422);
        }
    }
}
