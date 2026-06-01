<?php

namespace App\Http\Controllers\Site;

use App\Events\General\NewRegistrationEvent;
use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private string $redirect_url;

    public function __construct()
    {
        $this->redirect_url = route('site.myprofile');
        config()->set('auth.defaults.passwords' , 'clients');
    }

    public function login(Request $request)
    {

        $error_message = __('auth.failed');
        $validator = \Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        if ($validator->fails()) {
            $error_message = $validator->errors()->first();
            goto Failure;
        }

        $credentials = $request->only(['email', 'password']);
        if (auth()->guard('client')->attempt($credentials, $request->input('remember', false))) {
            return response()->json([
                'status' => true,
                'redirect_url' => route('site.home'),
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
        $validator = \Validator::make($request->all(), [
            'email' => ['required', 'email', 'max:255', 'unique:clients'],
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            $error_message = $validator->errors()->first();
            goto Failure;
        }

        $data = $validator->validated();
       //  dd($data);
        $data['password'] = bcrypt($data['password']);
        try {
            if ($client = Client::create($data)) {
                // event(new NewRegistrationEvent($client));
                auth()->guard('client')->login($client);
                return response()->json([
                    'status' => true,
                    'message' => 'Registered Successfully, Redirecting....',
                    'redirect_url' => $this->redirect_url
                ]);
            }
        } catch (\Exception $exception){
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
    $error_message = __('main.unexpected error-please try again later');
    $validator = \Validator::make($request->all(), [
        'email' => ['required', 'email', 'max:255'],
        'name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'phone' => ['required', 'string', 'max:255'],
    ]);

    if ($validator->fails()) {
        $error_message = $validator->errors()->first();
        goto Failure;
    }

    $data = $validator->validated();
    // dd($data);
   // $data['password'] = bcrypt($data['password']);
    try {
        $client = Client::findOrFail( auth()->guard('client')->user()->id);
        if ($client->update($data)) {
            return response()->json([
                'status' => true,
                'message' => 'your profile data updated successfully.',
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


   public function updatePassword(Request $request)
{
    try {
        $error_message = __('main.unexpected error-please try again later');
        $validator = \Validator::make($request->all(), [
            'password' => ['required', 'string', 'max:255'],
            'old_password' => ['required', 'string', 'max:255'],
        ]);

        if ($validator->fails()) {
            $error_message = $validator->errors()->first();
            goto Failure;
        }

        $data = $validator->validated();

        $client = Client::findOrFail(auth()->guard('client')->user()->id);

        // Check if the old password matches the current password
        if (!\Hash::check($data['old_password'], $client->password)) {
            $error_message = 'Invalid old password.';
            goto Failure;
        }

        // Update the password
        $client->password = bcrypt($data['password']);
        if ($client->save()) {
            return response()->json([
                'status' => true,
                'message' => 'Your profile password updated successfully.',
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
        auth()->guard('client')->logout();
        return redirect()->route('site.home');
    }
}
