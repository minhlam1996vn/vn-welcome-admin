<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'refresh']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token =  Auth::guard('api')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $refreshToken =  $this->createRefreshToken();

        return $this->respondWithToken($token, $refreshToken);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        try {
            return response()->json(Auth::guard('api')->user());
        } catch (JWTException $exception) {
            return response()->json(
                [
                    'error' => 'Unauthorized',
                    'message' => $exception
                ],
                401
            );
        }
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('api')->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $Request)
    {
        $refreshToken = $Request->refresh_token;
        try {
            $decoded = JWTAuth::getJWTProvider()->decode($refreshToken);

            // Get user information
            $user = User::find($decoded['user_id']);
            if (!$user) {
                return response()->json(['error' => "User not found"], 404);
            }

            // Disable current token
            Auth::guard('api')->invalidate();

            // Create new token
            $token = Auth::guard('api')->login($user);

            $refreshToken = $this->createRefreshToken();

            return $this->respondWithToken($token, $refreshToken);
        } catch (JWTException $exception) {
            return response()->json(
                [
                    'error' => 'Refresh Token Invalid',
                    'message' => $exception
                ],
                500
            );
        }
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     * @param  string $refreshToken
     *
     * @return \Illuminate\Http\JsonResponse
     */
    private function respondWithToken($token, $refreshToken)
    {
        return response()->json([
            'access_token' => $token,
            'refresh_token' => $refreshToken,
            'token_type' => 'bearer',
            'expires_in' => Auth::guard('api')->factory()->getTTL() * 60,
        ]);
    }

    /**
     * Generate a new refresh token for the authenticated API user.
     *
     * @return string The generated refresh token.
     */
    private function createRefreshToken()
    {
        $data = [
            'user_id' => Auth::guard('api')->user()->id,
            'random' => Str::uuid() . time(),
            'exp' => time() + config('jwt.refresh_ttl')
        ];
        $refreshToken =  JWTAuth::getJWTProvider()->encode($data);

        return $refreshToken;
    }
}
