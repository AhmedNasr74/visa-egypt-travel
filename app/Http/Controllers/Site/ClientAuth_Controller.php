<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ClientAuth_Controller extends Controller
{
    private $redirect_url;

    public function __construct()
    {
        $this->redirect_url = route('site.home');
        config()->set('auth.defaults.passwords', 'clients');
    }

    public function login(Request $request)
    {

        $error_message = __('auth.failed');
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
            'remember' => 'nullable|boolean',
            'terms' => "required",

        ]);
        if ($validator->fails()) {
            $error_message = $validator->errors()->first();
            goto Failure;
        }

        $credentials = $request->only(['email', 'password']);
        if (auth()->guard('client')->attempt($credentials, $request->input('remember', false))) {
            return response()->json([
                'status' => true,
                'redirect_url' => $this->redirect_url,
                'message' => __('main.logged_in_successfully')
            ]);
        }
        Failure:
        return response()->json([
            'message' => $error_message,
            'status' => false,
        ], 422);
    }

    public function register(Request $request)
    {
        $error_message = __('main.unexpected error-please try again later');
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255', 'unique:clients'],
            'name' => ['required', 'string', 'max:255'],
            //'last_name' => ['required', 'string', 'max:255'],
            'terms' => "required",
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            $error_message = $validator->errors()->first();
            goto Failure;
        }

        $data = $validator->validated();
        $data['password'] = bcrypt($data['password']);
        try {
            if ($client = Client::create($data)) {
                auth()->guard('client')->login($client);
                return response()->json([
                    'status' => true,
                    'message' => __('main.registered_successfully'),
                    'redirect_url' => $this->redirect_url
                ]);
            }
        } catch (\Exception $exception) {
            goto Failure;
        }
        Failure:
        return response()->json([
            'message' => $error_message,
            'status' => false,
        ], 422);
    }



    public function update(Request $request)
    {
        // $error_message = __('main.unexpected error-please try again later');
        $validator = \Validator::make($request->all(), [
            'name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'nationality' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable'],
            'note' => ['nullable'],
        ]);

        if ($validator->fails()) {
            $error_message = $validator->errors()->first();
            goto Failure;
        }

        $data = $validator->validated();

        try {
            $client = Client::findOrFail(auth()->guard('client')->user()->id);
            if ($request->file('avatar')) {
                $path = $request->file('avatar')->store('public/avatars');
                // dd($path);
                $data['avatar'] = str_replace('public/', '', $path);
                $data['avatar']= env('APP_URL') . '/' . 'storage/' .$data['avatar'];
                $client->update([
                    'avatar'=>$data['avatar']
                ]);
            }
            $client->update([
                'name'=>$data['name'],
                'phone'=>$data['phone'],
            ]);
            if ($client->update($data)) {
                return response()->json([
                    'status' => true,
                    'message' => __('main.your-profile-data-updated'),
                    'redirect_url' => $this->redirect_url
                ]);
            }
        } catch (\Exception $exception) {
            dd($exception->getMessage());
            goto Failure;
        }

        Failure:
        return response()->json([
            'message' => $exception,
            'status' => false,
        ], 422);
    }
    public function updatePassword(Request $request)
    {
        try {
            $error_message = __('main.unexpected error-please try again later');
            $validator = Validator::make($request->all(), [
                'password' => ['required', 'string', 'max:255', 'confirmed'],
                'old_password' => ['required', 'string', 'max:255'],
            ], [
                'password.confirmed' => 'The password confirmation does not match.',
            ]);


            if ($validator->fails()) {
                $error_message = $validator->errors()->first();
                goto Failure;
            }

            $data = $validator->validated();

            $client = Client::findOrFail(auth()->guard('client')->user()->id);

            // Check if the old password matches the current password
            if (!Hash::check($data['old_password'], $client->password)) {
                $error_message = __('main.invalid-old-password');
                goto Failure;
            }

            $client->password = bcrypt($data['password']);
            if ($client->save()) {
                return response()->json([
                    'status' => true,
                    'message' => __('main.your-profile-data-updated'),
                    'redirect_url' => $this->redirect_url
                ]);
            }
        } catch (\Exception $exception) {
            $error_message = $exception->getMessage();
            goto Failure;
        }

        Failure:
        return response()->json([
            'message' => $error_message,
            'status' => false,
        ], 422);
    }


    public function logout()
    {
        auth()->logout();
        return redirect()->route('site.home');
    }
    public function googlepage()
    {
        return Socialite::driver('google')->redirect();
    }

    public function Callback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $findUser = Client::where('google_id', $user->id)->first(); // Updated variable name
            if ($findUser) {
                auth()->guard('client')->login($findUser);
                $response=response()->json([
                    "user_id" => $findUser->id,
                    'status' => 'success',
                    'message' => 'User Login successfully'
                ], 201);
                return Redirect::away(route('site.home'));
                        } else {
                $googleUser = new CLient([
                    'name' => $user['given_name'].$user['family_name'],
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => bcrypt('123456dummy'),
                    'avatar'=>$user['picture'],
                ]);
                $googleUser->save();

                auth()->guard('client')->login($googleUser);
                $response=response()->json([
                    "user_id" => $googleUser->id,
                    'status' => 'success',
                    'message' => 'User Login successfully'
                ], 201);
                return redirect()->away(route('site.home'));
            }
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
    public function login_page() {
        return view('site.login.index');
    }
    public function register_page() {
        return view('site.login.sign-up');
    }
}
