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
        // No register feature in admin panel
    }

    /**
     * Login user and create token
     */
    public function login(Request $request)
    {
        $request->validate([
            'parent_group_code' => 'required|string',
            'username' => 'required|string',
            'password' => 'required|string',
            // 'remember_me' => 'boolean'
        ]);

        $credentials = $request->only(['username', 'password']);

        if (!auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        /** @var User */
        $user = $request->user();

        $parentGroup = ParentGroup::findByCode($request->parent_group_code) ?? new ParentGroup();

        $userAccess = $user->findUserAccess($parentGroup);

        if (empty($userAccess)) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        $tokenResult = $user->createToken($this->getTokenName($request), ['*'], [
            'parent_group_id' => $userAccess->parent_group_id,
            'role_id' => $userAccess->role_id,
        ]);

        return $this->respondWithToken($tokenResult->plainTextToken, $user);
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

    private function getTokenName(Request $request)
    {
        return $request->device_name ?? $request->header('user-agent');
    }

    /**
     * Get the authenticated user
     */
    public function user(Request $request)
    {
        $user = User::make()->resolveRouteBinding($request->user()->id);
        return JsonResource::make($user);
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
