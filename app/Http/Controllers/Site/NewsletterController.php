<?php
namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Subscribe;
use Illuminate\Database\QueryException;

class NewsletterController extends Controller
{
    public function subs(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->first()
            ], 422);
        }

        try {
            $data = $validator->validated();
            $subscribe = Subscribe::create($data);
            return response()->json([
                'message' => "Your Email Added Successfully",
            ]);
        } catch (QueryException $exception) {
            if ($exception->errorInfo[1] == 1062) {
                return response()->json([
                    'error' => 'This email is already subscribed.',
                ], 422);
            } else {
                return response()->json([
                    'error' => __('main.unexpected-error')
                ], 500);
            }
        }
    }
}
