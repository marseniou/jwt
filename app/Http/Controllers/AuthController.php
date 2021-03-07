<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{

	    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
	    public function register(Request $request)
    {
        try {
            $messages = [
            'name.required' => 'Το όνομα είναι υποχρεωτικό',
            'name.min' => 'Το όνομα πρέπει να έχει τουλάχιστον 3 χαρακτήρες',
            'name.max' => 'Το όνομα δεν πρέπει να υπερβαίνει τους 20 χαρακτήρες',
            'email.required' => 'Το email είναι υποχρεωτικό',
            'email.unique' => 'Το email ήδη χρησιμοποιείτε',
            'password.required' => 'Ο Κωδικός είναι υποχρεωτικός',
            'password_r.required' => 'Η επαλήθευση κωδικού είναι υποχρεωτική',
            'password_r.same' => 'Ο Κωδικός είναι διαφορετικός',
            'password.min' => 'Ο Κωδικός πρέπει να έχει τουλάχιστον 8 χαρακτήρες',
        ];

            $this->validate($request, [
            'name' => 'required|min:3|max:20',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
            'password_r' => 'required|same:password'
        ], $messages);
            $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => app('hash')->make($request->password, ['rounds' => 12]),
         ]);

            $token = auth()->login($user);
            return response()->json(['status'=>'ok','email'=>$user->email, 'password'=>$request->password]);
        } catch (ValidationException $e) {
            return response()->json([
            'status' => 'error',
            'msg'    => 'Error',
            'errors' => $e->errors(),
        ], 422);
        }
    }
    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(['user'=>auth()->user()]);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
