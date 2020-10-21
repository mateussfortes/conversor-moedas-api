<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class JwtAuthController extends Controller
{

    /**
     * Create a new JwtAuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $jwt_token = null;

        if (!$jwt_token = auth()->guard('api')->attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 402);
        }

        return $this->respondWithToken($jwt_token);
    }

    public function logout(Request $request)
    {

        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);

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
            'expires_in' => auth()->guard('api')->factory()->getTTL() * 60
        ]);
        
    }

    public function me()
    {

        $user = auth()->guard('api')->user();

        return response()->json(['data' => $user]);

    }
}
