<?php

 namespace App\Http\Controllers\Api\V1\Auth;



    use App\Http\Controllers\Controller;
    use App\Models\RefreshToken;
    use App\Models\User;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Str;

    class AuthController extends Controller
    {
        public function login(Request $request)
        {
            /*
        |--------------------------------------------------------------------------
        | Step 1: Validate Request
        |--------------------------------------------------------------------------
        */

            $validated = $request->validate([

                'email' => ['required', 'email'],

                'password' => ['required'],



            ]);

            /*
        |--------------------------------------------------------------------------
        | Step 2: Find User
        |--------------------------------------------------------------------------
        */

            $user = User::where('email', $validated['email'])->first();

            /*
        |--------------------------------------------------------------------------
        | Step 3: Verify Password
        |--------------------------------------------------------------------------
        */

            if (!$user || !Hash::check($validated['password'], $user->password)) {

                return response()->json([
                    'message' => 'Invalid credentials'
                ], 401);
            }

            /*
        |--------------------------------------------------------------------------
        | Step 4: Delete Old Access Token (Optional)
        |--------------------------------------------------------------------------
        | এক ডিভাইসে একটাই Access Token রাখতে চাইলে।
        | না চাইলে এই অংশ বাদ দিতে পারো।
        |--------------------------------------------------------------------------
        */



            /*
        |--------------------------------------------------------------------------
        | Step 5: Create Sanctum Access Token
        |--------------------------------------------------------------------------
        */

            $accessToken = $user
                ->createToken('auth')
                ->plainTextToken;

            /*
        |--------------------------------------------------------------------------
        | Step 6: Create Refresh Token
        |--------------------------------------------------------------------------
        */

            $plainRefreshToken = Str::random(80);

            RefreshToken::create([

                'user_id' => $user->id,



                'token' => hash('sha256', $plainRefreshToken),

                'expires_at' => now()->addDays(7),

                'revoked' => false,

            ]);

            /*
        |--------------------------------------------------------------------------
        | Step 7: Return Response
        |--------------------------------------------------------------------------
        */

            return response()->json([

                'message' => 'Login successful',

                'user' => [

                    'id' => $user->id,

                    'name' => $user->name,

                    'email' => $user->email,

                    'role_id' => $user->role_id,

                ],

                'access_token' => $accessToken,

                'refresh_token' => $plainRefreshToken,

                'token_type' => 'Bearer',

                'expires_in' => 2 * 60

            ]);
        }

        /**
         * POST /api/refresh-token
         */
        public function refresh(Request $request)
        {
            /*
        |--------------------------------------------------------------------------
        | Step 1: Validate
        |--------------------------------------------------------------------------
        */

            $validated = $request->validate([

                'refresh_token' => ['required']

            ]);

            /*
        |--------------------------------------------------------------------------
        | Step 2: Find Refresh Token
        |--------------------------------------------------------------------------
        */

            $refreshToken = RefreshToken::where(

                'token',

                hash('sha256', $validated['refresh_token'])

            )->first();

            /*
        |--------------------------------------------------------------------------
        | Step 3: Check Validity
        |--------------------------------------------------------------------------
        */

            if (
                !$refreshToken ||
                $refreshToken->revoked ||
                $refreshToken->expires_at->isPast()
            ) {

                return response()->json([

                    'message' => 'Refresh token is invalid.'

                ], 401);
            }

            /*
        |--------------------------------------------------------------------------
        | Step 4: Get User
        |--------------------------------------------------------------------------
        */

            $user = $refreshToken->user;

            /*
        |--------------------------------------------------------------------------
        | Step 5: Revoke Old Refresh Token
        |--------------------------------------------------------------------------
        */

            $refreshToken->update([

                'revoked' => true,

                'last_used_at' => now()

            ]);

            /*
        |--------------------------------------------------------------------------
        | Step 6: Delete Old Access Token (Optional)
        |--------------------------------------------------------------------------
        */

            $user->tokens()
                ->where('name', $refreshToken->device_name)
                ->delete();

            /*
        |--------------------------------------------------------------------------
        | Step 7: Create New Access Token
        |--------------------------------------------------------------------------
        */

            $accessToken = $user
                ->createToken($refreshToken->device_name)
                ->plainTextToken;

            /*
        |--------------------------------------------------------------------------
        | Step 8: Create New Refresh Token
        |--------------------------------------------------------------------------
        */

            $newRefreshToken = Str::random(80);

            RefreshToken::create([

                'user_id' => $user->id,

                'device_name' => $refreshToken->device_name,

                'token' => hash('sha256', $newRefreshToken),

                'expires_at' => now()->addDays(7),

                'revoked' => false

            ]);

            /*
        |--------------------------------------------------------------------------
        | Step 9: Return
        |--------------------------------------------------------------------------
        */

            return response()->json([

                'access_token' => $accessToken,

                'refresh_token' => $newRefreshToken,

                'token_type' => 'Bearer'

            ]);
        }

        /**
         * POST /api/logout
         */
        public function logout(Request $request)
        {
            /*
        |--------------------------------------------------------------------------
        | Delete Current Access Token
        |--------------------------------------------------------------------------
        */

            $request->user()
                ->currentAccessToken()
                ->delete();

            /*
        |--------------------------------------------------------------------------
        | Revoke All Refresh Tokens
        |--------------------------------------------------------------------------
        */

            RefreshToken::where(

                'user_id',

                $request->user()->id

            )->update([

                'revoked' => true

            ]);

            return response()->json([

                'message' => 'Logout successful.'

            ]);
        }

        /**
         * GET /api/profile
         */
        public function profile(Request $request)
        {
            return response()->json([

                'user' => $request->user()

            ]);
        }
    }
