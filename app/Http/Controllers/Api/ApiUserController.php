<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApiUser;
use Illuminate\Support\Facades\Hash;

class ApiUserController extends Controller
{
    
      public function index()
    {
        return response()->json(ApiUser::all());
    }


    public function show($id)
    {
        return response()->json(ApiUser::findOrFail($id));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'user_type' => 'required|in:admin,user',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|string',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = ApiUser::create($validated);

        return response()->json($user, 201);
    }


    public function update(Request $request, $id)
    {
        try {
            if (empty($id)) {
                return response()->json(['error' => 'User ID is required'], 400);
            }
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'age' => 'sometimes|integer',
                'password' => 'sometimes|min:6',
                'user_type' => 'sometimes|in:admin,user',
                'bio' => 'nullable|string',
                'profile_image' => 'nullable|string',
            ]);

            $user = ApiUser::findOrFail($id);

            if (isset($validated['password'])) {
                $validated['password'] = Hash::make($validated['password']);
            }

            $user->update($validated);

            return response()->json($user, 200);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Validation failed', 'details' => $e->errors()], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while updating the user',
                'details' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy($id)
    {
        try {
        
            if (empty($id)) {
                return response()->json(['error' => 'User ID is required'], 400);
            }

            $user = ApiUser::findOrFail($id);

        
            $user->delete();

            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'User not found'], 404);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'An error occurred while deleting the user',
                'details' => $e->getMessage()
            ], 500);
        }
    }



    public function apilogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = ApiUser::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ]);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }

}
