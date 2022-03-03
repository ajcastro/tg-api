<?php

namespace App\Http\Controllers;

use App\Models\ParentGroup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthController extends Controller
{
    /**
     * Register user
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required|string',
        ]);

        $user = new User([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->save();

        $tokenResult = $this->createToken($user, $request);
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->plainTextToken;

        return $this->respondWithToken($token, $user);
    }

    /**
     * Login user and create token
     */
    public function login(Request $request)
    {
        $parentGroup = ParentGroup::findByCode($request->parent_group_code);

        $request->validate([
            'parent_group_code' => [
                'required', 'string',
                function ($attribute, $value, $fail) use ($parentGroup) {
                    if (is_null($parentGroup)) {
                        abort(401, 'Unauthorized');
                    }
                }
            ],
            'username' => 'required|string',
            'password' => 'required|string',
            // 'remember_me' => 'boolean'
        ]);

        $credentials = $request->only(['username', 'password']) + ['parent_group_id' => $parentGroup->id];

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $user = $request->user();
        $tokenResult = $this->createToken($user, $request);
        $token = $tokenResult->plainTextToken;

        return $this->respondWithToken($token, $user);
    }

    public function respondWithToken($token, User $user)
    {
        return JsonResource::make([
            'access_token' => $token,
            'user' => $user->toArray() + [
                'fullName' => $user->name,
                'role' => 'admin',
                'ability' => [[
                    'action' => 'manage',
                    'subject' => 'all',
                ]]
            ],
            'token_type' => 'Bearer',
        ]);
    }

    private function createToken(User $user, $request)
    {
        return $user->createToken($request->device_name ?? $request->header('user-agent'));
    }

    /**
     * Get the authenticated user
     */
    public function user(Request $request)
    {
        return JsonResource::make($request->user());
    }

    /**
     * Logout user (Revoke the token)
     */
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return JsonResource::make([
            'message' => 'Successfully logged out'
        ]);
    }
}
